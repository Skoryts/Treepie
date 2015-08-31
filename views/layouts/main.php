<?php

use yii\helpers\Html;
use app\assets\AppAsset;

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

<div class="layout">
	<div class="overlay"></div>
	<?= $this->render('/common/_panel') ?>
	<?= $this->render('/common/_aside') ?>
	<main>
		<?= $content ?>
	</main>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

