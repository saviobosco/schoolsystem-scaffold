<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResultRemark Entity
 *
 * @property int $id
 * @property string $result_remark_input_main_value
 * @property string $full_name
 * @property int $term_id
 * @property int $class_id
 * @property int $session_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \ResultSystem\Model\Entity\Term $term
 * @property \ResultSystem\Model\Entity\Class $class
 * @property \ResultSystem\Model\Entity\Session $session
 */
class ResultRemark extends Entity
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
        'result_remark_input_main_value' => true,
        'full_name' => true,
        'term_id' => true,
        'class_id' => true,
        'session_id' => true,
        'created' => true,
        'modified' => true,
        'term' => true,
        'class' => true,
        'session' => true
    ];
}
