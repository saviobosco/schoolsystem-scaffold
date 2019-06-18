<?php
use Cake\Core\Configure;
/**
 * sidebar.ctp
 */

$teacherSessionData = $this->request->session()->read('Auth.User');
?>
<?php $this->start('sidebar');  ?>
<li>
    <?= $this->html->link('<i class="fa fa-laptop"></i> <span>Dashboard</span>',
        ['_name' => 'teacher:dashboard'],[
            'escape' => false
        ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-user"></i> <span>My Profile</span>',
        ['_name' => 'teacher:profile:edit'],[
            'escape' => false
        ]) ?>
</li>

<li>
    <?= $this->html->link('<i class="fa fa-key"></i> <span>Change Password</span>',[
        'plugin'=>'UsersManager',
        'controller'=>'Accounts',
        'action' => 'changePassword'
    ],[
        'escape' => false
    ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-power-off"></i> <span>Log Out</span>',[
        'plugin'=>'UsersManager',
        'controller'=>'Accounts',
        'action' => 'logout'
    ],[
        'escape' => false
    ]) ?>
</li>
<!-- user sidebar -->
<?php $this->end() ?>

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <?= $this->Html->image('teacher-pictures/'.$teacherSessionData['photo'], ['alt' => $teacherSessionData['first_name'].' '.$teacherSessionData['last_name']]) ?>
                    <a href="javascript:;"><img src="" alt="" /></a>
                </div>
                <div class="info">
                    <?= $teacherSessionData['first_name'] .' '.$teacherSessionData['last_name'] ?>
                    <small> Teacher </small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <?php
            // fetch the sidebars
            echo $this->fetch('sidebar')
            ?>
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->

