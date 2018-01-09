<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/7/17
 * Time: 11:34 AM
 */

namespace ResultSystem\Form;


use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ResultCheckForm extends Form
{
    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('req_number', 'string')
            ->addField('pin', ['type' => 'string'])
            ->addField('class_id', ['type' => 'string'])
            ->addField('session_id', ['type' => 'string'])
            ->addField('term_id', ['type' => 'string']);


    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator
            ->requirePresence('reg_number')
            ->requirePresence('pin')
            ->integer('pin')
            ->requirePresence('class_id')
            ->requirePresence('session_id')
            ->requirePresence('term_id');
    }

}