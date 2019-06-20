<?php
namespace UsersManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logins Model
 *
 * @property \UsersManager\Model\Table\AccountsTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \UsersManager\Model\Entity\Login get($primaryKey, $options = [])
 * @method \UsersManager\Model\Entity\Login newEntity($data = null, array $options = [])
 * @method \UsersManager\Model\Entity\Login[] newEntities(array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Login|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UsersManager\Model\Entity\Login patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Login[] patchEntities($entities, array $data, array $options = [])
 * @method \UsersManager\Model\Entity\Login findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoginsTable extends Table
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

        $this->setTable('logins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Accounts', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UsersManager.Accounts'
        ]);
    }
}
