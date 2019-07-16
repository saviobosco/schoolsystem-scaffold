<div>
    <table class="table result-details-table">
        <tbody>
        <tr>
            <th> Name</th>
            <td colspan="5" class="name"> <?= $student['first_name'].' '.$student['last_name'] ?></td>
        </tr>
        <tr>
            <th>
                Admission No
            </th>
            <td colspan="5" class="name">
                <?= $student['id'] ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Term') ?></th>
            <td colspan=""><?= h($terms[$term_id])?></td>
            <th><?= __('Session') ?></th>
            <td colspan=""><?= h($sessions[$session_id]) ?></td>
            <th><?= __('Class') ?></th>
            <td colspan=""><?= h($classes[$class_id]) ?></td>
        </tr>
        </tbody>
    </table>
</div>