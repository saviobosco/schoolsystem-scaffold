<?php
namespace ClassManager\Model\Entity;

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
 * @property \ClassManager\Model\Entity\Block $block
 * @property \ClassManager\Model\Entity\ClassDemarcation[] $class_demarcations
 * @property \ClassManager\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \ClassManager\Model\Entity\StudentAnnualPosition[] $student_annual_positions
 * @property \ClassManager\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \ClassManager\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \ClassManager\Model\Entity\StudentAnnualSubjectPosition[] $student_annual_subject_positions
 * @property \ClassManager\Model\Entity\StudentClassCount[] $student_class_counts
 * @property \ClassManager\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \ClassManager\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \ClassManager\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \ClassManager\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \ClassManager\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \ClassManager\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \ClassManager\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \ClassManager\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \ClassManager\Model\Entity\Student[] $students
 * @property \ClassManager\Model\Entity\StudentsAffectiveDispositionScore[] $students_affective_disposition_scores
 * @property \ClassManager\Model\Entity\StudentsPsychomotorSkillScore[] $students_psychomotor_skill_scores
 * @property \ClassManager\Model\Entity\SubjectClassAverage[] $subject_class_averages
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
        'students' => true,
    ];
}
