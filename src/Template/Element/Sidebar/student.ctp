<?php
use Cake\Core\Configure;
/**
 * sidebar.ctp
 */

$studentSessionData = $this->request->session()->read('Auth.User');
?>
<?php $this->start('sidebar');  ?>
<li>
    <?= $this->html->link('<i class="fa fa-laptop"></i> <span>Dashboard</span>',
        $this->Url->build(['_name' => 'student:dashboard']),[
        'escape' => false
    ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-user"></i> <span>My Profile</span>',
        $this->Url->build(['_name' => 'student:profile']),[
        'escape' => false
    ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-paper"></i> <span>My Results</span>',
        $this->Url->build(['_name' => 'student:my_results']),[
        'escape' => false
    ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-key"></i> <span>My Pins</span>',
        $this->Url->build(['_name' => 'student:my_pins']),[
        'escape' => false
    ]) ?>
</li>
<li>
    <?= $this->html->link('<i class="fa fa-power-off"></i> <span>Log Out</span>',
        $this->Url->build(['_name' => 'users:logout']),[
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
                    <?= $this->Html->image('student-pictures/students/photo/'.$studentSessionData['photo_dir'].'/'.$studentSessionData['photo'], ['alt' => $studentSessionData['first_name'].' '.$studentSessionData['last_name']]) ?>
                    <a href="javascript:;"><img src="" alt="" /></a>
                </div>
                <div class="info">
                    <?= $studentSessionData['first_name'] .' '.$studentSessionData['last_name'] ?>
                    <small> student </small>
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

