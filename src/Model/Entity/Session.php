<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property string $session
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\StudentSubjectAnnualResult[] $student_subject_annual_results
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\StudentsAffectiveDisposition[] $students_affective_dispositions
 * @property \App\Model\Entity\StudentsPsychomotorSkill[] $students_psychomotor_skills
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
        '*' => true,
        'id' => false
    ];
}
