<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sessions Model
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
 * @property \ResultSystem\Model\Table\SubjectClassAveragesTable|\Cake\ORM\Association\HasMany $SubjectClassAverages
 *
 * @method \ResultSystem\Model\Entity\Session get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\Session newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\Session[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Session|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Session[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Session findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionsTable extends Table
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

        $this->setTable('sessions');
        $this->setDisplayField('session');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ResultRemarks', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.ResultRemarks'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentClassCounts', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentClassCounts'
        ]);
        $this->hasMany('StudentGeneralRemarks', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentGeneralRemarks'
        ]);
        $this->hasMany('StudentPublishResults', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentPublishResults'
        ]);
        $this->hasMany('StudentResultPins', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentResultPins'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'session_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('SubjectClassAverages', [
            'foreignKey' => 'session_id',
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
            ->scalar('session')
            ->requirePresence('session', 'create')
            ->notEmpty('session');

        return $validator;
    }
}
