<?php if (isset($newsUpdates) && !empty($newsUpdates)) : ?>
    <ul id="js-news" class="js-hidden">
        <?php foreach($newsUpdates as $newsUpdate) :  ?>
            <li class="news-item"> <?= $this->Html->link($newsUpdate->title, ['action'=>'view', $newsUpdate->title_slug]) ?> </li>
        <?php endforeach; ?>
    </ul>
    <script>
        // start the ticker
        $('#js-news').ticker({
            controls: false
        });
    </script>
<?php endif; ?>
