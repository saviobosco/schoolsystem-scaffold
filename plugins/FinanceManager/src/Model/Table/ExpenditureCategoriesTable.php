<?php
namespace FinanceManager\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpenditureCategories Model
 *
 * @property \FinanceManager\Model\Table\ExpendituresTable|\Cake\ORM\Association\HasMany $Expenditures
 *
 * @method \FinanceManager\Model\Entity\ExpenditureCategory get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\ExpenditureCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExpenditureCategoriesTable extends Table
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

        $this->setTable('expenditure_categories');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Expenditures',[
            'foreignKey' => 'expenditure_category_id',
            'className' => 'FinanceManager.Expenditures'
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

    public function deleteExpenditureCategory(EntityInterface $expenditureCategory)
    {
        if ((bool)$this->Expenditures->find()->where(['expenditure_category_id'=>$expenditureCategory->id])->first()) {
            throw new \PDOException;
        }
        $this->delete($expenditureCategory);
        return true;
    }
}
