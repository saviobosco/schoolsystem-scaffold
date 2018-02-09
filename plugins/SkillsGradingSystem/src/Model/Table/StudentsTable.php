<?php
namespace SkillsGradingSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $ClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentsAffectiveDispositionScores
 * @property \Cake\ORM\Association\HasMany $StudentsPsychomotorSkillScores
 *
 * @method \SkillsGradingSystem\Model\Entity\Student get($primaryKey, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\Student findOrCreate($search, callable $callback = null)
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

        $this->table('students');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Classes'
        ]);
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.ClassDemarcations'
        ]);

        $this->hasMany('StudentsAffectiveDispositionScores', [
            'foreignKey' => 'student_id',
            'className' => 'SkillsGradingSystem.StudentsAffectiveDispositionScores'
        ]);
        $this->hasMany('StudentsPsychomotorSkillScores', [
            'foreignKey' => 'student_id',
            'className' => 'SkillsGradingSystem.StudentsPsychomotorSkillScores'
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmpty('date_of_birth');



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
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['class_demarcation_id'], 'ClassDemarcations'));

        return $rules;
    }
}
