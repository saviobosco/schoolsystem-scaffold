<?php
namespace StudentAccount\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Entity
 *
 * @property int $id
 * @property string $class
 * @property int $block_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $no_of_subjects
 *
 * @property \StudentAccount\Model\Entity\Block $block
 * @property \StudentAccount\Model\Entity\ClassDemarcation[] $class_demarcations
 * @property \StudentAccount\Model\Entity\Fee[] $fees
 * @property \StudentAccount\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentAnnualPosition[] $student_annual_positions
 * @property \StudentAccount\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \StudentAccount\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentAnnualSubjectPosition[] $student_annual_subject_positions
 * @property \StudentAccount\Model\Entity\StudentClassCount[] $student_class_counts
 * @property \StudentAccount\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \StudentAccount\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \StudentAccount\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \StudentAccount\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \StudentAccount\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \StudentAccount\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \StudentAccount\Model\Entity\Student[] $students
 * @property \StudentAccount\Model\Entity\StudentsAffectiveDispositionScore[] $students_affective_disposition_scores
 * @property \StudentAccount\Model\Entity\StudentsPsychomotorSkillScore[] $students_psychomotor_skill_scores
 * @property \StudentAccount\Model\Entity\SubjectClassAverage[] $subject_class_averages
 */
class Classe extends Entity
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
        'class' => true,
        'block_id' => true,
        'created' => true,
        'modified' => true,
        'no_of_subjects' => true,
        'block' => true,
        'class_demarcations' => true,
        'fees' => true,
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
        'students' => true,
        'students_affective_disposition_scores' => true,
        'students_psychomotor_skill_scores' => true,
        'subject_class_averages' => true
    ];
}
