<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Sign In');
$this->title = App::getTitle([$this->pageTitle]);

$this->setBreadcrumbsItem($this->pageTitle);
//todo: add template [@tooleks]
?>

<div class="site-signin">
    <h1><?= Html::encode($this->pageTitle) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'signin-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton(Yii::t('app', 'Sign In'), ['name' => 'signin-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>