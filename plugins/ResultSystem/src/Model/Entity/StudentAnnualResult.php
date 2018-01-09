<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentAnnualResult Entity
 *
 * @property int $id
 * @property string $student_id
 * @property string $subject_id
 * @property int $first_term
 * @property int $second_term
 * @property int $third_term
 * @property int $total
 * @property int $average
 * @property string $remark
 * @property int $class_id
 * @property string $session_id
 *
 * @property \ResultSystem\Model\Entity\Student $student
 * @property \ResultSystem\Model\Entity\Subject $subject
 * @property \ResultSystem\Model\Entity\Class $class
 * @property \ResultSystem\Model\Entity\Session $session
 */
class StudentAnnualResult extends Entity
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
