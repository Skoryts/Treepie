<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property integer $id
 * @property string $value
 */
class Tag extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%tag}}';
	}

	public function rules()
	{
		return [
			[['value'], 'string', 'max' => 255],
			[['value'], 'unique'],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'value' => Yii::t('app', 'Value'),
		];
	}
}