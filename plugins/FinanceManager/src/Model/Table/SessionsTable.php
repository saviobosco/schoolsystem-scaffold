<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;

/**
 * Sessions Model
 *
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\HasMany $Fees
 *
 * @method \FinanceManager\Model\Entity\Session get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Session newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Session[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Session|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Session[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Session findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionsTable extends Table
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

        $this->setTable('sessions');
        $this->setDisplayField('session');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fees', [
            'foreignKey' => 'session_id',
            'className' => 'FinanceManager.StudentFees'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'session_id',
            'className' => 'FinanceManager.Students'
        ]);

        /*$this->belongsTo('CreatedByUser',[
            'className' => 'Accounts',
            'foreignKey' => 'created_by'
        ]);

        $this->belongsTo('ModifiedByUser',[
            'className' => 'Accounts',
            'foreignKey' => 'modified_by'
        ]);*/
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
            ->requirePresence('session', 'create')
            ->notEmpty('session');


        return $validator;
    }

    public function deleteSession(EntityInterface $session)
    {
        if ( (bool)$this->Fees->find()->where(['session_id'=>$session->id])->first()) {
            throw new \PDOException;
        }
        $this->delete($session);
        return true;
    }
}
