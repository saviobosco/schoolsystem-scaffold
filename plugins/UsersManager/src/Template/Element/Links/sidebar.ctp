<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Users Management'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('All Users'),['plugin'=>'UsersManager','controller'=>'Accounts','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('New User'),['plugin'=>'UsersManager','controller'=>'Accounts','action'=>'add'],['escape'=>false]) ?></li>
    </ul>
</li>