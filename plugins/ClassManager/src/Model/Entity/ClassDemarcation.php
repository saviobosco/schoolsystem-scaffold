<?php
namespace ClassManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassDemarcation Entity
 *
 * @property int $id
 * @property string $name
 * @property int $class_id
 * @property int $capacity
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Classe $class
 * @property \ClassManager\Model\Entity\Student[] $students
 */
class ClassDemarcation extends Entity
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
        'class_id' => true,
        'capacity' => true,
        'created' => true,
        'modified' => true,
        'class' => true,
        'students' => true
    ];
}
