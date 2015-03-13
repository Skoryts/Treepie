<?php

use yii\helpers\Html;

$this->setTitle([Yii::t('app', 'Control Panel')]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel')]);

?>

<div class="row">
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading"><span
					class="glyphicon glyphicon-menu-hamburger"></span> <?= Yii::t('app', 'Navigation') ?></div>
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked">
					<li><?= Html::a(Yii::t('app', 'Categories'), ['/admin/category']) ?></li>
					<li><?= Html::a(Yii::t('app', 'Articles'), ['/admin/article']) ?></li>
					<li><?= Html::a(Yii::t('app', 'Files'), ['/admin/file']) ?></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading"><span
					class="glyphicon glyphicon-info-sign"></span> <?= Yii::t('app', 'Information') ?></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<th><?= Yii::t('app', 'Categories') ?></th>
						<td><?= $params['categoriesNumber'] ?></td>
					</tr>
					<tr>
						<th><?= Yii::t('app', 'Articles') ?></th>
						<td><?= $params['articlesNumber'] ?></td>
					</tr>
					<tr>
						<th><?= Yii::t('app', 'Files') ?></th>
						<td><?= $params['filesNumber'] ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>