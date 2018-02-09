<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $receipt_id
 * @property string $payment_made_by
 * @property int $payment_type_id
 * @property string $payment_received_by
 * @property int $payment_status
 * @property string $payment_approved_by
 * @property \Cake\I18n\FrozenTime $payment_approved_on
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\Receipt $receipt
 * @property \FinanceManager\Model\Entity\PaymentType $payment_type
 */
class Payment extends Entity
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
        'receipt_id' => true,
        'payment_made_by' => true,
        'payment_type_id' => true,
        'payment_received_by' => true,
        'payment_status' => true,
        'payment_approved_by' => true,
        'payment_approved_on' => true,
        'created' => true,
        'modified' => true,
        'receipt' => true,
        'payment_type' => true
    ];
}
