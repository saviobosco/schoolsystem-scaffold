<?php
namespace SubjectsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blocks Model
 *
 * @property \SubjectsManager\Model\Table\ClassesTable|\Cake\ORM\Association\HasMany $Classes
 * @property \SubjectsManager\Model\Table\SubjectsTable|\Cake\ORM\Association\HasMany $Subjects
 *
 * @method \SubjectsManager\Model\Entity\Block get($primaryKey, $options = [])
 * @method \SubjectsManager\Model\Entity\Block newEntity($data = null, array $options = [])
 * @method \SubjectsManager\Model\Entity\Block[] newEntities(array $data, array $options = [])
 * @method \SubjectsManager\Model\Entity\Block|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SubjectsManager\Model\Entity\Block patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SubjectsManager\Model\Entity\Block[] patchEntities($entities, array $data, array $options = [])
 * @method \SubjectsManager\Model\Entity\Block findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlocksTable extends Table
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

        $this->setTable('blocks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Classes', [
            'foreignKey' => 'block_id',
            'className' => 'SubjectsManager.Classes'
        ]);
        $this->hasMany('Subjects', [
            'foreignKey' => 'block_id',
            'className' => 'SubjectsManager.Subjects'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
