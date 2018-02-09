<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentTermlyPositionOnClassDemarcation Entity
 *
 * @property int $id
 * @property string $student_id
 * @property int $total
 * @property int $average
 * @property int $position
 * @property int $class_id
 * @property int $class_demarcation_id
 * @property int $term_id
 * @property int $session_id
 *
 * @property \ResultSystem\Model\Entity\Student $student
 * @property \App\Model\Entity\Classe $class
 * @property \App\Model\Entity\ClassDemarcation $class_demarcation
 * @property \ResultSystem\Model\Entity\Term $term
 * @property \App\Model\Entity\Session $session
 */
class StudentTermlyPositionOnClassDemarcation extends Entity
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
}
