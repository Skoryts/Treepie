<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Article;
use app\models\User;

$this->pageTitle = Yii::t('app', 'Articles');
$this->setTitle([$this->pageTitle, Yii::t('app', 'Control Panel')]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="article-index">

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
				'attribute' => 'categoryId',
				'filter' => ArrayHelper::map(Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
				'value' => function ($data) {
					$category = Category::findOne(['id' => $data->categoryId]);
					if (!empty($category)) {
						return $category->name;
					}

					return null;
				},
			],
			'title',
			[
				'format' => 'raw',
				'attribute' => 'draft',
				'filter' => [Article::OPTION_NOT_DRAFT => Yii::t('app', 'No'), Article::OPTION_DRAFT => Yii::t('app', 'Yes')],
				'value' => function ($data) {
					if ($data->draft == Article::OPTION_DRAFT) {
						return Html::tag('span', '<span class="glyphicon glyphicon-ok"></span>', ['class' => 'label label-default']);
					} elseif ($data->draft == Article::OPTION_NOT_DRAFT) {
						return Html::tag('span', '<span class="glyphicon glyphicon-remove"></span>', ['class' => 'label label-success']);
					}

					return null;
				},
				'contentOptions' => ['style' => 'text-align: center;'],
			],
			[
				'format' => 'raw',
				'attribute' => 'published',
				'filter' => [Article::OPTION_NOT_PUBLISHED => Yii::t('app', 'No'), Article::OPTION_PUBLISHED => Yii::t('app', 'Yes')],
				'value' => function ($data) {
					if ($data->published == Article::OPTION_PUBLISHED) {
						return Html::tag('span', '<span class="glyphicon glyphicon-ok"></span>', ['class' => 'label label-success']);
					} elseif ($data->published == Article::OPTION_NOT_PUBLISHED) {
						return Html::tag('span', '<span class="glyphicon glyphicon-remove"></span>', ['class' => 'label label-default']);
					}

					return null;
				},
				'contentOptions' => ['style' => 'text-align: center;'],
			],
			'updatedAt',

			[
				'class' => 'yii\grid\ActionColumn',
				'buttons' => [
					'view' => function ($url, $model) {
						if (!empty($model->slug)) {
							return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']), ['/article/view', 'slug' => $model->slug], [
								'title' => Yii::t('yii', 'View'),
							]);
						} else {
							return Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-close']);
						}
					}
				],
				'contentOptions' => ['style' => 'text-align: center; min-width: 70px;'],
			],
		],
	]); ?>

</div>