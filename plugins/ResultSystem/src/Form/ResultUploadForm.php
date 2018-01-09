<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/7/17
 * Time: 4:28 PM
 */

namespace ResultSystem\Form;


use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ResultUploadForm extends Form
{
    protected function _buildSchema(Schema $schema) {
        return $schema
            ->addField('type','string')
            ->addField('class_id','string')
            ->addField('term_id','string')
            ->addField('session_id','string');
    }

    protected function _buildValidator( Validator $validator) {
        return $validator
            ->requirePresence('type')
            ->requirePresence('class_id')->integer('class_id')
            ->requirePresence('term_id')->integer('term_id')
            ->requirePresence('session_id')->integer('session_id')
            ->notEmpty('file');
    }
}