<?php
namespace SkillsGradingSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentsPsychomotorSkillScore Entity
 *
 * @property int $id
 * @property string $student_id
 * @property int $psychomotor_id
 * @property int $score
 * @property int $class_id
 * @property int $term_id
 * @property int $session_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \SkillsGradingSystem\Model\Entity\Student $student
 * @property \SkillsGradingSystem\Model\Entity\Psychomotor $psychomotor
 * @property \SkillsGradingSystem\Model\Entity\Class $class
 * @property \SkillsGradingSystem\Model\Entity\Term $term
 * @property \SkillsGradingSystem\Model\Entity\Session $session
 */
class StudentsPsychomotorSkillScore extends Entity
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
