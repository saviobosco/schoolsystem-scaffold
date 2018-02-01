<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResultGradeInputs Model
 *
 * @method \ResultSystem\Model\Entity\ResultGradeInput get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultGradeInput findOrCreate($search, callable $callback = null, $options = [])
 */
class ResultGradeInputsTable extends Table
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

        $this->setTable('result_grade_inputs');
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
        return $validator;
    }

    /**
     * @return array
     * This method returns only the grades inputs with visibility => 1 in this format
     * $array = [
     *  'first_test' => 'First Test (10%)',
     *  'second_test' => 'Second Test (10%)',
     *  'third_test' => 'Third Test (10%)',
     *  ...
     *  'exam' => 'Examination (70%)',
     * ]
     *
     */
    public function getValidGradeInputs()
    {
        $data = $this->find('all')
            ->where(['visibility'=>1])
            ->orderAsc('output_order')
            ->map(function($row){ $row->details = $row->replacement.' ('.$row->percentage.'%)'; return $row;})
            ->combine('main_value','details')->toArray();
        return $data;
    }

    /**
     * @return array
     * This method return all grade inputs with visibility => 1;
     */
    public function getValidGradeInputsWithAllData()
    {
        $data = $this->find('all')
            ->where(['visibility'=>1])
            ->orderAsc('output_order')
            ->enableHydration(false)
            ->toArray();
        return $data;
    }
}
