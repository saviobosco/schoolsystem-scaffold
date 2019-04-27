<div>
    <table class="table table-bordered">
        <tr>
           <?php foreach($resultGradings as $grade => $score) : ?>
                <td> <?=  $grade ?> = <?= $score ?> </td>
           <?php endforeach ?>
        </tr>
    </table>
</div>