<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property string $session
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \ResultSystem\Model\Entity\ResultRemark[] $result_remarks
 * @property \ResultSystem\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentAnnualPosition[] $student_annual_positions
 * @property \ResultSystem\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \ResultSystem\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentAnnualSubjectPosition[] $student_annual_subject_positions
 * @property \ResultSystem\Model\Entity\StudentClassCount[] $student_class_counts
 * @property \ResultSystem\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \ResultSystem\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \ResultSystem\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \ResultSystem\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \ResultSystem\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \ResultSystem\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \ResultSystem\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \ResultSystem\Model\Entity\SubjectClassAverage[] $subject_class_averages
 */
class Session extends Entity
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
        'session' => true,
        'created' => true,
        'modified' => true,
        'fees' => true,
        'result_remarks' => true,
        'student_annual_position_on_class_demarcations' => true,
        'student_annual_positions' => true,
        'student_annual_results' => true,
        'student_annual_subject_position_on_class_demarcations' => true,
        'student_annual_subject_positions' => true,
        'student_class_counts' => true,
        'student_general_remarks' => true,
        'student_publish_results' => true,
        'student_result_pins' => true,
        'student_termly_position_on_class_demarcations' => true,
        'student_termly_positions' => true,
        'student_termly_results' => true,
        'student_termly_subject_position_on_class_demarcations' => true,
        'student_termly_subject_positions' => true,
        'students_affective_disposition_scores' => true,
        'students_psychomotor_skill_scores' => true,
        'subject_class_averages' => true
    ];
}
