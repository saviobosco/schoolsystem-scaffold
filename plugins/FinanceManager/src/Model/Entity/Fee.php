<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fee Entity
 *
 * @property int $id
 * @property int $fee_category_id
 * @property float $amount
 * @property bool $compulsory
 * @property float $income_amount_expected
 * @property float $amount_earned
 * @property int $number_of_students
 * @property int $term_id
 * @property int $class_id
 * @property int $session_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $created_by
 * @property string $modified_by
 *
 * @property \FinanceManager\Model\Entity\FeeCategory $fee_category
 * @property \FinanceManager\Model\Entity\Term $term
 * @property \FinanceManager\Model\Entity\Class $class
 * @property \FinanceManager\Model\Entity\Session $session
 * @property \FinanceManager\Model\Entity\StudentFeePayment[] $student_fee_payments
 * @property \FinanceManager\Model\Entity\StudentFee[] $student_fees
 */
class Fee extends Entity
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
        'fee_category_id' => true,
        'amount' => true,
        'compulsory' => true,
        'income_amount_expected' => true,
        'amount_earned' => true,
        'number_of_students' => true,
        'term_id' => true,
        'class_id' => true,
        'session_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'fee_category' => true,
        'term' => true,
        'class' => true,
        'session' => true,
        'student_fee_payments' => true,
        'student_fees' => true
    ];
}
