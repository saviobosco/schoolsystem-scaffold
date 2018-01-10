<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentAnnualPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \ResultSystem\Model\Table\StudentAnnualResultsTable|\Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentAnnualSubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \ResultSystem\Model\Table\StudentClassCountsTable|\Cake\ORM\Association\HasMany $StudentClassCounts
 * @property \ResultSystem\Model\Table\StudentGeneralRemarksTable|\Cake\ORM\Association\HasMany $StudentGeneralRemarks
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable|\Cake\ORM\Association\HasMany $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentResultPinsTable|\Cake\ORM\Association\HasMany $StudentResultPins
 * @property \ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentTermlyPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable|\Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \ResultSystem\Model\Table\StudentTermlySubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \ResultSystem\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 * @property \ResultSystem\Model\Table\SubjectClassAveragesTable|\Cake\ORM\Association\HasMany $SubjectClassAverages
 *
 * @method \ResultSystem\Model\Entity\Classe get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\Classe newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\Classe[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Classe|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\Classe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Classe[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Classe findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassesTable extends Table
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

        $this->setTable('classes');
        $this->setDisplayField('class');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Blocks'
        ]);
        $this->hasMany('ClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.ClassDemarcations'
        ]);
        $this->hasMany('Fees', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.Fees'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentClassCounts', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentClassCounts'
        ]);
        $this->hasMany('StudentGeneralRemarks', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentGeneralRemarks'
        ]);
        $this->hasMany('StudentPublishResults', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentPublishResults'
        ]);
        $this->hasMany('StudentResultPins', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentResultPins'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.Students'
        ]);
        $this->hasMany('StudentsAffectiveDispositionScores', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentsAffectiveDispositionScores'
        ]);
        $this->hasMany('StudentsPsychomotorSkillScores', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.StudentsPsychomotorSkillScores'
        ]);
        $this->hasMany('SubjectClassAverages', [
            'foreignKey' => 'class_id',
            'className' => 'ResultSystem.SubjectClassAverages'
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
            ->scalar('class')
            ->requirePresence('class', 'create')
            ->notEmpty('class');

        $validator
            ->integer('no_of_subjects')
            ->requirePresence('no_of_subjects', 'create')
            ->notEmpty('no_of_subjects');

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
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));

        return $rules;
    }
}
