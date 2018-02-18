<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;


/**
 * Incomes Model
 *
 * @method \FinanceManager\Model\Entity\Income get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Income newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Income[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Income|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Income patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Income[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Income findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncomesTable extends Table
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

        $this->setTable('incomes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('week')
            ->requirePresence('week', 'create')
            ->notEmpty('week');

        $validator
            ->integer('month')
            ->requirePresence('month', 'create')
            ->notEmpty('month');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        return $validator;
    }

    public function getIncomeWithPassedValue($postData)
    {
        $query = $this->find()->enableHydration(false);
        // checking which value was passed to query
        switch ($postData['query'] ) {
            case 'week':
                $query->where(['WEEK(created,1)'=>(new Date())->toWeek()]);
                break;
            case 'month':
                $query->where(['MONTH(created)'=>(new Date())->month]);
                break;
            case 'year':
                $query->where(['YEAR(created)'=>(new Date())->year]);
                break;
            default:
                // perform nothing
        }
        return $query->toArray();
    }

    public function getIncomeWithDateRange($startDate,$endDate)
    {
        $query = $this->find()
            ->enableHydration(false)
            ->where(function ($exp,$q) use ($startDate,$endDate) {
                return $exp ->addCase(
                    [
                        $q->newExpr()->between('created',$startDate,$endDate)
                    ]
                );
            });
        return $query->toArray();
    }

}
