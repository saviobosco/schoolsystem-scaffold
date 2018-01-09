<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-laptop"></i>
        <span>Dashboard</span>
    </a>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('Dashboard'),['plugin'=>null,'controller'=>'Dashboard','action'=>'index'],['escape'=>false]) ?></li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-gears"></i>
        <span>Configuration</span>
    </a>
    <ul class="sub-menu">
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-institution"></i>
        <span>School Administration</span>
    </a>
    <ul class="sub-menu">
        <li class="has-sub">
            <?= $this->Html->link('<b class="caret pull-right"></b><i class="fa fa-calendar"></i> <span>'.__('Academic Sessions').'</span>','javascript:;',['escape'=>false,'title'=>'Academic session']) ?>
            <ul class="sub-menu">
                <li><?= $this->Html->link(__('Sessions'),['plugin'=>null,'controller'=>'Sessions','action'=>'index'],['escape'=>false]) ?></li>
                <li><?= $this->Html->link(__('Add New session'),['plugin'=>null,'controller'=>'Sessions','action'=>'add'],['escape'=>false]) ?></li>
            </ul>
        </li>
        <?= $this->element('ClassManager.Links/sidebar') ?>

    </ul>
</li>
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