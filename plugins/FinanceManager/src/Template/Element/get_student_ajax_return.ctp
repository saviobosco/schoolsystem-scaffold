<div class="row">
    <div class="col-sm-12">
        <div class="m-t-15">
            <?php if ( !empty($students) ) : ?>
                <ul class="media-list media-list-with-divider">
                    <?php foreach($students as $student) : ?>
                        <li class="media media-sm">
                            <a class="media-left" href="javascript:;">
                                <img src="assets/img/user-5.jpg" alt="Image is Here" class="media-object rounded-corner" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"> <?= $student->id ?></h4>
                                <p>Name : <?= $student->first_name .' '.$student->last_name ?> </p>
                                <p> Class : <?= $student->class->class ?> </p>
                                <p>
                                    <?= $this->Html->link(' View Student',[
                                        'plugin'=>null,
                                        'controller'=>'Students',
                                        'action'=>'view',
                                        '?'=>[
                                            'student_id'=>$student->id
                                        ]
                                    ],[
                                        'class'=>'btn btn-sm btn-primary m-r-5'
                                    ]) ?>
                                </p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <h2> No Result Found! </h2>
            <?php endif; ?>
        </div>
    </div>
</div>