<option value=""> Select Student</option>
<?php foreach($students as $id => $name): ?>
    <option value="<?= $id ?>"> <?= $name ?> </option>
<?php endforeach ?>
