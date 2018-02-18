<?php
namespace FinanceManager\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\I18n\Date;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeCategories Model
 *
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\HasMany $Fees
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable|\Cake\ORM\Association\HasMany $StudentFeePayments
 *
 * @method \FinanceManager\Model\Entity\FeeCategory get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\FeeCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeeCategoriesTable extends Table
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

        $this->setTable('fee_categories');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fees', [
            'foreignKey' => 'fee_category_id',
            'className' => 'FinanceManager.Fees',
        ]);

        $this->hasMany('StudentFeePayments', [
            'foreignKey' => 'fee_category_id',
            'className' => 'FinanceManager.StudentFeePayments'
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

    public function findIncomeByFeeCategories()
    {
        return $this->find('all')
            ->select(['id','type','income_amount'])
            ->enableHydration(false)
            ->toArray();
    }

    public function deleteFeeCategory(EntityInterface $feeCategory)
    {
        return $this->delete($feeCategory);
    }

    public function getIncomeByFeeCategories($postData)
    {
        $query = $this->find('all')
            ->select(['id','type'])
            ->enableHydration(false)
            ->contain(['StudentFeePayments'=> function($q) use ($postData){
                $q->select(['id','fee_category_id','amount_paid','created']);
                switch ($postData['query']) {
                    case 'week':
                        $q->where(['WEEK(created,1)'=>(new Date())->toWeek()]);
                        return $q;
                        break;
                    case 'month':
                        $q->where(['MONTH(created)'=>(new Date())->month]);
                        return $q;
                        break;
                    case 'year':
                        $q->where(['YEAR(created)'=>(new Date())->year]);
                        return $q;
                        break;
                    default: // do nothing
                        return $q;
                }
            }]);
        return $query->toArray();
    }

    public function getIncomeByFeeCategoriesWithDateRange($startDate,$endDate)
    {
        $query = $this->find('all')->select(['id','type'])
            ->contain(['StudentFeePayments' => function ($q) use ($startDate,$endDate){
                return $q->select(['id','fee_category_id','amount_paid','created'])
                    ->where(function ($exp,$q) use ($startDate,$endDate) {
                        return $exp ->addCase(
                            [
                                $q->newExpr()->between('created',$startDate,$endDate)
                            ]
                        );
                    });
            }]);
        return $query->enableHydration(false)->toArray();

    }

}
