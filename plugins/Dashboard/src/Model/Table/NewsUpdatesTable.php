<?php

namespace Dashboard\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class NewsUpdatesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        try {
            $this->getConnection()->execute('Select * from news_updates limit 1');
        } catch (\PDOException $pdoException) {
            // run the table migration file
            $this->getConnection()->execute("CREATE TABLE news_updates (
            id integer AUTO_INCREMENT PRIMARY KEY,
            title varchar(255) NOT NULL ,
            title_slug varchar(255) NOT NULL,
            post TEXT ,
            default_post SMALLINT default 0,
            status  SMALLINT default 1,
            created TIMESTAMP NULL,
            modified TIMESTAMP NULL
) ");
        }

        $this->setTable('news_updates');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('post', 'create')
            ->notEmpty('post');

        return $validator;
    }

    public function beforeSave(Event $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->title_slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->title_slug = substr($sluggedTitle, 0, 191);
        }
    }
}