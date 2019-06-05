<?php
namespace UsersManager\Model\Entity;

use Cake\ORM\Entity;
use CakeDC\Users\Model\Entity\User;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $token
 * @property \Cake\I18n\FrozenTime $token_expires
 * @property string $api_token
 * @property \Cake\I18n\FrozenTime $activation_date
 * @property \Cake\I18n\FrozenTime $tos_date
 * @property bool $active
 * @property bool $is_superuser
 * @property string $role
 * @property string $record_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 */
class Account extends User
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'tos_date' => true,
        'active' => true,
        'is_superuser' => true,
        'role' => true,
        'record_id' => true,
        'created' => true,
        'modified' => true,
        'record' => true,
        'social_accounts' => true,
        'subjects' => true,
        'classes' => true,
        'teachers_subjects_classes_permissions' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];

    protected function _getFullName() {
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }
}
