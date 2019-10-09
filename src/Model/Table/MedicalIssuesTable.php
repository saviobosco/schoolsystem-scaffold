<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MedicalIssues Model
 *
 * @method \App\Model\Entity\MedicalIssue get($primaryKey, $options = [])
 * @method \App\Model\Entity\MedicalIssue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MedicalIssue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MedicalIssue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MedicalIssue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalIssue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalIssue findOrCreate($search, callable $callback = null, $options = [])
 */
class MedicalIssuesTable extends Table
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

        $this->setTable('medical_issues');
        $this->setDisplayField('issue');
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
            ->scalar('issue')
            ->requirePresence('issue', 'create')
            ->notEmpty('issue');

        return $validator;
    }
}
