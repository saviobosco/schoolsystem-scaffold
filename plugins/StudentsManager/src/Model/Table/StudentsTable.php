<?php
namespace StudentsManager\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use StudentsManager\Model\Entity\Student;

/**
 * Students Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $ClassDemarcations
 * @property \Cake\ORM\Association\BelongsTo $States

 *
 * @method \StudentsManager\Model\Entity\Student get($primaryKey, $options = [])
 * @method \StudentsManager\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \StudentsManager\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentsManager\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Student findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
{

    const EVENT_ADDED_STUDENT = 'StudentManager.Model.Students.AddStudent';
    const EVENT_DELETED_STUDENT = 'StudentManager.Model.Students.DeleteStudent';
    const EVENT_DEACTIVATED_STUDENT = 'StudentManager.Model.Students.DeactivatedStudent';
    const EVENT_ACTIVATED_STUDENT = 'StudentManager.Model.Students.ActivatedStudent';
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

        // loads the Proffer behaviour for picture upload .
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT .'img/student-pictures', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
            ]
        ]);

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'StudentsManager.Classes'
        ]);
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'StudentsManager.ClassDemarcations'
        ]);

        $this->belongsTo('States',[
            'className' => 'StudentsManager.States',
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Religions',[
            'className' => 'StudentsManager.Religions',
            'foreignKey' => 'religion_id',
            'joinType' => 'INNER'
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
            ->requirePresence('id','create')
            ->notEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('class_id', 'create')
            ->notEmpty('class_id');

        $validator
            ->requirePresence('session_id', 'create')
            ->notEmpty('session_id');

        $validator
            ->allowEmpty('date_of_birth');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->allowEmpty('state_of_origin');

        $validator
            ->allowEmpty('religion_id');

        $validator
            ->allowEmpty('home_residence');

        $validator
            ->allowEmpty('guardian');

        $validator
            ->allowEmpty('relationship_to_guardian');

        $validator
            ->allowEmpty('occupation_of_guardian');

        $validator
            ->allowEmpty('guardian_phone_number');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('photo_dir');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        //$rules->add($rules->existsIn(['class_demarcation_id'], 'ClassDemarcations'));
        //$rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }

    public function addStudent(EntityInterface $student)
    {
        // save student and dispatch add
        $savedStudent = $this->save($student);
        if ( $savedStudent) {
            $event = new Event(self::EVENT_ADDED_STUDENT,$this,['student'=>$student]);
            $this->getEventManager()->dispatch($event);
            return $savedStudent;
        }
        return false;
    }


    /**
     * @return array
     * This method is used to get all un active student accounts.
     */
    public function findUnActiveStudents()
    {
        return $this->find('all')
            ->select(['id','first_name','last_name','gender','class_id'])
            ->where(['status' => 0])
            ->contain(['Classes'])
            ->orderAsc('class_id')
            ->enableHydration(false)
            ->toArray();
    }

    public function deactivateStudent(Student $student )
    {
        $student->status = 0;
        $student = $this->save($student);
        if ($student) {
            $event = new Event(self::EVENT_DEACTIVATED_STUDENT,$this,['student'=>$student]);
            $this->getEventManager()->dispatch($event);
            return true;
        }
        return false;
    }

    public function activateStudent(Student $student)
    {
        $student->status = 1;
        $student = $this->save($student);
        if ($student) {
            $event = new Event(self::EVENT_ACTIVATED_STUDENT,$this,['student'=>$student]);
            $this->getEventManager()->dispatch($event);
            return true;
        }
        return false;
    }

    public function changeStudentsClass($class_id,$student_ids)
    {
        $returnData['success'] = 1;
        // get the students one by one
        foreach ( $student_ids as $student_id) {
            $student = $this->find()->select(['id','class_id'])->where(['id'=>$student_id])->first();
            // change the class
            if ( !$student ) {
                continue;
            }
            if ( $student->class_id == $class_id ) {
                $returnData['success'] = 0;
                break;
            }
            $student->class_id = $class_id;
            $this->save($student);
        }
        return $returnData;
    }
}
