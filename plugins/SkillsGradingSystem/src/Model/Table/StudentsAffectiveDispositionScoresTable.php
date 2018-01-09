<?php
namespace SkillsGradingSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentsAffectiveDispositionScores Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Affectives
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore get($primaryKey, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore newEntity($data = null, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore[] newEntities(array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore[] patchEntities($entities, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\StudentsAffectiveDispositionScore findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsAffectiveDispositionScoresTable extends Table
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

        $this->table('students_affective_disposition_scores');
        $this->displayField('id');
        $this->primaryKey(['student_id','affective_id','class_id','term_id','session_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'SkillsGradingSystem.Students'
        ]);
        $this->belongsTo('Affectives', [
            'foreignKey' => 'affective_id',
            'joinType' => 'INNER',
            'className' => 'SkillsGradingSystem.AffectiveDispositions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'App.Classes'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Terms'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
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
            ->integer('score');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['affective_id'], 'Affectives'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }

    public function getStudentAffectiveDepositions($student_id,$session,$class,$term)
    {
        return $this->find('all')
            ->where(['student_id' => $student_id,
                'session_id' => @$session,
                'class_id' => @$class,
                'term_id'    => @$term
            ])->contain(['Affectives']);
    }
}
