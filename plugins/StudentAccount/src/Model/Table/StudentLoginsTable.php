<?php
namespace StudentAccount\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\EntityInterface;
/**
 * StudentLogins Model
 *
 * @property \StudentAccount\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \StudentAccount\Model\Entity\StudentLogin get($primaryKey, $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin newEntity($data = null, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin[] newEntities(array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentAccount\Model\Entity\StudentLogin findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentLoginsTable extends Table
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

        $this->setTable('student_logins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'StudentAccount.Students'
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
            ->scalar('username')
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

        return $validator;
    }

    /**
     * Adds some rules for password confirm
     * @param Validator $validator Cake validator object.
     * @return Validator
     */
    public function validationPasswordConfirm(Validator $validator)
    {
        $validator
            ->requirePresence('password_confirm', 'create')
            ->notEmpty('password_confirm');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('password', [
                'password_confirm_check' => [
                    'rule' => ['compareWith', 'password_confirm'],
                    'message' => __d('CakeDC/Users', 'Your password does not match your confirm password. Please try again'),
                    'allowEmpty' => false
                ]]);

        return $validator;
    }

    /**
     * Adds rules for current password
     *
     * @param Validator $validator Cake validator object.
     * @return Validator
     */
    public function validationCurrentPassword(Validator $validator)
    {
        $validator
            ->notEmpty('current_password');

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
        //$rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }

    /**
     * Change password method
     *
     * @param EntityInterface $user user data.
     * @throws WrongPasswordException
     * @return mixed
     */
    public function changePassword(EntityInterface $user)
    {
        try {
            $currentUser = $this->get($user->id, [
                'contain' => []
            ]);
        } catch (RecordNotFoundException $e) {
            throw new UserNotFoundException(__d('CakeDC/Users', "User not found"));
        }
        if (!empty($user->current_password)) {
            if (!$user->checkPassword($user->current_password, $currentUser->password)) {
                throw new WrongPasswordException(__d('CakeDC/Users', 'The current password does not match'));
            }
            if ($user->current_password === $user->password_confirm) {
                throw new WrongPasswordException(__d(
                    'CakeDC/Users',
                    'You cannot use the current password as the new one'
                ));
            }
        }
        $user = $this->save($user);
        /*if (!empty($user)) {
            $user = $this->_removeValidationToken($user);
        }*/

        return $user;
    }
}
