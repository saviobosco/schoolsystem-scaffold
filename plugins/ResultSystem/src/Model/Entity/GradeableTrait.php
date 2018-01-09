<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/17/16
 * Time: 9:49 PM
 */

namespace ResultSystem\Model\Entity;


trait GradeableTrait
{

    public function calculateGrade($total , Array $grades)
    {

        if (is_int( (int) $total) || is_float( (float) $total)) {


            if (is_array($grades)) {

                $count = count($grades);

                $position = 1;
                foreach ($grades as $key => $grade) {

                    $value = explode("-", $key);


                    if ($position === 1) {
                        if ((int)$total >= (int) $value[0] ) {
                            return $grade;
                        }
                    } elseif( $position > 1 && $position < $count ) {
                        if ( (int)$total >= (int) $value[0] && (int)$total <= (int) $value[1] ) {
                            return $grade ;
                        }
                    } elseif ($position === $count ) {
                        if ( (int)$total < (int) $value[0] ) {
                            return $grade ;
                        }
                    }
                    $position++;
                }
            }
        }
    }

}