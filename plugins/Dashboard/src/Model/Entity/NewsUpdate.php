<?php

namespace Dashboard\Model\Entity;

use Cake\ORM\Entity;

class NewsUpdate extends Entity {

    protected $_accessible = [
        'title' => true,
        'post' => true,
        'default_post' => true,
        'status' => true
    ];

}