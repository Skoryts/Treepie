<?php

use yii\helpers\Html;
use app\components\helpers\App;

$this->pageTitle = $name;
$this->title = App::getTitle([$name]);

$this->setBreadcrumbsItem($this->pageTitle);
//todo: add template [@tooleks]
?>

<div class="site-error">

    <h1><?= Html::encode($this->pageTitle) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
