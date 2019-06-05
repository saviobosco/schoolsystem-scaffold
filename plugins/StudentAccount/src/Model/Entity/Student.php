<?php
namespace StudentAccount\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $gender
 * @property string $state_of_origin
 * @property int $religion_id
 * @property string $home_residence
 * @property string $guardian
 * @property string $relationship_to_guardian
 * @property string $occupation_of_guardian
 * @property string $guardian_phone_number
 * @property int $class_id
 * @property int $class_demarcation_id
 * @property string $photo
 * @property string $photo_dir
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property int $state_id
 *
 * @property \StudentAccount\Model\Entity\Religion $religion
 * @property \StudentAccount\Model\Entity\Class $class
 * @property \StudentAccount\Model\Entity\ClassDemarcation $class_demarcation
 * @property \StudentAccount\Model\Entity\State $state
 * @property \StudentAccount\Model\Entity\AccountHolder[] $account_holders
 * @property \StudentAccount\Model\Entity\Receipt[] $receipts
 * @property \StudentAccount\Model\Entity\StudentAnnualPositionOnClassDemarcation[] $student_annual_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentAnnualPosition[] $student_annual_positions
 * @property \StudentAccount\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \StudentAccount\Model\Entity\StudentAnnualSubjectPositionOnClassDemarcation[] $student_annual_subject_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentAnnualSubjectPosition[] $student_annual_subject_positions
 * @property \StudentAccount\Model\Entity\StudentFee[] $student_fees
 * @property \StudentAccount\Model\Entity\StudentGeneralRemark[] $student_general_remarks
 * @property \StudentAccount\Model\Entity\StudentPublishResult[] $student_publish_results
 * @property \StudentAccount\Model\Entity\StudentResultPin[] $student_result_pins
 * @property \StudentAccount\Model\Entity\StudentTermlyPositionOnClassDemarcation[] $student_termly_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentTermlyPosition[] $student_termly_positions
 * @property \StudentAccount\Model\Entity\StudentTermlyResult[] $student_termly_results
 * @property \StudentAccount\Model\Entity\StudentTermlySubjectPositionOnClassDemarcation[] $student_termly_subject_position_on_class_demarcations
 * @property \StudentAccount\Model\Entity\StudentTermlySubjectPosition[] $student_termly_subject_positions
 * @property \StudentAccount\Model\Entity\StudentsAffectiveDispositionScore[] $students_affective_disposition_scores
 * @property \StudentAccount\Model\Entity\StudentsPsychomotorSkillScore[] $students_psychomotor_skill_scores
 */
class Student extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'date_of_birth' => true,
        'gender' => true,
        'state_of_origin' => true,
        'religion_id' => true,
        'home_residence' => true,
        'guardian' => true,
        'relationship_to_guardian' => true,
        'occupation_of_guardian' => true,
        'guardian_phone_number' => true,
        'class_id' => true,
        'class_demarcation_id' => true,
        'photo' => true,
        'photo_dir' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'state_id' => true,
        'religion' => true,
        'class' => true,
        'class_demarcation' => true,
        'state' => true,
        'account_holders' => true,
        'receipts' => true,
        'student_annual_position_on_class_demarcations' => true,
        'student_annual_positions' => true,
        'student_annual_results' => true,
        'student_annual_subject_position_on_class_demarcations' => true,
        'student_annual_subject_positions' => true,
        'student_fees' => true,
        'student_general_remarks' => true,
        'student_publish_results' => true,
        'student_result_pins' => true,
        'student_termly_position_on_class_demarcations' => true,
        'student_termly_positions' => true,
        'student_termly_results' => true,
        'student_termly_subject_position_on_class_demarcations' => true,
        'student_termly_subject_positions' => true,
        'students_affective_disposition_scores' => true,
        'students_psychomotor_skill_scores' => true
    ];
}
