<?php
use Cake\Utility\Inflector ;
// including the search parameter element
$this->append('sidebar',$this->element('Links/sidebar'));
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Students  </h4>
            </div>
            <div class="panel-body">
                <div class="m-b-20">
                    <div class="row">
                        <div class="col-sm-12">

                            <?= $this->element('studentsSearchCriteria') ?>

                        </div>
                    </div>

                </div>

                <?= $this->element('Links/mainLinks') ?>
                <?php if (isset($students) && !empty($students)) : ?>
                    <table id="data-table" class="table table-responsive table-bordered ">
                        <thead>
                        <tr>
                            <th><?= h('Admission No.') ?></th>
                            <th><?= Inflector::humanize('full_name') ?></th>
                            <th><?= Inflector::humanize('gender') ?></th>
                            <th><?= Inflector::humanize('class') ?></th>
                            <th><?= Inflector::humanize('status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= h($student->id) ?></td>
                                <td><?= h($student->full_name) ?></td>
                                <td><?= h($student->gender) ?></td>
                                <td><?= $student->class->class ?></td>
                                <td>
                                    <?php
                                    switch($student->status):
                                        case 1:
                                            echo '<span class="label label-success"> active </span>';
                                            break;
                                        case 0:
                                            echo '<span class="label label-danger"> unactive </span>';
                                            break;
                                        default:
                                            echo '<span class="label label-success"> unknown </span>';
                                    endswitch
                                    ?> </td>
                                <td class="actions-link">



                                    <?php /* $this->Form->postLink('<i class="fa fa-close"></i>'.__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}? . This action can not be reversed', $student->id),'class'=>'text-danger','escape' => false])*/ ?>
                                    <div class="dropdown">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="student-links" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="student-links">
                                            <li><?= $this->Html->link(__('View Profile'), ['action' => 'view', $student->id],['class'=>'text-primary']) ?> </li>
                                            <li><?= $this->Html->link(__('Edit Profile'), ['action' => 'edit', $student->id],['class'=>'text-primary']) ?></li>
                                            <li role="separator" class="divider"></li>
                                            <?php if (\Cake\Core\Plugin::loaded('ResultSystem')) :  ?>
                                                <?php if ($this->request->session()->read('Auth.User.role') === 'superuser') : ?>

                                                <li>
                                                    <?= $this->Html->link(__('View Results'), ['plugin' => 'ResultSystem', 'controller' => 'Students', 'action' => 'viewStudentResultForAdmin', $student['id']],['class'=>'text-info']) ?>

                                                </li>
                                                <li><?= $this->Html->link(__('Result Transcript'), ['action' => 'edit', $student->id],['class'=>'text-primary']) ?></li>
                                                <?php endif; ?>

                                            <?php endif; ?>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <?php if (\Cake\Core\Plugin::loaded('FinanceManager')) :  ?>
                                                <?= $this->Html->link('Pay Fees',[
                                                    'plugin' => 'FinanceManager',
                                                    'controller'=>'StudentFees',
                                                    'action'=>'getStudentFees',
                                                    $student->id
                                                ], [
                                                        'class'=>'text-primary'
                                                    ]
                                                ) ?>
                                            </li>
<!--                                            <li><?/*= $this->Html->link(__('Payment Records'), ['action' => 'edit', $student->id],['class'=>'text-primary']) */?></li>
-->                                            <?php endif; ?>
                                            <li role="separator" class="divider"></li>
                                            <?php if ($this->request->session()->read('Auth.User.role') === 'superuser') : ?>
                                                <li>
                                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['class' => 'text-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                        <p><?= $this->Paginator->counter(
                                'Page {{page}} of {{pages}}, showing {{current}} records out of
                                {{count}} total, starting on record {{start}}, ending on {{end}}'
                            ); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    (function($){
        $('#search-form select').change(function(event) {
            loadData();
        });
        $('#search-form input[type="text"]').blur(function(event){
            loadData();
        });

        function loadData() {
            $('#search-form').submit();
        }
    })(jQuery);
</script>
