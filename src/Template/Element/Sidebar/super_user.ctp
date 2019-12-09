<li class="has-sub">
    <?= $this->Html->link('<i class="fa fa-laptop"></i> <span>'.__('Dashboard').'</span>',['plugin'=>'Dashboard','controller'=>'Dashboard','action'=>'index'],['escape'=>false]) ?>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-gears"></i>
        <span>Configuration</span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->html->link('Settings',[
                'plugin'=>'Dashboard',
                'controller'=>'Settings',
                'action' => 'index'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Upload Banner',[
                'plugin'=>'Dashboard',
                'controller'=>'Settings',
                'action' => 'uploadBannerImage'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Upload Logo',[
                'plugin'=>'Dashboard',
                'controller'=>'Settings',
                'action' => 'uploadSchoolLogo'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Medical Issues',[
                '_name' => 'medical_issues:index'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Religions',[
                '_name' => 'religions:index'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Nationalities',[
                '_name' => 'nationalities:index'
            ],[
                'escape' => false
            ]) ?>
        </li>
        <li>
            <?= $this->html->link('Student Types',[
                '_name' => 'student_types:index'
            ],[
                'escape' => false
            ]) ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-institution"></i>
        <span>School Administration</span>
    </a>
    <ul class="sub-menu">
        <li class="">
            <?= $this->Html->link(__('Academic Sessions'),
                ['plugin'=>null,'controller'=>'Sessions','action'=>'index'],
                ['title'=>'Academic session']) ?>
        </li>
        <?= $this->element('ClassManager.sidebar') ?>
        <li>
            <?= $this->Html->link(__('TermTimeTable'),['plugin'=>'TimesTable','controller'=>'TermTimeTables','action'=>'index'],['title'=>'TermTimeTable']) ?>
        </li>
    </ul>
</li>
<?php if ($this->request->session()->read('Auth.User.is_superuser')) : ?>
<?= $this->element('UsersManager.Links/sidebar') ?>
<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b><span> Pin Management </span>','javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li class="has-sub">
            <a href="javascript:;"><b class="caret pull-right"></b> Student Result Pins</a>
            <ul class="sub-menu">
                <li><?= $this->Html->link(__('Generate Pins'),['plugin'=>'ResultSystem','controller'=>'StudentResultPins','action'=>'generate-pin'],['escape'=>false]) ?></li>
                <li><?= $this->Html->link(__('Print Pins'),['plugin'=>'ResultSystem','controller'=>'StudentResultPins','action'=>'print-pin'],['escape'=>false]) ?></li>
            </ul>
        </li>
    </ul>
</li>
<?php endif; ?>