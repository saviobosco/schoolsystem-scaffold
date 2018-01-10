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
 * @property \ClassManager\Model\Entity\Block $block
 * @property \ClassManager\Model\Entity\ClassDemarcation[] $class_demarcations
 * @property \ClassManager\Model\Entity\Student[] $students
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
