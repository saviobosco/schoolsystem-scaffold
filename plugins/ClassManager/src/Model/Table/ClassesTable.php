<?php
namespace ClassManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \ClassManager\Model\Table\BlocksTable|\Cake\ORM\Association\BelongsTo $Blocks
 * @property \ClassManager\Model\Table\ClassDemarcationsTable|\Cake\ORM\Association\HasMany $ClassDemarcations
 * @property \ClassManager\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 *
 * @method \ClassManager\Model\Entity\Classe get($primaryKey, $options = [])
 * @method \ClassManager\Model\Entity\Classe newEntity($data = null, array $options = [])
 * @method \ClassManager\Model\Entity\Classe[] newEntities(array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Classe|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ClassManager\Model\Entity\Classe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Classe[] patchEntities($entities, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Classe findOrCreate($search, callable $callback = null, $options = [])
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

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Blocks'
        ]);
        $this->hasMany('ClassDemarcations', [
            'foreignKey' => 'class_id',
            'className' => 'ClassManager.ClassDemarcations'
        ]);

        $this->hasMany('Students', [
            'foreignKey' => 'class_id',
            'className' => 'ClassManager.Students'
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
            ->scalar('class')
            ->requirePresence('class', 'create')
            ->notEmpty('class');

        $validator
            ->integer('no_of_subjects')
            ->requirePresence('no_of_subjects', 'create')
            ->notEmpty('no_of_subjects');

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
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));

        return $rules;
    }
}
