<?php if (!empty($studentPsychomotorSkills)): ?>
    <table class="table-skill-score m-b-10 table-bordered table-responsive table-result">
        <thead>
        <tr>
            <th>
                Psychomotor Skills</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($studentPsychomotorSkills as $studentPsychomotorSkill): ?>
            <tr>
                <td> <?= h($studentPsychomotorSkill['psychomotor']['name'])?></td>
                <td> <?= h($studentPsychomotorSkill['score'])?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>