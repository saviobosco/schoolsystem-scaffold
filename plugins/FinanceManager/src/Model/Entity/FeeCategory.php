<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeCategory Entity
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property float $income_amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\Fee[] $fees
 * @property \FinanceManager\Model\Entity\StudentFeePayment[] $student_fee_payments
 */
class FeeCategory extends Entity
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
        'income_amount' => true,
        'created' => true,
        'modified' => true,
        'fees' => true,
        'student_fee_payments' => true
    ];
}
