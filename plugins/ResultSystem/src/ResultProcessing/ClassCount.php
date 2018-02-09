<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/20/16
 * Time: 6:29 PM
 */

namespace ResultSystem\ResultProcessing;


use Cake\ORM\TableRegistry;

class ClassCount
{

    public function getStudentNumberInClasses($class_id,$session_id,$term_id)
    {
        $studentClassCountTable = TableRegistry::get('ResultSystem.StudentClassCounts');
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $studentsCount = $studentTable->find('all')->where(['class_id' => $class_id,'status'=>1])->count();
        $studentsClassCount = $studentClassCountTable->findOrCreate([
            'class_id' => $class_id,
            'session_id' => $session_id,
            'term_id' => $term_id
        ]);
        $newData = [
            'student_count' => $studentsCount ,
            'class_id' => $class_id ,
            'term_id' => $term_id ,
            'session_id' => $session_id
        ];
        $studentsClassCount = $studentClassCountTable->patchEntity($studentsClassCount,$newData);
        $studentClassCountTable->save($studentsClassCount);
    return true;
    }

}