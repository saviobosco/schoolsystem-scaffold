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

                <div class="col-sm-12">
                    <div class="m-b-15">
                        <h2> <?= $subject->name ?> </h2>
                    </div>

                    <?php if (isset($lectures) && !empty($lectures)): ?>
                        <ol>
                            <?php foreach($lectures as $lecture): ?>
                                <li style="margin-bottom: 15px;">
                                    <a href="<?= $this->Url->build(['action' => 'view', $lecture->id]) ?>">
                                        <?= $lecture->topic ?> ( <?= $lecture->week ?> )
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6" id="show-lecture-notes">

                </div>


            </div>
        </div>
    </div>
</div>

