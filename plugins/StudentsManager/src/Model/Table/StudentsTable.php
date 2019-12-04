<?php
namespace StudentsManager\Model\Table;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use StudentsManager\Model\Entity\Student;
use UsersManager\Exception\UserExistsException;
use Cake\Database\Type;

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
        Type::map('file', 'App\Database\Type\FileType');
        Type::map('serialize', 'App\Database\Type\SerializeType');
        $this->getSchema()->setColumnType('photo', 'file');
        $this->getSchema()->setColumnType('medical_issues', 'serialize');

        // loads the Proffer behaviour for picture upload .
        /*$this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT .'img/student-pictures', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
            ]
        ]);*/

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'StudentsManager.Classes'
        ]);

        $this->belongsTo('States',[
            'className' => 'StudentsManager.States',
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Religions',[
            'className' => 'StudentsManager.Religions',
            'foreignKey' => 'religion_id',
            'joinType' => 'INNER',
            'propertyName' => 'student_religion_id'
        ]);

        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlyResults'
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
        return $rules;
    }

    public function beforeMarshal(Event $event, $data, $options)
    {
        $data['year_of_graduation'] = $data['year_of_graduation']['year'];

    }

    public function beforeSave(Event $event, $entity, $options)
    {
        /*if (is_array($entity['photo'])) {
            if (!empty($entity['photo']['name'])) {
                $imageDetails = pathinfo($entity['photo']['name']);
                if (in_array( $imageDetails['extension'], ['png', 'jpg', 'jpeg'])) {
                    $adapter = new Local(WWW_ROOT.'img/schools/'. Configure::read('sub_domain') .'/student-pictures/');
                    $flysystem = new Filesystem($adapter);
                    $photo_name = $entity->id.'.jpg';
                    $destination = WWW_ROOT.'img/schools/'. Configure::read('sub_domain') .'/student-pictures/'.$photo_name;
                    $photo = $flysystem->put($photo_name, file_get_contents($entity['photo']['tmp_name']));
                    dd($photo);
                    if ( move_uploaded_file($entity['photo']['tmp_name'], $destination) ) {
                        $entity->photo = Configure::read('App.fullBaseUrl')
                            .'/img/schools/'.
                            Configure::read('sub_domain').'/student-pictures/'.$photo_name;
                    } else {
                        $previous_photo = $entity->getOriginal('photo');
                        if ($previous_photo) {
                            $file = new File($previous_photo);
                            dd($file);
                            $file->delete();
                        }
                        unset($entity->photo);
                    }
                }
            }
        }*/
    }

    public function addStudent(EntityInterface $student)
    {
        //a hack to make the id unique validation work
        // because the id is same as the primary key, $rules->add($rules->isUnique(['id'])); will not work fine
        $this->setPrimaryKey('created');
        // check if that student id is as username in the users table
        //$userTable = TableRegistry::get('UsersManager.Accounts');
        /*$studentUser = $userTable->query()->where(['username' => $student['id']])->first();
        if ($studentUser instanceof Entity) {
            // throw user exist error
            throw new UserExistsException(['username' => $student['id']]);
        }*/
        return $this->save($student);
        /*if ( $savedStudent) {
            // create new user record
            $userTable->save($userTable->newEntity([
                'username'=> $student['id'],
                'password' => $student['id'],
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'role' => 'student',
                'active' => 1
            ]));
            $event = new Event(self::EVENT_ADDED_STUDENT,$this,['student'=>$student]);
            $this->getEventManager()->dispatch($event);
            return $savedStudent;
        }*/
        //return false;
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
            if ( $student->class_id === $class_id ) {
                $returnData['success'] = 0;
                break;
            }
            $student->class_id = $class_id;
            $this->save($student, ['checkRules' => false]);
        }
        return $returnData;
    }

    public function getBloodGroups()
    {
        return [
            'A-' => 'A Negative (A-)',
            'A+' => 'A Positive (A+)',
            'AB-' => 'AB Negative (AB-)',
            'AB+' => 'AB Positive (AB+)',
            'B-' => 'B Negative (B-)',
            'B+' => 'B Positive (B+)',
            'O-' => 'O Negative (O-)',
            'O+' => 'O Positive (O+)',
        ];
    }

    public function getGenotypes()
    {
        return [
            'AS' => 'AS',
            'AA' => 'AA',
            'SS' => 'SS'
        ];
    }

    public function getSponsorRelations()
    {
        return [
            'AUNT' => 'AUNT',
            'BROTHER' => 'BROTHER',
            'DAUGHTER' => 'DAUGHTER',
            'FATHER' => 'FATHER',
            'HUSBAND' => 'HUSBAND',
            'MOTHER' => 'MOTHER',
            'SELF' => 'SELF',
            'SISTER' => 'SISTER',
            'SON' => 'SON',
            'UNCLE' => 'UNCLE',
            'WIFE' => 'WIFE'
        ];
    }

    public function uploadStudentPhoto($entity, $student_id)
    {
        if (empty($entity['name'])) {
            return false;
        }
        $imageDetails = pathinfo($entity['name']);
        if (!in_array( $imageDetails['extension'], ['png', 'jpg', 'jpeg'])) {
          return false; // notify user that this is not a picture
        }
        // check for picture size
        $fileSystem = new Filesystem(new Local(WWW_ROOT.'img/schools/'. Configure::read('sub_domain') .'/student-pictures/'));
        $photo_name = $student_id.'.jpg';
        $destination = Configure::read('App.fullBaseUrl').'/img/schools/'. Configure::read('sub_domain') .'/student-pictures/'.$photo_name;
        // process picture
        // save picture
        $photo = $fileSystem->put($photo_name, file_get_contents($entity['tmp_name']));
        if ($photo) {
            return $destination;
        }
        return false;
    }

    public function searchStudentWithCriteria($getQuery)
    {
        $StudentsQuery = $this->query()
            ->select(['id', 'first_name', 'last_name', 'gender','class_id','status'])
            ->contain(['Classes' => ['fields' => ['id', 'class']]]);

        if (isset($getQuery['Include']['admission_number']) && $getQuery['Include']['admission_number']) {
            $StudentsQuery->where(['Students.id' => $getQuery['admission_number']]);
        }else {
            if (isset($getQuery['Include']['first_name']) && $getQuery['Include']['first_name']) {
                $StudentsQuery->where(['first_name LIKE' => '%'. $getQuery['first_name'].'%']);
            }
            if (isset($getQuery['Include']['last_name']) && $getQuery['Include']['last_name']) {
                $StudentsQuery->where(['last_name LIKE' => '%'. $getQuery['last_name'].'%']);
            }
        }
        if (isset($getQuery['Include']['class_id']) && $getQuery['Include']['class_id']) {
            $StudentsQuery->where(['class_id' => $getQuery['class_id']]);
        }

        $isAdmissionNumber = ((isset($getQuery['Include']['admission_number']) && !empty($getQuery['Include']['admission_number']) )
            && (isset($getQuery['admission_number']) && !empty($getQuery['admission_number'])));

        $isFirstName = ( (isset($getQuery['Include']['first_name']) && !empty($getQuery['Include']['first_name']))
            && (isset($getQuery['first_name']) && !empty($getQuery['first_name'])));

        $isLastName = ( (isset($getQuery['Include']['last_name']) && !empty($getQuery['Include']['last_name'])) &&
        (isset($getQuery['last_name']) && !empty($getQuery['last_name'])));

        $isClass = ( (isset($getQuery['Include']['class_id']) && !empty($getQuery['Include']['class_id'])) &&
        (isset($getQuery['class_id']) && !empty($getQuery['class_id'])));

        if ($isAdmissionNumber || $isFirstName || $isLastName || $isClass ) {
            return $StudentsQuery;
        }
        return [];
    }
}
