<?php
namespace StudentsManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $date_of_birth
 * @property string $gender
 * @property string $state_of_origin
 * @property string $religion
 * @property string $home_residence
 * @property string $guardian
 * @property string $relationship_to_guardian
 * @property string $occupation_of_guardian
 * @property string $guardian_phone_number
 * @property string $session_id
 * @property int $class_id
 * @property int $class_demarcation_id
 * @property $photo
 * @property string $photo_dir
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 * @property int $session_admitted_id
 * @property int $graduated
 * @property int $graduated_session_id
 * @property int $state_id
 *
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Session $session_admitted
 * @property \App\Model\Entity\Classe $class
 * @property \App\Model\Entity\ClassDemarcation $class_demarcation
 * @property \App\Model\Entity\Session $session_graduated
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
        'id' => true
    ];

    protected function _getFullName() {
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }
}
