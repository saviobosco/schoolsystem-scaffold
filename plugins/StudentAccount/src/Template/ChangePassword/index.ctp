<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Change password </h4>
            </div>
            <div class="panel-body">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend><?= __('Please enter the new password') ?></legend>
                    <?= $this->Form->input('current_password', [
                        'type' => 'password',
                        'required' => true,
                        'label' => __('Current password')]);
                    ?>
                    <?= $this->Form->input('password',['value' => '']); ?>
                    <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true]); ?>

                </fieldset>
                <?= $this->Form->button(__( 'Submit')); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>