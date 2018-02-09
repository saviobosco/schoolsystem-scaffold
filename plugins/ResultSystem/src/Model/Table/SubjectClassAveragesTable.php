<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubjectClassAverages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\SubjectClassAverage get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\SubjectClassAverage findOrCreate($search, callable $callback = null)
 */
class SubjectClassAveragesTable extends Table
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

        $this->table('subject_class_averages');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Subjects'
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
            ->integer('student_count')
            ->requirePresence('student_count', 'create')
            ->notEmpty('student_count');

        $validator
            ->numeric('class_average')
            ->allowEmpty('class_average');

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
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }
}
