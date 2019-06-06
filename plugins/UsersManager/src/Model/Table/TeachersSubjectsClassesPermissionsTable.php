<?php
namespace UsersManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Type;
use Cake\Database\Schema\TableSchema;
/**
 * TeachersSubjectsClassesPermissions Model
 *
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission get($primaryKey, $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission newEntity($data = null, array $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission[] newEntities(array $data, array $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission[] patchEntities($entities, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\TeachersSubjectsClassesPermission findOrCreate($search, callable $callback = null, $options = [])
 */
class TeachersSubjectsClassesPermissionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        Type::map('serialize', 'App\Database\Type\SerializeType');
        parent::initialize($config);

        $this->setTable('teachers_subjects_classes_permissions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Classes'
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
            ->requirePresence('subjects', 'create')
            ->notEmpty('subjects');

        $validator
            ->requirePresence('terms', 'create')
            ->notEmpty('terms');

        $validator
            ->requirePresence('sessions', 'create')
            ->notEmpty('sessions');

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
        $rules->add($rules->existsIn(['teacher_id'], 'Users'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));

        return $rules;
    }

    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('subjects', 'serialize');
        $schema->setColumnType('terms', 'serialize');
        $schema->setColumnType('sessions', 'serialize');
        return $schema;
    }
}
