<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentFeePayment Entity
 *
 * @property int $id
 * @property int $student_fee_id
 * @property float $amount_paid
 * @property float $amount_to_pay
 * @property float $amount_remaining
 * @property int $receipt_id
 * @property int $fee_id
 * @property int $fee_category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\StudentFee $student_fee
 * @property \FinanceManager\Model\Entity\Receipt $receipt
 * @property \FinanceManager\Model\Entity\Fee $fee
 * @property \FinanceManager\Model\Entity\FeeCategory $fee_category
 */
class StudentFeePayment extends Entity
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
        'student_fee_id' => true,
        'amount_paid' => true,
        'amount_to_pay' => true,
        'amount_remaining' => true,
        'receipt_id' => true,
        'fee_id' => true,
        'fee_category_id' => true,
        'created' => true,
        'modified' => true,
        'student_fee' => true,
        'receipt' => true,
        'fee' => true,
        'fee_category' => true
    ];
}
