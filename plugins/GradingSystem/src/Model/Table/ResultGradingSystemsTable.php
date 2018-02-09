<?php
namespace GradingSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use GradingSystem\Model\Entity\GradeableTrait;

/**
 * ResultGradingSystems Model
 *
 * @method \GradingSystem\Model\Entity\ResultGradingSystem get($primaryKey, $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem newEntity($data = null, array $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem[] newEntities(array $data, array $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem[] patchEntities($entities, array $data, array $options = [])
 * @method \GradingSystem\Model\Entity\ResultGradingSystem findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResultGradingSystemsTable extends Table
{
    use GradeableTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('result_grading_systems');
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
            ->requirePresence('grade', 'create')
            ->notEmpty('grade');

        $validator
            ->allowEmpty('score');

        $validator
            ->requirePresence('remark', 'create')
            ->notEmpty('remark');

        $validator
            ->add('cal_order', 'unique', [
                'rule' => 'validateUnique',
                'last'=>true,
                'message' => __( 'Calculation Order must be unique'),
                'provider' => 'table'])
            ->integer('cal_order')
            ->requirePresence('cal_order', 'create')
            ->notEmpty('cal_order');

        return $validator;
    }

    public function getGrades()
    {
        return $this->find('all')->orderAsc('cal_order')->combine('score','grade')->toArray();
    }
}
