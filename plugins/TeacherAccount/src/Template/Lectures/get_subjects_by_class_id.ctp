<?php if (isset($subjects) && !empty($subjects)): ?>
    <?php foreach($subjects as $id => $name): ?>
        <option value="<?= $id ?>"> <?= $name ?> </option>
    <?php endforeach; ?>
<?php endif; ?>
