<?php
namespace BankSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 * @property \BankSystem\Model\Table\AccountHoldersTable|\Cake\ORM\Association\HasMany $AccountHolders
 *
 * @method \BankSystem\Model\Entity\Student get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
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

        $this->setTable('students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AccountHolders', [
            'foreignKey' => 'student_id',
            'className' => 'BankSystem.AccountHolders'
        ]);
    }

}
