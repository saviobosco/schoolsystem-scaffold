<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Subjects Manager'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('All Subjects'),['plugin'=>'SubjectsManager','controller'=>'Subjects','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Add new Subject'),['plugin'=>'SubjectsManager','controller'=>'Subjects','action'=>'add'],['escape'=>false]) ?></li>
    </ul>
</li>