<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Mater S.O.N Page not found';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
    </title>

    <?php
    echo $this->AlaxosHtml->includeBootstrapCSS(['block' => false]);
    echo $this->AlaxosHtml->includeBootstrapThemeCSS(['block' => false]);
    echo $this->AlaxosHtml->includeAlaxosCSS(['block' => false]);
    echo $this->Site->css('font-awesome/css/font-awesome.css');
    echo $this->Html->css('custom.css');
    echo $this->Html->css('custom.min.css');

    echo $this->AlaxosHtml->includeAlaxosJQuery(['block' => false]);
    echo $this->AlaxosHtml->includeAlaxosBootstrapJS(['block' => false]);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="page-container">
    <div class="error-page">
        <div class="error-code m-b-10">404 <i class="fa fa-warning"></i></div>
        <div class="error-content">
            <div class="error-message"><?= $this->fetch('content') ?></div>
            <div class="error-desc m-b-20">
                The page you're looking for doesn't exist. <br />
                Perhaps, there pages that will help find what you're looking for.
            </div>
            <div>
                <?= $this->Html->link(__('Go Back to Home Page'),'/',['class'=>'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
