<?php
namespace StudentAccount\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentResultPins Model
 *
 * @property \StudentAccount\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \StudentAccount\Model\Table\TermsTable|\Cake\ORM\Association\BelongsTo $Terms
 * @property \StudentAccount\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 * @property \StudentAccount\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 *
 * @method \StudentAccount\Model\Entity\StudentResultPin get($primaryKey, $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin newEntity($data = null, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin[] newEntities(array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentResultPin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentResultPinsTable extends Table
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

        $this->setTable('student_result_pins');
        $this->setDisplayField('serial_number');
        $this->setPrimaryKey('serial_number');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'className' => 'StudentAccount.Students'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'className' => 'StudentAccount.Terms'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'className' => 'StudentAccount.Sessions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'className' => 'StudentAccount.Classes'
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
            ->integer('serial_number')
            ->allowEmpty('serial_number', 'create');

        $validator
            ->integer('pin')
            ->requirePresence('pin', 'create')
            ->notEmpty('pin');

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
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));

        return $rules;
    }
}
