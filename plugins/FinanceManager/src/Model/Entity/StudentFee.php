<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentFee Entity
 *
 * @property int $id
 * @property string $student_id
 * @property int $fee_id
 * @property float $amount
 * @property bool $paid
 * @property float $amount_remaining
 * @property string $purpose
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $created_by
 * @property string $modified_by
 *
 * @property \FinanceManager\Model\Entity\Student $student
 * @property \FinanceManager\Model\Entity\Fee $fee
 * @property \FinanceManager\Model\Entity\StudentFeePayment[] $student_fee_payments
 */
class StudentFee extends Entity
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
        'student_id' => true,
        'fee_id' => true,
        'amount' => true,
        'paid' => true,
        'amount_remaining' => true,
        'purpose' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'student' => true,
        'fee' => true,
        'student_fee_payments' => true
    ];
}
