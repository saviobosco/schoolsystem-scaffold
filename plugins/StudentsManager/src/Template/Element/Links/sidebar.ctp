<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Students Manager'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('All Students'),['plugin'=>'StudentsManager','controller'=>'Students','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Add Student'),['plugin'=>'StudentsManager','controller'=>'Students','action'=>'add'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Un Active Student'),['plugin'=>'StudentsManager','controller'=>'Students','action'=>'unActiveStudents'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Change Student Class'),['plugin'=>'StudentsManager','controller'=>'Students','action'=>'changeClass'],['escape'=>false]) ?></li>
    </ul>
</li>