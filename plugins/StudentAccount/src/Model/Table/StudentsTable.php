<?php
namespace StudentAccount\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \StudentAccount\Model\Table\ReligionsTable|\Cake\ORM\Association\BelongsTo $Religions
 * @property \StudentAccount\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \StudentAccount\Model\Table\ClassDemarcationsTable|\Cake\ORM\Association\BelongsTo $ClassDemarcations
 * @property \StudentAccount\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \StudentAccount\Model\Table\AccountHoldersTable|\Cake\ORM\Association\HasMany $AccountHolders
 * @property \StudentAccount\Model\Table\ReceiptsTable|\Cake\ORM\Association\HasMany $Receipts
 * @property \StudentAccount\Model\Table\StudentAnnualPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentAnnualPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \StudentAccount\Model\Table\StudentAnnualResultsTable|\Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \StudentAccount\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentAnnualSubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \StudentAccount\Model\Table\StudentFeesTable|\Cake\ORM\Association\HasMany $StudentFees
 * @property \StudentAccount\Model\Table\StudentGeneralRemarksTable|\Cake\ORM\Association\HasMany $StudentGeneralRemarks
 * @property \StudentAccount\Model\Table\StudentPublishResultsTable|\Cake\ORM\Association\HasMany $StudentPublishResults
 * @property \StudentAccount\Model\Table\StudentResultPinsTable|\Cake\ORM\Association\HasMany $StudentResultPins
 * @property \StudentAccount\Model\Table\StudentTermlyPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentTermlyPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \StudentAccount\Model\Table\StudentTermlyResultsTable|\Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \StudentAccount\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentTermlySubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \StudentAccount\Model\Table\StudentsAffectiveDispositionScoresTable|\Cake\ORM\Association\HasMany $StudentsAffectiveDispositionScores
 * @property \StudentAccount\Model\Table\StudentsPsychomotorSkillScoresTable|\Cake\ORM\Association\HasMany $StudentsPsychomotorSkillScores
 *
 * @method \StudentAccount\Model\Entity\Student get($primaryKey, $options = [])
 * @method \StudentAccount\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \StudentAccount\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentAccount\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
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

        $this->belongsTo('Religions', [
            'foreignKey' => 'religion_id',
            'className' => 'StudentAccount.Religions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'StudentAccount.Classes'
        ]);
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'StudentAccount.ClassDemarcations'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'className' => 'StudentAccount.States'
        ]);
        $this->hasMany('AccountHolders', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.AccountHolders'
        ]);
        $this->hasMany('Receipts', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.Receipts'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentFees', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentFees'
        ]);
        $this->hasMany('StudentGeneralRemarks', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentGeneralRemarks'
        ]);
        $this->hasMany('StudentPublishResults', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentPublishResults'
        ]);
        $this->hasMany('StudentResultPins', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentResultPins'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('StudentsAffectiveDispositionScores', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentsAffectiveDispositionScores'
        ]);
        $this->hasMany('StudentsPsychomotorSkillScores', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.StudentsPsychomotorSkillScores'
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
            ->allowEmpty('id', 'create');

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
            ->allowEmpty('date_of_birth');

        $validator
            ->scalar('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('state_of_origin')
            ->allowEmpty('state_of_origin');

        $validator
            ->scalar('home_residence')
            ->allowEmpty('home_residence');

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
        $rules->add($rules->existsIn(['religion_id'], 'Religions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['class_demarcation_id'], 'ClassDemarcations'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
