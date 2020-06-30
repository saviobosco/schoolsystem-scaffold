<?php


namespace ELearning\Model\Table;


use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fees Model
 *
 * @property \ResultSystem\Model\Table\TermsTable|\Cake\ORM\Association\BelongsTo $Terms
 * @property \ResultSystem\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \ResultSystem\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 * @property \ResultSystem\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \ELearning\Model\Entity\Lecture get($primaryKey, $options = [])
 * @method \ELearning\Model\Entity\Lecture newEntity($data = null, array $options = [])
 * @method \ELearning\Model\Entity\Lecture[] newEntities(array $data, array $options = [])
 * @method \ELearning\Model\Entity\Lecture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ELearning\Model\Entity\Lecture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ELearning\Model\Entity\Lecture[] patchEntities($entities, array $data, array $options = [])
 * @method \ELearning\Model\Entity\Lecture findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

class LecturesTable extends Table
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

        $this->setTable('e_learning_lectures');
        $this->setDisplayField('topic');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Sessions'
        ]);

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
            ->requirePresence('topic', 'create')
            ->notEmpty('purpose');

        $validator
            ->requirePresence('introduction', 'create')
            ->notEmpty('introduction');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->integer('subject_id')
            ->requirePresence('subject_id', 'create')
            ->notEmpty('subject_id');

        $validator
            ->integer('session_id')
            ->requirePresence('session_id', 'create')
            ->notEmpty('session_id');

        $validator
            ->integer('class_id')
            ->requirePresence('class_id', 'create')
            ->notEmpty('class_id');

        $validator
            ->integer('term_id')
            ->requirePresence('term_id', 'create')
            ->notEmpty('term_id');

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
        return $rules;
    }
}
