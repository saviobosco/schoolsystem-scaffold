<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Class Manager'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('All Classes'),['plugin'=>'ClassManager','controller'=>'Classes','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Add Class'),['plugin'=>'ClassManager','controller'=>'Classes','action'=>'add'],['escape'=>false]) ?></li>
        <li class="has-sub">
            <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Class Demarcations'),'javascript:;',['escape'=>false]) ?>
            <ul class="sub-menu">
                <li><?= $this->Html->link(__('Class Demarcations'),['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'index'],['escape'=>false]) ?></li>
                <li><?= $this->Html->link(__('add Class Demarcation'),['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'add'],['escape'=>false]) ?></li>
            </ul>
        </li>
    </ul>
</li>