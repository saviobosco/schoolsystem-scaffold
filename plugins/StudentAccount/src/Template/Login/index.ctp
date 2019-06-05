<div>
    <!-- end brand -->
    <div class="login-content">
        <?= $this->Flash->render() ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-header text-center"> Student Login </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create() ?>
                <fieldset>
                    <?= $this->Form->control('admission_number', ['required' => true]) ?>

                    <?php
                    echo $this->Html->link('Go to Homepage','/',['class' => 'pull-right']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Login'),['class'=>'btn btn-success btn-block btn-lg']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>