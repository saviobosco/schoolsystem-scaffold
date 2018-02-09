<?php
namespace BankSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * AccountHolder Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $account_number
 * @property int $account_type_id
 * @property int $student_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \BankSystem\Model\Entity\AccountType $account_type
 */
class AccountHolder extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'account_number' => true,
        'account_type_id' => true,
        'student_id' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'account_type' => true
    ];

    protected function _getFullName() {
        if ( !empty($this->_properties['student_id'])) { // its a student
            return $this->_properties['student']['first_name'].' '.$this->_properties['student']['last_name'];
        }
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }
}
