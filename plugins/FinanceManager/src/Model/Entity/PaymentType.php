<?php
namespace FinanceManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentType Entity
 *
 * @property int $id
 * @property string $type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \FinanceManager\Model\Entity\Payment[] $payments
 */
class PaymentType extends Entity
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
        'created' => true,
        'modified' => true,
        'payments' => true
    ];
}
