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
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
