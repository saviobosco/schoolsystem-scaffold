<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Common/view');
$this->assign('title', $lecture->topic);
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Subject</th> <td> <?= $lecture->subject->name ?> </td>
                <th>Class</th> <td> <?=  $lecture->class->class ?> </td>
                <th> Session </th> <td> <?= $lecture->session->session ?> </td>
                <th> Term </th> <td> <?= $lecture->term->name ?> </td>
            </tr>
            <tr>
                <th> Week </th> <td> <?= $lecture->week ?> </td>
                <th> Created At </th> <td> <?= $lecture->created_at ?> </td>
                <th> Last Modified At</th>
                <td>
                    <?= $lecture->updated_at ?>
                </td>
            </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h4> Introduction</h4>
        <?= $lecture->introduction ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <?= $lecture->content ?>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h4>Summary</h4>
        <?= $lecture->summary ?>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h4>Exercise</h4>
        <?= $lecture->exercise ?>
    </div>
</div>
