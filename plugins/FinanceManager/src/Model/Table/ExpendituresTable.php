<?php
namespace FinanceManager\Model\Table;

use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expenditures Model
 *
 * @property \FinanceManager\Model\Table\ExpenditureCategoriesTable|\Cake\ORM\Association\BelongsTo $ExpenditureCategories
 *
 * @method \FinanceManager\Model\Entity\Expenditure get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Expenditure findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExpendituresTable extends Table
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

        $this->setTable('expenditures');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by' => 'new',
                    'modified_by' => 'always'
                ]
            ],
        ]);

        $this->belongsTo('ExpenditureCategories', [
            'foreignKey' => 'expenditure_category_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.ExpenditureCategories'
        ]);

        $this->belongsTo('CreatedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'created_by',
        ]);

        $this->belongsTo('ModifiedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'modified_by'
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
            ->requirePresence('purpose', 'create')
            ->notEmpty('purpose');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['expenditure_category_id'], 'ExpenditureCategories'));

        return $rules;
    }

    /***
     * @param Event $event
     * @param $data
     * The function is fired by the cakephp system automatically before a
     * request data is converted to entities
     */
    public function beforeMarshal(Event $event, $data )
    {
        if ( !empty($data['date'] )) {
            $data['date'] = new Date($data['date']); // Converts the birth date Date properly
        }
    }

    /**
     * @param $data
     * @return array
     * This function returns the expenditure analysis using the passed value
     * [week, month, year ]
     */
    public function getExpenditureWithPassedValue($data)
    {
        $query = $this->find()
            ->enableHydration(false)
        ->select(['Expenditures.id','Expenditures.expenditure_category_id','Expenditures.purpose','Expenditures.date','Expenditures.amount'])
            ->contain(['ExpenditureCategories'=>function($q){
                return $q->select(['ExpenditureCategories.id','ExpenditureCategories.type']);}]);
        // checking which value was passed to query
        switch ($data['query'] ) {
            case 'week':
                $query->where(['WEEK(Expenditures.created,1)'=>(new Date())->toWeek()]);
                break;
            case 'month':
                $query->where(['MONTH(Expenditures.created)'=>(new Date())->month]);
                break;
            case 'year':
                $query->where(['YEAR(Expenditures.created)'=>(new Date())->year]);
                break;
            default:
                // perform nothing
        }
        return $query->toArray();
    }

    public function getExpenditureWithDateRange($startDate,$endDate)
    {
        $query = $this->find()
            ->enableHydration(false)
            ->select(['Expenditures.id','Expenditures.expenditure_category_id','Expenditures.purpose','Expenditures.date','Expenditures.amount'])
            ->contain(['ExpenditureCategories'=>function($q){
                return $q->select(['ExpenditureCategories.id','ExpenditureCategories.type']);}])
            // checking which value was passed to query
            ->where(function ($exp,$q) use ($startDate,$endDate) {
                return $exp ->addCase(
                    [
                        $q->newExpr()->between('Expenditures.created',$startDate,$endDate)
                    ]
                );
            });
        return $query->toArray();
    }

    public function getExpenditureWithPassedValueArrangedByExpenditureCat($data)
    {
        $query = $this->find()
            ->enableHydration(false)
            ->select(['Expenditures.expenditure_category_id', 'Expenditures.amount'])
            ->contain(['ExpenditureCategories' => function ($q) {
                return $q->select(['ExpenditureCategories.id', 'ExpenditureCategories.type']);
            }]);
        // checking which value was passed to query
        switch ($data['query'] ) {
            case 'week':
                $query->where(['WEEK(Expenditures.created,1)'=>(new Date())->toWeek()]);
                break;
            case 'month':
                $query->where(['MONTH(Expenditures.created)'=>(new Date())->month]);
                break;
            case 'year':
                $query->where(['YEAR(Expenditures.created)'=>(new Date())->year]);
                break;
            default:
                // perform nothing
        }
        return $query->groupBy('expenditure_category_id')->toArray();
    }

    public function getExpenditureWithDateRangeArrangedByExpenditureCat($startDate,$endDate)
    {
        $query = $this->find()
            ->enableHydration(false)
            ->select(['Expenditures.expenditure_category_id','Expenditures.amount'])
            ->contain(['ExpenditureCategories'=>function($q){
                return $q->select(['ExpenditureCategories.id','ExpenditureCategories.type']);
            }])
            // checking which value was passed to query
            ->where(function ($exp,$q) use ($startDate,$endDate) {
                return $exp ->addCase(
                    [
                        // todo : refactor this particular section
                        $q->newExpr()->between('Expenditures.created',$startDate,$endDate)
                    ]
                );
            });
        return $query->groupBy('expenditure_category_id')->toArray();
    }
}
