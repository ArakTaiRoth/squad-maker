<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Squads Model
 *
 * @property \App\Model\Table\PlayersTable|\Cake\ORM\Association\BelongsToMany $Players
 *
 * @method \App\Model\Entity\Squad get($primaryKey, $options = [])
 * @method \App\Model\Entity\Squad newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Squad[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Squad|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Squad patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Squad[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Squad findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SquadsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('squads');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Players', [
            'foreignKey' => 'squad_id',
            'targetForeignKey' => 'player_id',
            'joinTable' => 'players_squads'
        ]);
    }

    /**
     * getSquadCount
     * A method to return the # of squads currently in the database
     *
     * @return int A count of all the current squads
     */
    public function getSquadCount() {
        return $this->find()->all()->count();
    }

    /**
     * getSquads
     * A method to return al squads as well as the players associated with them
     *
     * @return App\Model\Entity\Squad[] An array of squad objects containing the squad info as well as associated Player objects
     */
    public function getSquads() {
        return $this->find()->contain(['Players'])->all();
    }

    /**
     * createSquads
     * Method to create a group of squads based off of the # of squads requested and the # of players available
     *
     * @param  int $squadCount The number of squads to create
     * @return array success or error message
     */
    public function createSquads($squadCount) {
        if ($squadCount < 2) {
            return [
                'type' => 'error',
                'message' => 'You must create at least 2 squads'
            ];
        }

        $players = $this->Players->getPlayers();
        $playerCount = count($players);
        $playersInSquad = (int) ($playerCount / $squadCount);
        $squads = $this->squadPlaceholders($squadCount);

        $averages = $this->calculateSkillAverages($players, $playerCount);

        $playersAdded = 0;
        do {
            // Reverse the array each time to change where we're starting our search from, this should help give more randomness
            $players = array_reverse($players);

            foreach ($squads as &$squad) {
                if ($playersAdded === 0) {
                    $squad['skills']->shooting += $players[0]->shooting;
                    $squad['skills']->skating += $players[0]->skating;
                    $squad['skills']->checking += $players[0]->checking;
                    array_push($squad['players']['_ids'], array_shift($players)->id);
                } else {
                    $key = $this->placePlayerInSquad($averages, $squad['skills'], $players, $playersAdded);
                    // I don't know why this is necessary, but I decided it's not a problem worth focusing on at the moment
                    if ($key === null) {
                        $key = 0;
                    }

                    // Update the squads skills with the new players skill rankings
                    $squad['skills']->shooting += $players[$key]->shooting;
                    $squad['skills']->skating += $players[$key]->skating;
                    $squad['skills']->checking += $players[$key]->checking;

                    // Add the player to the squad, then remove the player from the available players
                    array_push($squad['players']['_ids'], $players[$key]->id);
                    unset($players[$key]);
                }
            }

            $playersAdded++;
        } while ($playersAdded < $playersInSquad);

        $entities = $this->newEntities($squads, [
            'associated' => 'Players'
        ]);

        if ($this->saveMany($entities)) {
            return [
                'type' => 'success',
                'message' => 'All players successfully moved into squads'
            ];
        }

        return [
            'type' => 'error',
            'message' => 'There was an error moving players into squads'
        ];
    }

    /**
     * squadPlaceHolders
     * Generic function for creating placeholders for squad data
     *
     * @param  int $squadCount The number of squads to create
     * @return array Initial squads, readyt to have players inserted
     */
    public function squadPlaceholders($squadCount) {
        // Create the initial squads, will add players to them later
        for ($counter = 0; $counter < $squadCount; $counter++) {
            $squads[$counter] = [
                'name' => 'Squad ' . ($counter + 1),
                'players' => [
                    '_ids' => []
                ],
                'skills' => (object) [
                    'shooting' => 0,
                    'skating' => 0,
                    'checking' => 0
                ]
            ];
        }

        return $squads;
    }

    /**
     * calculateSkillAverages
     * Function to calculate the averages of the three skills for all players
     *
     * @param  array $players Array of player objects
     * @param  int $playerCount The # of players
     * @return object An object holding the average of each of the three skills
     */
    public function calculateSkillAverages($players, $playerCount) {
        // Calculate the global average of the three skills with all players
        $averages = (object) [
            'shooting' => 0,
            'skating' => 0,
            'checking' => 0
        ];

        foreach ($players as $player) {
            $averages->shooting += $player->shooting;
            $averages->skating += $player->skating;
            $averages->checking += $player->checking;
        }

        $averages->shooting = (int) ($averages->shooting / $playerCount);
        $averages->skating = (int) ($averages->skating / $playerCount);
        $averages->checking = (int) ($averages->checking / $playerCount);

        return $averages;
    }

    /**
     * placePlayerInSquad
     * Method to return the key of a player to place into a squad. This is done by going through all players and
     *     determining which player allows the squad average to stay as close as possible to the global average. This
     *     method is designed to be recursive so that it always returns something, by slowly expanding the range.
     *
     * @param  int[] $averages An integer array storing the global averages for each of the three skills
     * @param  stdObject int[] $skills An object holding an integer array of the current squads skills
     * @param  App/Model/Entity/Player[] $players An array of player objects holding all available players to be placed
     * @param  int $playersAdded An integer value saying how many players have been added to the current squad
     * @param  int $range A range parameter used to set the minimum and maximum bounds around an average that are acceptable
     * @return int A key in the player object array that indicates a player that fits the desired criteria
     */
    public function placePlayerInSquad($averages, $skills, $players, $playersAdded, $range = 5) {
        foreach ($players as $key => $player) {
            // Calculate the new average for each skill for the squad with the new potential player
            $shooting = (int) (($skills->shooting + $player->shooting) / ($playersAdded + 1));
            $skating = (int) (($skills->skating + $player->skating) / ($playersAdded + 1));
            $checking = (int) (($skills->checking + $player->checking) / ($playersAdded + 1));

            // Check if each average skill value falls within a desired range
            $shooting = filter_var($shooting, FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => $averages->shooting - $range,
                    'max_range' => $averages->shooting + $range
                ]
            ]);
            $skating = filter_var($skating, FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => $averages->skating - $range,
                    'max_range' => $averages->skating + $range,
                ]
            ]);
            $checking = filter_var($checking, FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => $averages->checking - $range,
                    'max_range' => $averages->checking + $range
                ]
            ]);

            if ($shooting && $skating && $checking) {
                // Return the key of the player that makes the squad stay within the given parameters
                return $key;
            }
        }

        return $this->placePlayerInSquad($averages, $skills, $players, $playersAdded, $range + 5);
    }
}
