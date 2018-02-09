<?php
namespace BankSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionLog Entity
 *
 * @property int $id
 * @property int $credit_transaction_id
 * @property int $debit_transaction_id
 * @property int $transfer_log_id
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $created_by
 * @property string $modified_by
 * @property string $account_holder_id
 *
 * @property \BankSystem\Model\Entity\CreditTransaction $credit_transaction
 * @property \BankSystem\Model\Entity\DebitTransaction $debit_transaction
 * @property \BankSystem\Model\Entity\AccountHolder $account
 */
class TransactionLog extends Entity
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
        'credit_transaction_id' => true,
        'debit_transaction_id' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'account_holder_id' => true,
        'credit_transaction' => true,
        'debit_transaction' => true,
        'account_holder' => true
    ];
}
