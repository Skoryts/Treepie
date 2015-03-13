<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\User;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Categories');
$this->title = App::getTitle([$this->pageTitle, Yii::t('app', 'Control Panel')]);

$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="category-index">

	<h1><?= Html::encode($this->pageTitle) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			[
				'attribute' => 'userId',
				'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
				'value' => function ($data) {
					$user = User::findOne(['id' => $data->userId]);
					if (!empty($user)) {
						return $user->username;
					}

					return null;
				},
			],
			[
				'attribute' => 'parentCategoryId',
				'filter' => ArrayHelper::map(Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
				'value' => function ($data) {
					$parentCategory = Category::findOne(['id' => $data->parentCategoryId]);
					if (!empty($parentCategory)) {
						return $parentCategory->name;
					}

					return null;
				},
			],
			'name',
			'slug',
			'updatedAt',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'contentOptions' => ['style' => 'min-width: 70px; text-align: center;'],
			],
		],
	]); ?>

</div>