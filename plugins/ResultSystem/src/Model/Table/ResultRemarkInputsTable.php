<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResultRemarkInputs Model
 *
 * @method \ResultSystem\Model\Entity\ResultRemarkInput get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemarkInput findOrCreate($search, callable $callback = null, $options = [])
 */
class ResultRemarkInputsTable extends Table
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

        $this->setTable('result_remark_inputs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('main_value')
            ->requirePresence('main_value', 'create')
            ->notEmpty('main_value');

        return $validator;
    }

    /**
     * @return array
     * This method return the remarks with vissibility => 1 in this format
     * $array = [
     *  'remark_1' => 'Teacher 1',
     *  'remark_2' => 'Teacher 2'
     * ]
     */
    public function getValidRemarkInputs()
    {
        $data = $this->find('all')
            ->where(['visibility'=>1])
            ->orderAsc('output_order')
            ->combine('main_value','replacement')->toArray();
        return $data;
    }
}
