<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body id="<?= $this->getBodyId() ?>">
	<?php $this->beginBody() ?>
	<div class="sidebar">
		<div class="logotype">
			<a href="<?= Url::to(['/']) ?>" class="logo"><img src="../img/logo.png" alt="treepie logo"/></a>
			<a href="<?= Url::to(['/']) ?>" class="slim-logo"><img src="../img/slim-logo.png" alt="treepie logo"></a>
		</div>
		<?= $this->render('/common/_navigation') ?>
		<div class="back-button"></div>
	</div>
	<div class="wrapper">
		<?php //todo: remove this fucking condition hardcode (frontend) [@tooleks] ?>
		<div class="<?= (Yii::$app->controller->id == 'article' && Yii::$app->controller->action->id == 'view') ? 'content-textpage' : 'content' ?>">
			<?= $content ?>
		</div>
		<?= $this->render('/common/_aside') ?>
	</div>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>