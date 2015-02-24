<?php

namespace app\components\helpers;

use app\models\Category as ModelCategory;
use yii\helpers\Html;

class Category
{
	public static function getBreadcrumbs(ModelCategory $category = null)
	{
		$breadcrumbs = [];

		if (!empty($category)) {
			$categories = self::getCategoryRelationList($category);

			if (!empty($categories)) {
				$categoriesNumber = count($categories);
				for ($i = $categoriesNumber - 1; $i >= 0; $i--) {
					$breadcrumbs[] = ['label' => $categories[$i]->name, 'url' => ['/article/index', 'slug' => $categories[$i]->slug]];
				}
			}
		}

		return $breadcrumbs;
	}

	public static function getCategoryRelationList(ModelCategory $category)
	{
		$list = [];

		$setParentCategory = function (ModelCategory $category) use (&$list, &$setParentCategory) {
			$list[] = $category;
			if (!empty($category->parentCategory)) {
				$setParentCategory($category->parentCategory);
			}
		};

		$setParentCategory($category);

		return $list;
	}
}