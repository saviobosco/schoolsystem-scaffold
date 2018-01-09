<?php
namespace ClassManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \ClassManager\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 * @property \ClassManager\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \ClassManager\Model\Table\ClassDemarcationsTable|\Cake\ORM\Association\BelongsTo $ClassDemarcations
 * @property \ClassManager\Model\Table\SessionAdmittedsTable|\Cake\ORM\Association\BelongsTo $SessionAdmitteds
 * @property \ClassManager\Model\Table\GraduatedSessionsTable|\Cake\ORM\Association\BelongsTo $GraduatedSessions
 * @property \ClassManager\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \ClassManager\Model\Table\StudentAnnualPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \ClassManager\Model\Table\StudentAnnualPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \ClassManager\Model\Table\StudentAnnualResultsTable|\Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \ClassManager\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \ClassManager\Model\Table\StudentAnnualSubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \ClassManager\Model\Table\StudentGeneralRemarksTable|\Cake\ORM\Association\HasMany $StudentGeneralRemarks
 * @property \ClassManager\Model\Table\StudentPublishResultsTable|\Cake\ORM\Association\HasMany $StudentPublishResults
 * @property \ClassManager\Model\Table\StudentResultPinsTable|\Cake\ORM\Association\HasMany $StudentResultPins
 * @property \ClassManager\Model\Table\StudentTermlyPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \ClassManager\Model\Table\StudentTermlyPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \ClassManager\Model\Table\StudentTermlyResultsTable|\Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \ClassManager\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \ClassManager\Model\Table\StudentTermlySubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \ClassManager\Model\Table\StudentsAffectiveDispositionScoresTable|\Cake\ORM\Association\HasMany $StudentsAffectiveDispositionScores
 * @property \ClassManager\Model\Table\StudentsPsychomotorSkillScoresTable|\Cake\ORM\Association\HasMany $StudentsPsychomotorSkillScores
 *
 * @method \ClassManager\Model\Entity\Student get($primaryKey, $options = [])
 * @method \ClassManager\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \ClassManager\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ClassManager\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Sessions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Classes'
        ]);
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ClassManager.ClassDemarcations'
        ]);
        $this->belongsTo('SessionAdmitteds', [
            'foreignKey' => 'session_admitted_id',
            'className' => 'ClassManager.SessionAdmitteds'
        ]);
        $this->belongsTo('GraduatedSessions', [
            'foreignKey' => 'graduated_session_id',
            'className' => 'ClassManager.GraduatedSessions'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'className' => 'ClassManager.States'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentGeneralRemarks', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentGeneralRemarks'
        ]);
        $this->hasMany('StudentPublishResults', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentPublishResults'
        ]);
        $this->hasMany('StudentResultPins', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentResultPins'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('StudentsAffectiveDispositionScores', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentsAffectiveDispositionScores'
        ]);
        $this->hasMany('StudentsPsychomotorSkillScores', [
            'foreignKey' => 'student_id',
            'className' => 'ClassManager.StudentsPsychomotorSkillScores'
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
            ->scalar('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('first_name')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmpty('date_of_birth');

        $validator
            ->scalar('gender')
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('state_of_origin')
            ->allowEmpty('state_of_origin');

        $validator
            ->scalar('religion')
            ->requirePresence('religion', 'create')
            ->notEmpty('religion');

        $validator
            ->scalar('home_residence')
            ->requirePresence('home_residence', 'create')
            ->notEmpty('home_residence');

        $validator
            ->scalar('guardian')
            ->allowEmpty('guardian');

        $validator
            ->scalar('relationship_to_guardian')
            ->allowEmpty('relationship_to_guardian');

        $validator
            ->scalar('occupation_of_guardian')
            ->allowEmpty('occupation_of_guardian');

        $validator
            ->scalar('guardian_phone_number')
            ->allowEmpty('guardian_phone_number');

        $validator
            ->scalar('photo')
            ->allowEmpty('photo');

        $validator
            ->scalar('photo_dir')
            ->allowEmpty('photo_dir');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('graduated')
            ->allowEmpty('graduated');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['class_demarcation_id'], 'ClassDemarcations'));
        $rules->add($rules->existsIn(['session_admitted_id'], 'SessionAdmitteds'));
        $rules->add($rules->existsIn(['graduated_session_id'], 'GraduatedSessions'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
