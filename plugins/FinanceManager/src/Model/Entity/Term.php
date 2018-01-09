<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Term Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\Fee[] $fees
 * @property \FinanceManager\Model\Entity\StudentClassCount[] $student_class_counts
 * @property \FinanceManager\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \FinanceManager\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \FinanceManager\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \FinanceManager\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \FinanceManager\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \FinanceManager\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \FinanceManager\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \FinanceManager\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \FinanceManager\Model\Entity\StudentsAffectiveDispositionScore[] $students_affective_disposition_scores
 * @property \FinanceManager\Model\Entity\StudentsPsychomotorSkillScore[] $students_psychomotor_skill_scores
 * @property \FinanceManager\Model\Entity\SubjectClassAverage[] $subject_class_averages
 */
class Term extends Entity
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
        'created' => true,
        'modified' => true,
        'fees' => true,
    ];

    protected function _getTerm() {
        return $this->_properties['name'];
    }
}
