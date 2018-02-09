<?php
namespace StudentsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \StudentsManager\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 * @method \StudentsManager\Model\Entity\Class get($primaryKey, $options = [])
 * @method \StudentsManager\Model\Entity\Class newEntity($data = null, array $options = [])
 * @method \StudentsManager\Model\Entity\Class[] newEntities(array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Class|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \StudentsManager\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Class[] patchEntities($entities, array $data, array $options = [])
 * @method \StudentsManager\Model\Entity\Class findOrCreate($search, callable $callback = null, $options = [])
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


        $this->hasMany('Students', [
            'foreignKey' => 'class_id',
            'className' => 'StudentsManager.Students'
        ]);
    }
}
