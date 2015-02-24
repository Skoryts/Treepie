<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AppAsset;
use app\components\helpers\App;

/* @var $this \yii\web\View */
/* @var $content string */

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
	<div class="wrap">
		<?php
		NavBar::begin([
			'brandLabel' => Yii::$app->name . ' ' . Yii::t('app', 'Control Panel'),
			'brandUrl' => ['/admin'],
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => Yii::t('app', 'Categories'), 'url' => ['/admin/category']],
				['label' => Yii::t('app', 'Articles'), 'url' => ['/admin/article']],
				['label' => Yii::t('app', 'Files'), 'url' => ['/admin/file']],
				Yii::$app->user->isGuest ?
					['label' => 'Signin', 'url' => ['/site/signin']] :
					['label' => 'Signout (' . Yii::$app->user->identity->username . ')',
						'url' => ['/site/signout'],
						'linkOptions' => ['data-method' => 'post']],
			],
		]);
		NavBar::end();
		?>

		<div class="container">
			<?php if (count(Yii::$app->session->getAllFlashes())): ?>
				<?php foreach (Yii::$app->session->getAllFlashes() as $type => $messages) {
					foreach ($messages as $message) {
						echo Html::tag('div', $message, ['class' => 'alert alert-' . $type]);
					}
				} ?>
			<?php endif; ?>
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= $content ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left"><?= App::getCopyrights() ?></p>

			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>