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

        /*$validator
            ->scalar('main_value')
            ->requirePresence('main_value', 'create')
            ->notEmpty('main_value');

        $validator
            ->scalar('replacement')
            ->allowEmpty('replacement');

        $validator
            ->scalar('percentage')
            ->allowEmpty('percentage');

        $validator
            ->integer('order')
            ->allowEmpty('order');

        $validator
            ->boolean('visibility')
            ->allowEmpty('visibility');*/

        return $validator;
    }

    public function getValidGradeInputs()
    {
        $data = $this->find('all')
            ->where(['visibility'=>1])
            ->map(function($row){ $row->details = $row->replacement.' ('.$row->percentage.'%)'; return $row;})
            ->combine('main_value','details')->toArray();
        return $data;
    }

    public function getValidGradeInputsWithAllData()
    {
        $data = $this->find('all')
            ->where(['visibility'=>1])
            ->enableHydration(false)
            //->map(function($row){ $row->details = $row->replacement.' ('.$row->percentage.'%)'; return $row;})
            ->toArray();
        return $data;
    }
}
