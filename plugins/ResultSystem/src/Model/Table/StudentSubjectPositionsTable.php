<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentSubjectPositions Model
 *
 * @property \ResultSystem\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 * @property \ResultSystem\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \ResultSystem\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \ResultSystem\Model\Table\TermsTable|\Cake\ORM\Association\BelongsTo $Terms
 * @property \ResultSystem\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentSubjectPosition findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentSubjectPositionsTable extends Table
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

        $this->setTable('student_subject_positions');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['student_id','subject_id','term_id','class_id','session_id']);

        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Subjects'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Students'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Classes'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Terms'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Sessions'
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
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

        $validator
            ->integer('position')
            ->allowEmpty('position');

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
        /*$rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));*/
        return $rules;
    }
}
