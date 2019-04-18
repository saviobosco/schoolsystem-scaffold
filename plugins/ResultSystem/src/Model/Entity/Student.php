<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $date_of_birth
 * @property string $gender
 * @property string $state_of_origin
 * @property string $religion
 * @property string $home_residence
 * @property string $gaurdian
 * @property string $relationship_to_gaurdian
 * @property string $occupation_of_gaurdian
 * @property string $gaurdian_phone_number
 * @property string $session_id
 * @property int $class_id
 * @property int $class_demacation_id
 * @property string $photo
 * @property string $photo_dir
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Classe $class
 * @property \App\Model\Entity\ClassDemarcation $class_demarcation
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
        '*' => true,
        'id' => false
    ];

    protected $_virtual = [
        'full_name'
    ];

    protected function _getFullName() {
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }
}
