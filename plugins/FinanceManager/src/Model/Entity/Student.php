<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property string $id
 * @property string $full_name
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $gender
 * @property string $state_of_origin
 * @property int $religion_id
 * @property string $home_residence
 * @property string $guardian
 * @property string $relationship_to_guardian
 * @property string $occupation_of_guardian
 * @property string $guardian_phone_number
 * @property int $class_id
 * @property int $class_demarcation_id
 * @property string $photo
 * @property string $photo_dir
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property int $state_id
 * @property \FinanceManager\Model\Entity\Receipt[] $receipts
 */
class Student extends Entity
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
        'date_of_birth' => true,
        'gender' => true,
        'state_of_origin' => true,
        'religion_id' => true,
        'home_residence' => true,
        'guardian' => true,
        'relationship_to_guardian' => true,
        'occupation_of_guardian' => true,
        'guardian_phone_number' => true,
        'class_id' => true,
        'class_demarcation_id' => true,
        'photo' => true,
        'photo_dir' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'state_id' => true,
        'religion' => true,
        'class' => true,
        'class_demarcation' => true,
        'state' => true,
        'receipts' => true,
        'student_fees' => true,
    ];

    protected function _getFullName() {
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }
}
