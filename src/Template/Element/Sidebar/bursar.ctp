<li class="has-sub">
    <?= $this->Html->link('<i class="fa fa-money"></i><span> <b class="caret pull-right"></b> Finance Manager </span>','javascript:;',['escape'=>false,'title'=>'Finance Manager']) ?>
    <ul class="sub-menu">
        <?= $this->element('FinanceManager.Links/sidebar') ?>
    </ul>
</li>