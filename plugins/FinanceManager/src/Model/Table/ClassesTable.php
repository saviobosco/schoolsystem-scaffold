<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;

/**
 * Classes Model
 *
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\HasMany $Fees
 * @property \FinanceManager\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 *
 * @method \FinanceManager\Model\Entity\Class get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Class newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Class[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Class|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Class[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Class findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassesTable extends Table
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

        $this->setTable('classes');
        $this->setDisplayField('class');
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

        $this->hasMany('Fees', [
            'foreignKey' => 'class_id',
            'className' => 'FinanceManager.Fees'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'class_id',
            'className' => 'FinanceManager.Students'
        ]);
        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id'
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
            ->requirePresence('class', 'create')
            ->notEmpty('class');

        return $validator;
    }

    public function deleteClass(EntityInterface $class)
    {
        if ( (bool)$this->Fees->find()->where(['class_id'=>$class->id])->first()) {
            throw new \PDOException;
        }
        $this->delete($class);
        return true;
    }
}
