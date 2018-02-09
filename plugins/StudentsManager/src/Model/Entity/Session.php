<?php
namespace StudentsManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property string $session
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \StudentsManager\Model\Entity\Fee[] $fees
 * @property \StudentsManager\Model\Entity\ResultRemark[] $result_remarks
 * @property \StudentsManager\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \StudentsManager\Model\Entity\StudentAnnualPosition[] $student_annual_positions
 * @property \StudentsManager\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \StudentsManager\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \StudentsManager\Model\Entity\StudentAnnualSubjectPosition[] $student_annual_subject_positions
 * @property \StudentsManager\Model\Entity\StudentClassCount[] $student_class_counts
 * @property \StudentsManager\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \StudentsManager\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \StudentsManager\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \StudentsManager\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \StudentsManager\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \StudentsManager\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \StudentsManager\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \StudentsManager\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \StudentsManager\Model\Entity\StudentsAffectiveDispositionScore[] $students_affective_disposition_scores
 * @property \StudentsManager\Model\Entity\StudentsPsychomotorSkillScore[] $students_psychomotor_skill_scores
 * @property \StudentsManager\Model\Entity\SubjectClassAverage[] $subject_class_averages
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
