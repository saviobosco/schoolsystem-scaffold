<?php
use Cake\Core\Configure;
/**
 * sidebar.ctp
 */
$userRoles = ['superuser'];
$is_superUser = ( (int)$this->request->session()->read('Auth.User.is_superuser') === 1 OR $this->request->session()->read('Auth.User.role') === 'superuser');
?>
<?php $this->start('sidebar');  ?>
<li class="nav-header">Navigation</li>
<!-- super admin side bar -->
<?php
if ( $is_superUser OR in_array($this->request->session()->read('Auth.User.role'),$userRoles,true) ) {
  echo $this->element('Sidebar/super_user');
}
?>
<!-- admin sidebar -->
<?php
array_push($userRoles,'admin');
if ( $is_superUser OR $this->request->session()->read('Auth.User.role') === 'admin' ) {
    echo $this->element('Sidebar/admin');
}
?>
<!-- bursar sidebar -->
<?php
if (\Cake\Core\Plugin::loaded('FinanceManager')) {
    if ( $is_superUser OR $this->request->session()->read('Auth.User.role') === 'bursar' ) {
        echo $this->element('Sidebar/bursar');
    }
}
?>
<?php
if ( $is_superUser OR $this->request->session()->read('Auth.User.role') === 'user' ) {
    echo $this->element('Sidebar/user');
}
?>
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
                    <?= $this->Html->image('admin-photos/avatar_placeholder.png') ?>
                    <a href="javascript:;"><img src="" alt="" /></a>
                </div>
                <div class="info">
                    <?= $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name') ?>
                    <small><?php
                        $role = null;
                        ($this->request->session()->read('Auth.User.is_superuser')) ?  $role='superuser' :  $role = $this->request->session()->read('Auth.User.role');
                        echo Configure::read('UserRoles')[$role];
                        ?></small>
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

