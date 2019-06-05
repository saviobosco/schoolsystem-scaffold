<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Student Profile </h4>
            </div>
            <div class="panel-body">
                <?php if ($studentDetail) : ?>
                    <p> Name : <?= $studentDetail['first_name'] ?> <?= $studentDetail['first_name'] ?> </p>
                    <p> Current Class : <?= $studentDetail['class']['class'] ?> </p>
                    <p> Current Session :</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Check Result </h4>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> My Results </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <tr>
                        <th> Term </th>
                        <th> Class </th>
                        <th> Session </th>
                    </tr>
                    <?php foreach($studentResults as $studentResult) : ?>
                        <tr>
                            <td> <?= $studentResult->term->name ?> </td>
                            <td> <?= $studentResult->class->class ?> </td>
                            <td> <?= $studentResult->session->session ?> </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>