<?php

namespace app\components\helpers;

use yii;
use DateTime;

class App
{
	public static $titlePathSeparator = ' › ';

	public static function getTitle(array $items = [])
	{
		$title[] = Yii::$app->name;

		return implode(self::$titlePathSeparator, array_merge($items, $title));
	}

	public static function getCopyrights()
	{
		$copy = '';

		$baseYear = 2015;
		$currentYear = (new DateTime())->format('Y');

		($currentYear == $baseYear) ? $copy .= $baseYear : $copy .= $baseYear . '-' . $currentYear;
		$copy .= ' &copy; ';
		$copy .= ' ' . Yii::$app->name . '.';
		$copy .= ' ' . Yii::t('app', 'All rights reserved.');

		return $copy;
	}
}