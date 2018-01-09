<?php

use Cake\Core\Configure;

$this->assign('title','Welcome to '.Configure::read('Application.name'));
$this->layout = 'custom';
?>

<div id="page-title" class="page-title has-bg">
    <div class="bg-cover"><?= $this->Html->image('systemfiles/banner.JPG')  ?></div>
    <div class="container">
        <h1>Welcome To <?= __(Configure::read('Application.name')) ?> </h1>
    </div>
</div>
<div id="work" class="content">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">ABOUT OUR SCHOOL</h2>
        <!-- begin row -->
        <div class="row row-space-10">
            <!-- begin col-3 -->
            <div class="col-md-4 col-sm-6">
                <!-- begin work -->
                <div class="work">
                    <div class="image">
                    </div>
                    <div class="desc">
                        <span class="desc-title">Old and returning students Registration</span>
                    </div>
                </div>
                <!-- end work -->
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-4 col-sm-6">
                <!-- begin work -->
                <div class="work">
                    <div class="image">
                    </div>
                    <div class="desc">
                        <span class="desc-title">New Student Registration</span>
                    </div>
                </div>
                <!-- end work -->
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-4 col-sm-6">
                <!-- begin work -->
                <div class="work">
                    <div class="image">
                    </div>
                    <div class="desc">
                        <span class="desc-title">Apply to study</span>
                    </div>
                </div>
                <!-- end work -->
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>