<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subject Entity
 *
 * @property int $id
 * @property string $name
 * @property int $block_id
 *
 * @property \App\Model\Entity\Block $block
 * @property \App\Model\Entity\StudentAnnualResult[] $student_annual_results
 * @property \App\Model\Entity\StudentTermlyResult[] $student_termly_results
 */
class Subject extends Entity
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

    protected function _setName($name)
    {
        // changes the name to Capital text
        return ucwords($name);
    }
}
