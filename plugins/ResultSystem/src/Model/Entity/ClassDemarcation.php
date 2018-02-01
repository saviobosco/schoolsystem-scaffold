<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassDemarcation Entity
 *
 * @property int $id
 * @property string $name
 * @property int $class_id
 * @property int $capacity
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \ResultSystem\Model\Entity\Class $class
 * @property \ResultSystem\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\Student[] $students
 */
class ClassDemarcation extends Entity
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
        'name' => true,
        'class_id' => true,
        'capacity' => true,
        'created' => true,
        'modified' => true,
        'class' => true,
        'student_annual_position_on_class_demarcations' => true,
        'student_annual_subject_position_on_class_demarcations' => true,
        'student_termly_position_on_class_demarcations' => true,
        'student_termly_subject_position_on_class_demarcations' => true,
        'students' => true
    ];
}
