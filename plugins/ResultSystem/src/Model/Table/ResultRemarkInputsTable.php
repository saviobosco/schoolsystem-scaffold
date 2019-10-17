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
     * @param $session_id
     * @return array
     * This method return the remarks with vissibility => 1 in this format
     * $array = [
     *  'remark_1' => 'Teacher 1',
     *  'remark_2' => 'Teacher 2'
     * ]
     */
    public function getValidRemarkInputs( $session_id)
    {
        $data = $this->find('all')
            ->where(['session_id' => $session_id])
            ->orderAsc('output_order')
            ->combine('main_value','replacement')->toArray();
        return $data;
    }

    public function getColumnValues()
    {
        return [
            'remark_1' => 'Remark_1',
            'remark_2' => 'Remark_2',
            'remark_3' => 'remark_3',
            'remark_4' => 'remark_4',
            'remark_5' => 'remark_5',
            'remark_6' => 'remark_6',
        ];
    }
}
