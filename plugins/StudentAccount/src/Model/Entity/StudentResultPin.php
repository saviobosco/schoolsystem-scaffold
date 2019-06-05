<?php
namespace StudentAccount\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentResultPin Entity
 *
 * @property int $serial_number
 * @property int $pin
 * @property string $student_id
 * @property int $term_id
 * @property int $session_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $class_id
 *
 * @property \StudentAccount\Model\Entity\Student $student
 * @property \StudentAccount\Model\Entity\Term $term
 * @property \StudentAccount\Model\Entity\Session $session
 * @property \StudentAccount\Model\Entity\Classe $class
 */
class StudentResultPin extends Entity
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
        'pin' => true,
        'student_id' => true,
        'term_id' => true,
        'session_id' => true,
        'created' => true,
        'modified' => true,
        'class_id' => true,
        'student' => true,
        'term' => true,
        'session' => true,
        'class' => true
    ];
}
