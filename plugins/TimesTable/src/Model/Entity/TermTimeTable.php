<?php
namespace TimesTable\Model\Entity;

use Cake\ORM\Entity;

/**
 * TermTimeTable Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property int $term_id
 * @property int $session_id
 *
 * @property \TimesTable\Model\Entity\Term $term
 * @property \TimesTable\Model\Entity\Session $session
 */
class TermTimeTable extends Entity
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
}
