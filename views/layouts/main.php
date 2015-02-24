<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
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
	<?php //todo: create partial view for sidebar and menu [@tooleks] ?>
	<div class="sidebar">
		<div class="logotype">
			<a href="<?= Url::to(['/']) ?>"><img src="../img/logo.png" alt="treepie logo"/></a>
		</div>
		<nav class="navigation">
			<ul>
				<li>
					<span>Інтер'єр</span>
					<ul class="toggle-menu">
						<li><a href="">Веб дизайн</a></li>
						<li><a href="">Верстка</a></li>
						<li><a href="">Розробка</a></li>
						<li><a href="">Програмування</a></li>
					</ul>
				</li>
				<li>
					<span>Дизайн</span>
					<ul class="toggle-menu">
						<li><a href="">Веб дизайн</a></li>
						<li><a href="">Верстка</a></li>
						<li><a href="">Розробка</a></li>
						<li><a href="">Програмування</a></li>
					</ul>
				</li>
				<li>
					<span>Розробка</span>
					<ul class="toggle-menu">
						<li><a href="">Веб дизайн</a></li>
						<li><a href="">Верстка</a></li>
						<li><a href="">Розробка</a></li>
						<li><a href="">Програмування</a></li>
					</ul>
				</li>
				<li>
					<span>Handmade</span>
					<ul class="toggle-menu">
						<li><a href="">Веб дизайн</a></li>
						<li><a href="">Верстка</a></li>
						<li><a href="">Розробка</a></li>
						<li><a href="">Програмування</a></li>
					</ul>
				</li>
				<script>

				</script>
			</ul>
		</nav>
	</div>
	<div class="wrapper">
		<?php //todo: create partial view for header [@tooleks] ?>
		<div class="header">
			<span class="filter">Найпопулярніші</span>

			<form class="search" action="" name="search">
				<input type="text">
				<input type="submit" value="пошук">
			</form>
		</div>
		<div class="filter-menu">
			<div class="fix-block">
				<ul>
					<li>Інтер’єр</li>
					<li><span class="filter-tag">#балкон</span></li>
					<li><span class="filter-tag">#кухня</span></li>
					<li><span class="filter-tag">#спальня</span></li>
					<li><span class="filter-tag">#дім</span></li>
					<li><span class="filter-tag">#квартира</span></li>
					<li><span class="filter-tag">#альтанка</span></li>
				</ul>
				<ul>
					<li>Handmade</li>
					<li><span class="filter-tag">#іграшки</span></li>
					<li><span class="filter-tag">#біжутерія</span></li>
					<li><span class="filter-tag">#одяг</span></li>
					<li><span class="filter-tag">#відкритки</span></li>
				</ul>
				<ul>
					<li>Розробка</li>
					<li><span class="filter-tag">#css</span></li>
					<li><span class="filter-tag">#php</span></li>
					<li><span class="filter-tag">#design</span></li>
					<li><span class="filter-tag">#seo</span></li>
					<li><span class="filter-tag">#html</span></li>
					<li><span class="filter-tag">#js</span></li>
				</ul>
				<ul>
					<li>Mock up</li>
					<li><span class="filter-tag">#bottle</span></li>
					<li><span class="filter-tag">#screen</span></li>
					<li><span class="filter-tag">#device</span></li>
					<li><span class="filter-tag">#mock up</span></li>
				</ul>
				<?php //todo: create form model and partial view for search form [@tooleks] ?>
				<div class="filter-search">
					<div>
						<ul>
						</ul>
						<a href="" class="search-btn"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="content cf">
			<?php //todo: create template for the breadcrumbs navigation [@tooleks] ?>
			<?= $content ?>
		</div>
	</div>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>