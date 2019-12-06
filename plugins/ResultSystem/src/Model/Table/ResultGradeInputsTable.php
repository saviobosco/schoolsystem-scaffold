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

        $validator->requirePresence('main_value', true, 'Main Value is required')
            ->requirePresence('replacement', true, 'Replacement is required')
            ->requirePresence('percentage', true, 'Percentage is required')
            ->requirePresence('output_order', true, 'Output Order is required')
            ->requirePresence('session_id', true, 'Session is required');
        return $validator;
    }

    public function getResultGradeInputs($session_id)
    {
        return  $this->find('all')
            ->where(['session_id'=> $session_id])
            ->orderAsc('output_order')
            ->all();
    }
    /**
     * @param $query
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
    public function getValidGradeInputs($query)
    {
        $percentSum = 0;
        $data = $query
            ->map(function($row) use (&$percentSum) { // percentage passed as a reference variable to compute the accurate percentage total.
                $percentSum = $percentSum + $row->percentage;
                $row->details = "{$row->replacement} ({$row->percentage}%)";
                return $row;
            })
            ->combine('main_value','details')->toArray();
        $examPercentage = 100 - $percentSum;
        $data['exam'] = "Examination ($examPercentage%)";
        return $data;
    }

    /**
     * @param $query
     * @return array
     */
    public function getValidGradeInputsWithAllData($query)
    {
        $data = $query
            ->toArray();
        $percentSum = 0;
        for($num = 0; $num < count($data); $num++) {
            $percentSum = $percentSum + $data[$num]['percentage'];
        }
        $examPercentage = 100 - $percentSum;
        array_push($data, [
            'main_value' => 'exam',
            'replacement' => 'Examination',
            'percentage' => $examPercentage
        ]);
        return $data;
    }

    public function getColumnValues()
    {
        return [
            'first_test' => 'first_test',
            'second_test' => 'second_test',
            'third_test' => 'third_test',
            'fourth_test' => 'fourth_test',
            'fifth_test' => 'fifth_test',
            'sixth_test' => 'sixth_test',
            'seventh_test' => 'seventh_test',
            'eight_test' => 'eight_test',
        ];
    }
}
