<li class="has-sub">
    <?= $this->html->link('<i class="fa fa-dashboard"></i> Dashboard',[
        'plugin'=>'FinanceManager',
        'controller'=>'Dashboard',
        'action' => 'index'
    ],[
        'escape' => false
    ]) ?>
</li>
<li class="has-sub">
    <?= $this->html->link('<i class="fa fa-home"></i> Home',[
        'plugin'=>'FinanceManager',
        'controller'=>'Dashboard',
        'action' => 'home'
    ],[
        'escape' => false
    ]) ?>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-bars"></i><span>Fees Categories </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'FeeCategories',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
        <li>
            <?= $this->Html->link('New',[
                'plugin'=>'FinanceManager',
                'controller'=>'FeeCategories',
                'action'=>'add'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-bars"></i><span>Expenditure Categories </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'ExpenditureCategories',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
        <li>
            <?= $this->Html->link('New',[
                'plugin'=>'FinanceManager',
                'controller'=>'ExpenditureCategories',
                'action'=>'add'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-money"></i><span> Fees </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
        <li>
            <?= $this->Html->link('New',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'add'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
        <li>
            <?= $this->Html->link('Fee Statistics',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'feeStatistics'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
        <li>
            <?= $this->Html->link('Fee Query',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'feesQuery'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
        <li>
            <?= $this->Html->link('Fee Defaulters',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'feeDefaulters'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
        <li>
            <?= $this->Html->link('Fee Complete Students',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'getStudentsWithCompleteFees'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
        <li>
            <?= $this->Html->link('Add Fees to Students',[
                'plugin'=>'FinanceManager',
                'controller'=>'Fees',
                'action'=>'addFeesToStudents'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-money"></i><span>Expenditures </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List ',[
                'plugin'=>'FinanceManager',
                'controller'=>'Expenditures',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
        <li>
            <?= $this->Html->link('New',[
                'plugin'=>'FinanceManager',
                'controller'=>'Expenditures',
                'action'=>'add'
            ],
                [
                    'escape' => false
                ]
            )  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-database"></i><span>Receipts </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'Receipts',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-money"></i><span>Payment Types </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'PaymentTypes',
                'action'=>'index'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
        <li>
            <?= $this->Html->link('Add New',[
                'plugin'=>'FinanceManager',
                'controller'=>'PaymentTypes',
                'action'=>'add'
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
    </ul>
</li>
<li class="has-sub">
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        <i class="fa fa-users"></i><span>Students </span>
    </a>
    <ul class="sub-menu">
        <li>
            <?= $this->Html->link('List',[
                'plugin'=>'FinanceManager',
                'controller'=>'Students',
                'action'=>'index',
                '?' => [
                    'class_id' => 1
                ]
            ],
                [
                    'escape' => false
                ])  ?>
        </li>
    </ul>
</li>
