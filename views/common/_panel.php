<div class="panel">
	<a class="logo" href="<?= \yii\helpers\Url::to(['/']) ?>">
		<img src="/img/logo.png" alt="Treepie">
	</a>

	<div class="panel-menu">
		<div title="Меню"></div>
		<div title="Логін"></div>
		<div title="Теги"></div>
		<div title="Пошук"></div>
	</div>
	<div class="popup-menu">
		<div class="menu-tab">
			<nav>
				<div class="main-nav">
					<a href="" class="has-sub-menu">Дизайн</a>
					<a href="" class="has-sub-menu">Розробка</a>
					<a href="">Handmade</a>
				</div>
				<div class="sub-menu">
					<a href="">Дизайн інтер’єрів</a>
					<a href="">Дизайн сайтів</a>
					<a class="back-to-main">Назад</a>
				</div>
				<div class="sub-menu">
					<a href="">Front-end</a>
					<a href="">Back-end</a>
					<a class="back-to-main">Назад</a>
				</div>
			</nav>
		</div>
		<div class="login-tab">
			<form action="" class="login">
				<input type="text" placeholder="Пошта">
				<input type="text" placeholder="Пароль">
				<button class="btn">Увійти</button>
			</form>
		</div>
		<div class="tags-tab">
			<a href="">#балкон</a>
			<a href="">#кухня</a>
			<a href="">#спальня</a>
			<a href="">#дім</a>
			<a href="">#квартира</a>
			<a href="">#альтанка</a>
			<a href="">#design</a>
			<a href="">#seao</a>
			<a href="">#html</a>
			<a href="">#js</a>
			<a href="">#bottle</a>
			<a href="">#screen</a>
			<a href="">#device</a>
			<a href="">#mock up</a>
			<a href="">#балкон</a>
			<a href="">#кухня</a>
			<a href="">#спальня</a>
			<a href="">#дім</a>
			<a href="">#квартира</a>
			<a href="">#альтанка</a>
			<a href="">#design</a>
			<a href="">#seo</a>
			<a href="">#html</a>
			<a href="">#js</a>
			<a href="">#bottle</a>
			<a href="">#screen</a>
			<a href="">#device</a>
			<a href="">#mock up</a>
			<a href="">#балкон</a>
			<a href="">#кухня</a>
			<a href="">#спальня</a>
			<a href="">#дім</a>
			<a href="">#квартира</a>
			<a href="">#альтанка</a>
			<a href="">#design</a>
			<a href="">#seao</a>
			<a href="">#html</a>
			<a href="">#js</a>
			<a href="">#bottle</a>
			<a href="">#screen</a>
			<a href="">#device</a>
			<a href="">#mock up</a>
		</div>
		<div class="search-tab">
			<form id="search-form" action="<?= \yii\helpers\Url::to('/article/search') ?>" class="search">
				<input type="text" name="query" placeholder="<?= Yii::t('app', 'Search Query') ?>">
				<button type="submit" class="btn"><?= Yii::t('app', 'Find') ?></button>
			</form>
		</div>
	</div>
</div>
