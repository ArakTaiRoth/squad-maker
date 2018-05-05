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
}
