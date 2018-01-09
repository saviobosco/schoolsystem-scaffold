<?php
namespace StudentsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \StudentsManager\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 *
 * @method \StudentsManager\Model\Entity\State get($primaryKey, $options = [])
 * @method \StudentsManager\Model\Entity\State newEntity($data = null, array $options = [])
 * @method \StudentsManager\Model\Entity\State[] newEntities(array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\State|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentsManager\Model\Entity\State patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\State[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\State findOrCreate($search, callable $callback = null, $options = [])
 */
class StatesTable extends Table
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

        $this->setTable('states');
        $this->setDisplayField('state');
        $this->setPrimaryKey('id');

        $this->hasMany('Students', [
            'foreignKey' => 'state_id',
            'className' => 'StudentsManager.Students'
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
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        return $validator;
    }
}
