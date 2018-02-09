<?php
namespace SkillsGradingSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AffectiveDispositions Model
 *
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition get($primaryKey, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition newEntity($data = null, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition[] newEntities(array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition[] patchEntities($entities, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\AffectiveDisposition findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AffectiveDispositionsTable extends Table
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

        $this->table('affective_dispositions');
        $this->displayField('name');
        $this->primaryKey('id');

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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
