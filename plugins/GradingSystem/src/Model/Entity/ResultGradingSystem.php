<?php
namespace GradingSystem\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResultGradingSystem Entity
 *
 * @property int $id
 * @property string $grade
 * @property string $score
 * @property string $remark
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ResultGradingSystem extends Entity
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

    public function _getMinScore()
    {
        return @explode('-',$this->_properties['score'])[0];
    }

    public function _getMaxScore()
    {
        return @explode('-',$this->_properties['score'])[1];
    }
}
