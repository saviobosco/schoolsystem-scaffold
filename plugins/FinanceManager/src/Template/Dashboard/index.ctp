<!-- begin row -->
<div class="row">
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>Students </h4>
                <p>
                    <?= $this->cell('FinanceManager.Dashboard::getNumberOfStudents') ?>
                </p>
            </div>
            <div class="stats-link">
                <?= $this->Html->link('View Detail <i class="fa fa-arrow-circle-o-right"></i>',['controller'=>'Students','action'=>'index'],['escape'=>false]) ?>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="fa fa-money"></i></div>
            <div class="stats-info">
                <h4>
                    INCOME GENERATED
                </h4>
                <p>
                    <?= $this->cell('FinanceManager.Dashboard::getTotalIncome') ?>
                </p>
            </div>
            <div class="stats-link">
                <?= $this->Html->link('View Detail <i class="fa fa-arrow-circle-o-right"></i>',['controller'=>'Dashboard','action'=>'incomeStatistics'],['escape'=>false]) ?>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>
                    EXPENDITURES
                </h4>
                <p>
                    <?= $this->cell('FinanceManager.Dashboard::getTotalExpenditure') ?>
                </p>
            </div>
            <div class="stats-link">
                <?= $this->Html->link('View Detail <i class="fa fa-arrow-circle-o-right"></i>',['controller'=>'Dashboard','action'=>'expenditureStatistics'],['escape'=>false]) ?>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-calendar"></i></div>
            <div class="stats-info">
                <h4>SESSIONS</h4>
                <p>
                    <?= $this->cell('FinanceManager.Dashboard::getNumberOfSessions') ?>
                </p>
            </div>
            <div class="stats-link">
                <a href="#"> View Detail <i class="fa fa-arrow-circle-o-right"></i> </a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-8">
        <!--<div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"> Statistics ( Current year ) </h4>
            </div>
            <div class="panel-body">
                <div id="interactive-chart" class="height-sm"></div>
            </div>
        </div>-->
        <div class="panel panel-inverse" data-sortable-id="index-10">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Calendar</h4>
            </div>
            <div class="panel-body">
                <div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
            </div>
        </div>
    </div>
    <!-- end col-8 -->
    <!-- begin col-4 -->
    <div class="col-md-4">
        <div class="panel panel-inverse" data-sortable-id="index-6">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Income Details</h4>
            </div>
            <div class="panel-body p-t-0">

                <?= $this->cell('FinanceManager.Dashboard::getIncomeSources') ?>

            </div>
        </div>


    </div>
    <!-- end col-4 -->
</div>
<!-- end row -->
<?php /*$this->Site->script('flot/jquery.flot.min.js','plugin',['block'=>'bottomScripts'])
 $this->Site->script('flot/jquery.flot.time.min.js','plugin',['block'=>'bottomScripts'])
 $this->Site->script('flot/jquery.flot.resize.min.js','plugin',['block'=>'bottomScripts'])
$this->Site->script('flot/jquery.flot.pie.min.js','plugin',['block'=>'bottomScripts'])*/ ?>

<?php
$this->Html->scriptStart(['block' =>'bottomScripts']);

$this->Html->scriptEnd();
?>
