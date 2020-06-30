<?php
echo $this->Form->control('subject_id', ['options' => $subjects]);
echo $this->Form->control('session_id', ['options' => $sessions]);
echo $this->Form->control('term_id', ['options' => $terms]);
?>

