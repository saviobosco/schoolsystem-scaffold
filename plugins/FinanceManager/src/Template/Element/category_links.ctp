<div class="m-b-15">
    <?= $this->Html->link('All',['action'=>'index'],['class'=>'btn btn-primary m-r-10']) ?>
    <?= $this->Html->link('Edit',['action'=>'edit',$id],['class'=>'btn btn-info m-r-10']) ?>
    <?= $this->Html->link('View',['action'=>'view',$id],['class'=>'btn btn-success m-r-10']) ?>
    <?= $this->Form->postLink(__('Delete').' <i class="fa fa-trash"></i>', ['action' => 'delete', $id], ['confirm' => __('Are you sure you want to delete # {0}?', $id),'escape'=>false, 'class'=>'btn btn-danger m-r-10']) ?>
</div>