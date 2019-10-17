<?php
namespace SkillsGradingSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PsychomotorSkills Model
 *
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill get($primaryKey, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill newEntity($data = null, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill[] newEntities(array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill[] patchEntities($entities, array $data, array $options = [])
 * @method \SkillsGradingSystem\Model\Entity\PsychomotorSkill findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PsychomotorSkillsTable extends Table
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

        $this->table('psychomotor_skills');
        $this->displayField('name');
        $this->primaryKey('id');
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
