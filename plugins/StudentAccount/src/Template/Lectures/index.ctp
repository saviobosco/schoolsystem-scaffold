<?php
use Cake\I18n\Time;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Lecture Notes  </h4>
            </div>
            <div class="panel-body">
                <div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Current Class</th>
                            <td><?= $current_class ?></td>
                            <th>Current Session: </th>
                            <td> <?= $current_session ?></td>
                            <th> Current Term: </th>
                            <td> <?= $current_term ?> </td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-6">
                    <?php if (isset($subjects) && !empty($subjects)): ?>
                        <ul>
                            <?php foreach ($subjects as $subject): ?>
                                <li style="margin-bottom: 10px;">
                                    <a target="show-lecture-notes" href="<?= $this->Url->build([
                                        'action' => 'getLectureNotes',
                                        '?' => ['subject_id' => $subject->id
                                        ]
                                    ]) ?>">
                                        <?= $subject->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </div>
                <div class="col-sm-6" id="show-lecture-notes">

                </div>


            </div>
        </div>
    </div>
</div>
