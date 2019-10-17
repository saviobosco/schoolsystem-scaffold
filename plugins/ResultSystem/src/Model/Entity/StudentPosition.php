<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentPosition Entity
 *
 * @property int $id
 * @property string $student_id
 * @property float $total
 * @property float $average
 * @property string $grade
 * @property int $position
 * @property int $class_id
 * @property int $term_id
 * @property int $session_id
 *
 * @property \ResultSystem\Model\Entity\Student $student
 * @property \ResultSystem\Model\Entity\Class $class
 * @property \ResultSystem\Model\Entity\Term $term
 * @property \ResultSystem\Model\Entity\Session $session
 */
class StudentPosition extends Entity
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
        'student_id' => true,
        'total' => true,
        'average' => true,
        'grade' => true,
        'position' => true,
        'promoted' => true,
        'class_id' => true,
        'term_id' => true,
        'session_id' => true,
        'student' => true,
        'class' => true,
        'term' => true,
        'session' => true
    ];
}
