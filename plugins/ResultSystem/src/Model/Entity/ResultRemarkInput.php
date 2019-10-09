<?php
namespace ResultSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResultRemarkInput Entity
 *
 * @property int $id
 * @property string $main_value
 * @property string $replacement
 * @property int $output_order
 * @property int $visibility
 */
class ResultRemarkInput extends Entity
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
        'main_value' => true,
        'replacement' => true,
        'output_order' => true,
        'visibility' => true,
        'session_id' => true,
    ];
}
