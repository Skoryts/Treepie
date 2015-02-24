<?php

namespace app\components;

use Yii;
use yii\web\View as CoreView;

class View extends CoreView
{
	public $pageTitle;

	public $bodyId;

	public function getBodyId()
	{
		if (isset($this->bodyId)) {
			return $this->bodyId;
		} else {
			return Yii::$app->controller->id . '-' . Yii::$app->controller->action->id;
		}
	}

	public function setBreadcrumbsItem($item)
	{
		if (is_array($item)) {
			$this->params['breadcrumbs'][] = $item;
		} else {
			$this->params['breadcrumbs'][] = (string)$item;
		}
	}

	public function setBreadcrumbsItems($items)
	{
		if (is_array($items)) {
			//todo: maybe better to use array_merge [@tooleks]
			foreach ($items as $item) {
				$this->setBreadcrumbsItem($item);
			}
		}
	}
}