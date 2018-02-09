<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users">
    <h3><?= $this->Html->image(empty($user->avatar) ? $avatarPlaceholder : $user->avatar, ['width' => '180', 'height' => '180']); ?></h3>
    <h3>
        <?=
        $this->Html->tag(
            'span',
            __d('CakeDC/Users', '{0} {1}', $user->first_name, $user->last_name),
            ['class' => 'full_name']
        )
        ?>
    </h3>
    <?php //@todo add to config ?>
    <?= $this->Html->link(__d('CakeDC/Users', 'Change Password'), ['controller' => 'Accounts', 'action' => 'changePassword']); ?>
    <div class="row">
        <div class="large-6 columns strings">
            <h6 class="subheader"><?= __d('CakeDC/Users', 'Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __d('CakeDC/Users', 'Email') ?></h6>
            <p><?= h($user->email) ?></p>
        </div>
    </div>
</div>
