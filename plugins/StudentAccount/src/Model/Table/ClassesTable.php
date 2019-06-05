<?php
namespace StudentAccount\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \StudentAccount\Model\Table\BlocksTable|\Cake\ORM\Association\BelongsTo $Blocks
 * @property \StudentAccount\Model\Table\ClassDemarcationsTable|\Cake\ORM\Association\HasMany $ClassDemarcations
 * @property \StudentAccount\Model\Table\FeesTable|\Cake\ORM\Association\HasMany $Fees
 * @property \StudentAccount\Model\Table\StudentAnnualPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentAnnualPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \StudentAccount\Model\Table\StudentAnnualResultsTable|\Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \StudentAccount\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentAnnualSubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \StudentAccount\Model\Table\StudentClassCountsTable|\Cake\ORM\Association\HasMany $StudentClassCounts
 * @property \StudentAccount\Model\Table\StudentGeneralRemarksTable|\Cake\ORM\Association\HasMany $StudentGeneralRemarks
 * @property \StudentAccount\Model\Table\StudentPublishResultsTable|\Cake\ORM\Association\HasMany $StudentPublishResults
 * @property \StudentAccount\Model\Table\StudentResultPinsTable|\Cake\ORM\Association\HasMany $StudentResultPins
 * @property \StudentAccount\Model\Table\StudentTermlyPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentTermlyPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \StudentAccount\Model\Table\StudentTermlyResultsTable|\Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \StudentAccount\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \StudentAccount\Model\Table\StudentTermlySubjectPositionsTable|\Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \StudentAccount\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 * @property \StudentAccount\Model\Table\StudentsAffectiveDispositionScoresTable|\Cake\ORM\Association\HasMany $StudentsAffectiveDispositionScores
 * @property \StudentAccount\Model\Table\StudentsPsychomotorSkillScoresTable|\Cake\ORM\Association\HasMany $StudentsPsychomotorSkillScores
 * @property \StudentAccount\Model\Table\SubjectClassAveragesTable|\Cake\ORM\Association\HasMany $SubjectClassAverages
 *
 * @method \StudentAccount\Model\Entity\Class get($primaryKey, $options = [])
 * @method \StudentAccount\Model\Entity\Class newEntity($data = null, array $options = [])
 * @method \StudentAccount\Model\Entity\Class[] newEntities(array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Class|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentAccount\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Class[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\Class findOrCreate($search, callable $callback = null, $options = [])
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
        $this->setEntityClass('StudentAccount\Model\Entity\Classe');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER',
            'className' => 'StudentAccount.Blocks'
        ]);
        $this->hasMany('ClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.ClassDemarcations'
        ]);
        $this->hasMany('Fees', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.Fees'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentClassCounts', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentClassCounts'
        ]);
        $this->hasMany('StudentGeneralRemarks', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentGeneralRemarks'
        ]);
        $this->hasMany('StudentPublishResults', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentPublishResults'
        ]);
        $this->hasMany('StudentResultPins', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentResultPins'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.Students'
        ]);
        $this->hasMany('StudentsAffectiveDispositionScores', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentsAffectiveDispositionScores'
        ]);
        $this->hasMany('StudentsPsychomotorSkillScores', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.StudentsPsychomotorSkillScores'
        ]);
        $this->hasMany('SubjectClassAverages', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.SubjectClassAverages'
        ]);
    }
}
