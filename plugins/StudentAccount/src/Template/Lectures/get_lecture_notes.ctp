<div class="m-b-15">
    <h2> <?= $subject->name ?> </h2>
</div>

<?php if (isset($lectures) && !empty($lectures)): ?>
    <ol>
        <?php foreach($lectures as $lecture): ?>
            <li style="margin-bottom: 15px;">
                <a href="<?= $this->Url->build(['action' => 'view', $lecture->id]) ?>"> <?= $lecture->topic ?> </a>
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>
