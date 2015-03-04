<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%like_number}}".
 *
 * @property integer $id
 * @property integer $relationTypeId
 * @property integer $relationId
 * @property integer $number
 */
class LikeNumber extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%like_number}}';
	}

	public function rules()
	{
		return [
			[['relationTypeId', 'relationId', 'number'], 'integer']
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'relationTypeId' => Yii::t('app', 'Relation Type ID'),
			'relationId' => Yii::t('app', 'Relation ID'),
			'number' => Yii::t('app', 'Number'),
		];
	}

	public function setNumber($value)
	{
		return $this->number = (int)$value;
	}
}