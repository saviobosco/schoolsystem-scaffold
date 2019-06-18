<?php
namespace UsersManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeachersSubjectsClassesPermission Entity
 *
 * @property int $id
 * @property string $teacher_id
 * @property int $class_id
 * @property string $subjects
 * @property string $terms
 * @property string $sessions
 *
 * @property \UsersManager\Model\Entity\User $user
 * @property \UsersManager\Model\Entity\Class $class
 */
class TeachersSubjectsClassesPermission extends Entity
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
        'teacher_id' => true,
        'class_id' => true,
        'subjects' => true,
        'terms' => true,
        'sessions' => true,
        'user' => true,
        'class' => true,
        'teacher_class_id' => true
    ];
}
