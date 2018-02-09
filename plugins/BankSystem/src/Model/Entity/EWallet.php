<?php
namespace BankSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * EWallet Entity
 *
 * @property string $account_holder_id
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \BankSystem\Model\Entity\AccountHolder $account
 */
class EWallet extends Entity
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
        'amount' => true,
        'created' => true,
        'modified' => true,
        'account' => true
    ];
}
