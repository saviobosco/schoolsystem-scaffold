<?php
$this->extend('/Common/view');
$this->assign('title','Edit News Updates');
?>
<?= $this->Form->create($newsUpdate) ?>
<?php
echo $this->Form->control('title');
echo $this->Form->label('post', 'Post');
echo $this->Form->textarea('post', ['class' => 'form-control', 'id' => 'wysitextarea', 'rows' => 10]);
echo $this->Form->control('default_post', ['type' => 'checkbox']);
echo $this->Form->control('status', ['options' => [ 1 => 'Active', 0 => 'Unactive']])
?>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
<script>
    $('#wysitextarea').wysihtml5();
</script>
