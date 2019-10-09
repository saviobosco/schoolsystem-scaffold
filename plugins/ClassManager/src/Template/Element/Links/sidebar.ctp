<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Class Manager'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('All Classes'),['plugin'=>'ClassManager','controller'=>'Classes','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Add Class'),['plugin'=>'ClassManager','controller'=>'Classes','action'=>'add'],['escape'=>false]) ?></li>
    </ul>
</li>