<?php
namespace UsersManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable;

/**
 * Users Model
 *
 *
 * @method \UsersManager\Model\Entity\Account get($primaryKey, $options = [])
 * @method \UsersManager\Model\Entity\Account newEntity($data = null, array $options = [])
 * @method \UsersManager\Model\Entity\Account[] newEntities(array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Account|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UsersManager\Model\Entity\Account patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Account[] patchEntities($entities, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Account findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountsTable extends UsersTable
{

    protected $roles = [
        'user' => 'User',
        'student' => 'Student',
        'teacher' => 'Teacher',
        'admin' => 'Admin',
        'parent' => 'Parent'
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany('Subjects', [
            'className' => 'SubjectsManager.Subjects',
            'joinTable' => 'teachers_subjects',
            'foreignKey' => 'teacher_id',
            'bindingKey' => 'id',
            'saveStrategy' => 'replace'
        ]);

        $this->belongsToMany('Classes', [
            'className' => 'ClassManager.Classes',
            'joinTable' => 'teachers_classes',
            'foreignKey' => 'teacher_id',
            'bindingKey' => 'id',
            'saveStrategy' => 'replace'
        ]);

        $this->hasMany('TeachersSubjectsClassesPermissions',[
            'className' => 'UsersManager.TeachersSubjectsClassesPermissions',
            'foreignKey' => 'teacher_id',
            'saveStrategy' => 'replace'
        ]);
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function checkIfRecordExists($record_id)
    {
        return (bool)$this->find()->where(['record_id'=>$record_id])->first();
    }

}
