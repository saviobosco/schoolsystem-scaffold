<?php
use Cake\Core\Configure;
/**
 * sidebar.ctp
 */

$parentSessionData = $this->request->session()->read('Auth.User');
?>
<?php $this->start('sidebar');  ?>
<li>
    <?= $this->html->link('<i class="fa fa-laptop"></i> <span>Dashboard</span>',
        ['_name' => 'parent:dashboard'],[
            'escape' => false
        ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-user"></i> <span>My Profile</span>',
        ['_name' => 'parent:profile'],[
            'escape' => false
        ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-paper"></i> <span>My Children</span>',
        ['_name' => 'parent:my_wards'],[
            'escape' => false
        ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-power-off"></i> <span>Log Out</span>',
        ['_name' => 'users:logout'],[
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
                    <?= $this->Html->image('parent-pictures/'.$parentSessionData['photo'], ['alt' => $parentSessionData['first_name'].' '.$parentSessionData['last_name']]) ?>
                    <a href="javascript:;"><img src="" alt="" /></a>
                </div>
                <div class="info">
                    <?= $parentSessionData['first_name'] .' '.$parentSessionData['last_name'] ?>
                    <small> parent </small>
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

