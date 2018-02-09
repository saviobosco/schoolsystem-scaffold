<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExpenditureCategory Entity
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\Expenditure[] $expenditures
 */
class ExpenditureCategory extends Entity
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
        'type' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'expenditures' => true
    ];
}
