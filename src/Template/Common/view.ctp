<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= $this->fetch('title') ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->Flash->render('auth') ?>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
</div>