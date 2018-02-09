<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentTypes Model
 *
 * @property \FinanceManager\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 *
 * @method \FinanceManager\Model\Entity\PaymentType get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\PaymentType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentTypesTable extends Table
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

        $this->setTable('payment_types');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Payments', [
            'foreignKey' => 'payment_type_id',
            'className' => 'FinanceManager.Payments'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
}
