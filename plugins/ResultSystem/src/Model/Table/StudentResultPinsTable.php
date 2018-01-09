<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ResultSystem\Model\Entity\StudentResultPin;

/**
 * StudentResultPins Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Classes
 *
 * @method \ResultSystem\Model\Entity\StudentResultPin get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentResultPin findOrCreate($search, callable $callback = null)
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

        $this->table('student_result_pins');
        $this->displayField('pin');
        $this->primaryKey('pin');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'className' => 'ResultSystem.Students',
            'foreignKey' => 'student_id'
        ]);
        $this->belongsTo('Terms', [
            'className' => 'ResultSystem.Terms',
            'foreignKey' => 'term_id'
        ]);
        $this->belongsTo('Sessions', [
            'className' => 'App.Sessions',
            'foreignKey' => 'session_id'
        ]);
        $this->belongsTo('Classes', [
            'className' => 'App.Classes',
            'foreignKey' => 'class_id'
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
            ->integer('serial_key')
            ->requirePresence('serial_key', 'create')
            ->notEmpty('serial_key');

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
        /*$rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes')); */

        return $rules;
    }

    public function savePin($pin){
        $saved = $this->newEntity();
        $saved->pin = $pin;
        if($this->save($saved)){
            return true;
        }
        return false;
    }

    public function checkPin($pin)
    {
        return $this->find()->where(['pin'=>$pin])->first();
    }


    public function updateStudentPin( StudentResultPin $pin,$student_id,$session_id,$class_id,$term_id)
    {
        $newData = [
            'student_id'=>$student_id,
            'session_id' => $session_id,
            'class_id' => $class_id,
            'term_id' => $term_id
        ];
        $result = $this->patchEntity($pin,$newData);
        if($this->save($result)){
            return true;
        }
        return false;
    }
}
