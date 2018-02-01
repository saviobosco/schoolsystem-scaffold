<?php
namespace ClassManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \ClassManager\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \ClassManager\Model\Table\ClassDemarcationsTable|\Cake\ORM\Association\BelongsTo $ClassDemarcations

 * @method \ClassManager\Model\Entity\Student get($primaryKey, $options = [])
 * @method \ClassManager\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \ClassManager\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ClassManager\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \ClassManager\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Classes'
        ]);
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'className' => 'ClassManager.ClassDemarcations'
        ]);
    }
}
