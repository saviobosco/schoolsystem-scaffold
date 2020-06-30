<?php
use Cake\Core\Configure;
/**
 * sidebar.ctp
 */
?>
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <?= $this->Html->image('admin-photos/avatar_placeholder.png') ?>
                </div>
                <div class="info">
                    <?= $this->request->session()->read('Auth.User.student.first_name').' '.$this->request->session()->read('Auth.User.student.last_name') ?>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>

            <li>
                <?= $this->html->link('<i class="fa fa-laptop"></i> <span>Dashboard</span>',[
                    'controller'=>'Dashboard',
                    'action' => 'index'
                ],[
                    'escape' => false
                ]) ?>
            </li>

            <li>
                <?= $this->html->link('<i class="fa fa-user"></i> <span> My Profile</span>',[
                    'controller'=>'Profile',
                    'action' => 'index'
                ],[
                    'escape' => false
                ]) ?>
            </li>

            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-book"></i>
                    <span> E-Learning </span>
                    <span class="label label-danger">new</span>
                </a>
                <ul class="sub-menu">
                    <li class="">
                        <?= $this->Html->link(__('Lecture Notes'),
                            ['controller'=>'Lectures','action'=>'index'],
                            ['title'=>'lecture notes']) ?>
                    </li>
                </ul>
            </li>

            <li>
                <?= $this->html->link('<i class="fa fa-key"></i> <span>Change Password</span>',[
                    'plugin'=>'StudentAccount',
                    'controller'=>'ChangePassword',
                    'action' => 'index'
                ],[
                    'escape' => false
                ]) ?>
            </li>
            <li>
                <?= $this->html->link('<i class="fa fa-power-off"></i> <span>Log Out</span>',[
                    'plugin'=>'StudentAccount',
                    'controller'=>'Logout',
                    'action' => 'index'
                ],[
                    'escape' => false
                ]) ?>
            </li>
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->

