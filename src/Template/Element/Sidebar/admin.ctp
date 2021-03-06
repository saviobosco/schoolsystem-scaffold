<?= $this->element('SubjectsManager.Links/sidebar') ?>
<li class="has-sub">
    <?= $this->Html->link('<i class="fa fa-institution"> </i> <span><b class="caret pull-right"></b>'.__('Academics ').' </span>','javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li class="has-sub">
            <?= $this->Html->link('<i class="fa fa-gears"> </i> <span><b class="caret pull-right"></b>'.__('Settings').'</span>','javascript:;',['escape'=>false]) ?>
            <ul class="sub-menu">
                <li>
                    <?= $this->Html->link(__('Grade Input Settings'),['plugin'=>'ResultSystem','controller'=>'Dashboard','action'=>'gradeInputs'],['escape'=>false]) ?>
                </li>
                <li>
                    <?= $this->Html->link(__('Remark Input Settings'),['plugin'=>'ResultSystem','controller'=>'Dashboard','action'=>'remarkInputs'],['escape'=>false]) ?>
                </li>
            </ul>
        </li>
        <li><?= $this->Html->link(__('Students'),['plugin'=>'ResultSystem','controller'=>'Students','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Subjects'),['plugin'=>'ResultSystem','controller'=>'Subjects','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Class Results'),['plugin'=>'ResultSystem','controller'=>'ClassResults','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('View Positions'),['plugin'=>'ResultSystem','controller'=>'StudentsPositions','action'=>'index']) ?></li>
        <li><?= $this->Html->link(__('Publish Results'),['plugin'=>'ResultSystem','controller'=>'PublishResults','action'=>'index']) ?></li>
        <li><?= $this->Html->link(__('Annual Students Promotion'),['plugin'=>'ResultSystem','controller'=>'StudentsAnnualPromotion','action'=>'index']) ?></li>
        <li><?= $this->Html->link(__('Upload Result'),['plugin'=>'ResultSystem','controller'=>'UploadResult','action'=>'uploadResult']) ?></li>
        <li><?= $this->Html->link(__('Result Processing'),['plugin'=>'ResultSystem','controller'=>'ResultProcessing','action'=>'index']) ?></li>
        <li><?= $this->Html->link(__('Students Class Count'),['plugin'=>'ResultSystem','controller'=>'StudentClassCounts','action'=>'index']) ?></li>
    </ul>
</li>
<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Student Skills System'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li class="has-sub"><?= $this->Html->link('<b class="caret pull-right"></b>'.__('Affective Dispositions'),'javascript:;',['escape'=>false]) ?>
            <ul class="sub-menu">
                <li><?= $this->Html->link(__('All Affective Skills'),['plugin'=>'SkillsGradingSystem','controller'=>'AffectiveDispositions','action'=>'index'],['escape'=>false]) ?></li>
                <li><?= $this->Html->link(__('New Affective Skills'),['plugin'=>'SkillsGradingSystem','controller'=>'AffectiveDispositions','action'=>'add'],['escape'=>false]) ?></li>
            </ul>
        </li>

        <li class="has-sub"><?= $this->Html->link('<b class="caret pull-right"></b>'.__('Psychomotor Skills'),'javascript:;',['escape'=>false]) ?>
            <ul class="sub-menu">
                <li><?= $this->Html->link(__('All Psychomotor Skills'),['plugin'=>'SkillsGradingSystem','controller'=>'PsychomotorSkills','action'=>'index'],['escape'=>false]) ?></li>
                <li><?= $this->Html->link(__('New Psychomotor Skill'),['plugin'=>'SkillsGradingSystem','controller'=>'PsychomotorSkills','action'=>'add'],['escape'=>false]) ?></li>
            </ul>
        </li>
        <li><?= $this->Html->link(__("Students" ),['plugin'=>'SkillsGradingSystem','controller'=>'Students','action'=>'index'],['escape'=>false]) ?></li>
    </ul>
</li>
<li class="has-sub">
    <?= $this->Html->link('<b class="caret pull-right"></b>'.__('Grading System'),'javascript:;',['escape'=>false]) ?>
    <ul class="sub-menu">
        <li><?= $this->Html->link(__('List All'),['plugin'=>'GradingSystem','controller'=>'ResultGradingSystems','action'=>'index'],['escape'=>false]) ?></li>
        <li><?= $this->Html->link(__('Add row'),['plugin'=>'GradingSystem','controller'=>'ResultGradingSystems','action'=>'add'],['escape'=>false]) ?></li>
    </ul>
</li>