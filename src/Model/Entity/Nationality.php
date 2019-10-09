<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Nationality Entity
 *
 * @property int $id
 * @property string $nationality
 * @property bool $default
 *
 * @property \App\Model\Entity\Student[] $students
 */
class Nationality extends Entity
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
        'nationality' => true,
        'default_selection' => true,
        'students' => true
    ];
}
