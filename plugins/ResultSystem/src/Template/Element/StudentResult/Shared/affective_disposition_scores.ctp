<?php if (!empty($studentAffectiveDispositions)): ?>
    <table class=" table-skill-score m-b-10 table-bordered table-responsive">
        <thead>
        <tr>
            <th colspan="2" class="p-5">
                <p class="text-center" style="text-decoration: underline"> Keys </p>
                <div class="row">
                    <div class="col-sm-6">
                        <p> 5 - excellent </p>
                    </div>
                    <div class="col-sm-6">
                        <p> 4 - very good </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p> 3 - good </p>
                    </div>
                    <div class="col-sm-6">
                        <p> 2 - pass </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center"> 1 - fail </p>
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th>Affective Disposition</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($studentAffectiveDispositions as $studentAffectiveDisposition): ?>
            <tr>
                <td> <?= h($studentAffectiveDisposition['affective']['name'])?></td>
                <td> <?= h($studentAffectiveDisposition['score'])?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>