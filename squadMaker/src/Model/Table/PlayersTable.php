<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Players Model
 *
 * @property \App\Model\Table\SquadsTable|\Cake\ORM\Association\BelongsToMany $Squads
 *
 * @method \App\Model\Entity\Player get($primaryKey, $options = [])
 * @method \App\Model\Entity\Player newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Player[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Player|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Player patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Player[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Player findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlayersTable extends Table
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

        $this->setTable('players');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Curl');

        $this->belongsToMany('Squads', [
            'foreignKey' => 'player_id',
            'targetForeignKey' => 'squad_id',
            'joinTable' => 'players_squads'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('firstName')
            ->maxLength('firstName', 50)
            ->requirePresence('firstName', 'create')
            ->notEmpty('firstName');

        $validator
            ->scalar('lastName')
            ->maxLength('lastName', 50)
            ->requirePresence('lastName', 'create')
            ->notEmpty('lastName');

        $validator
            ->integer('shooting')
            ->requirePresence('shooting', 'create')
            ->notEmpty('shooting');

        $validator
            ->integer('skating')
            ->requirePresence('skating', 'create')
            ->notEmpty('skating');

        $validator
            ->integer('checking')
            ->requirePresence('checking', 'create')
            ->notEmpty('checking');

        $validator
            ->integer('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

        return $validator;
    }

    /**
     * getPlayers
     * Used to grab all the players from the database
     * Sorts them by total skill score initially
     *
     * @return App\Model\Entity\Player[] An array of Player entities
     */
    public function getPlayers() {
        return $this->find()
            ->order(['total' => 'ASC'])
            ->all();
    }

    /**
     * createPlayers method
     * Used to create a new player in the system
     *
     * @param $players An array of player data, including first name, last name, and an array of skills
     *                   skills in the following order:
     *                   0 => shooting
     *                   1 => skating
     *                   2 => checking
     * @return [array] containing error or success and a message
     */
    public function createPlayers($players) {
        $entities = [];

        foreach ($players as $player) {
            $firstName = $player['firstName'];
            $lastName = $player['lastName'];
            $shooting = $player['skills'][0]['rating'];
            $skating = $player['skills'][1]['rating'];
            $checking = $player['skills'][2]['rating'];

            if ((!is_string($firstName) || $firstName === '') || (!is_string($lastName) || $lastName === '')) {
                return [
                    'type' => 'error',
                    'message' => 'Player id ' . $player['_id'] . ' must have a first name and a last name'
                ];
            }
            if (!is_int($shooting) || !is_int($skating) || !is_int($checking)) {
                return [
                    'type' => 'error',
                    'message' => 'Skills must be an integer, for player id ' . $player['_id']
                ];
            }

            $total = $shooting + $skating + $checking;

            $entities[] = $this->newEntity([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'shooting' => $shooting,
                'skating' => $skating,
                'checking' => $checking,
                'total' => $total
            ]);
        }

        if ($this->saveMany($entities)) {
            return [
                'type' => 'success',
                'message' => 'All players successfully imported'];
        } else {
            return [
                'type' => 'error',
                'message' => 'Unable to import players'
            ];
        }
    }
}
