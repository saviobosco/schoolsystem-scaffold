<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add School Term Opening and Closing Dates');
?>
<?= $this->Form->create($termTimeTable) ?>
<fieldset>
    <legend><?= __('Add Term Time Table') ?></legend>
    <?php
    echo $this->Form->input('start_date', ['label'=>'Opening Date']);
    echo $this->Form->input('end_date', ['label' => 'Closing Date']);
    echo $this->Form->input('session_id', ['options' => $sessions, 'label' => 'For Session']);
    echo $this->Form->input('term_id', ['options' => $terms, 'label' => 'For Term']);
    echo $this->Form->input('result_session_id', ['options' => $sessions, 'label' => 'Attach to result with session']);
    echo $this->Form->input('result_term_id', ['options' => $terms, 'label' => 'Attach to result with term' ]);
    ?>
</fieldset>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>