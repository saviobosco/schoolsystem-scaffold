<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/17/16
 * Time: 9:49 PM
 */

namespace GradingSystem\Model\Entity;


use GradingSystem\Exception\MissingScoreRangeException;

trait GradeableTrait
{

    public function calculateGrade($total , Array $grades)
    {
        if (is_int( (int) $total) || is_float( (float) $total)) {
            if (is_array($grades)) {
                $scoreGrade = null;
                foreach ($grades as $scoreRange => $grade) {
                    list($first,$last) = explode("-", $scoreRange);
                    $scoreGrade = $this->_getGrade($first, $last, $total, $grade);
                    if ($scoreGrade !== null) {
                        break;
                    }
                }
                if ($scoreGrade === null) {
                    return null; //throw new MissingScoreRangeException(['widget' => $total ]);
                }
                return $scoreGrade;
            }
        }
    }

    protected function _getGrade($beginRange, $endRange, $total, $grade)
    {
        if ( (int)$total >= (int) $beginRange && (int)$total <= (int) $endRange ) {
            return $grade ;
        }
    }

}