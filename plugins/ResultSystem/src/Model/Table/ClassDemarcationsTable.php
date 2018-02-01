<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassDemarcations Model
 *
 * @property \ResultSystem\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 *
 * @method \ResultSystem\Model\Entity\ClassDemarcation get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ClassDemarcation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassDemarcationsTable extends Table
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

        $this->setTable('class_demarcations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Classes'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ResultSystem.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ResultSystem.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ResultSystem.Students'
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

        $validator
            ->integer('capacity')
            ->requirePresence('capacity', 'create')
            ->notEmpty('capacity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['class_id'], 'Classes'));

        return $rules;
    }
}
