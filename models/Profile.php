<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property integer $userId
 * @property string $firstName
 * @property string $lastName
 */
class Profile extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%profile}}';
	}

	public function rules()
	{
		return [
			[['userId'], 'required'],
			[['userId'], 'integer'],
			[['firstName', 'lastName'], 'string', 'max' => 100],
		];
	}

	public function attributeLabels()
	{
		return [
			'userId' => Yii::t('app', 'User ID'),
			'firstName' => Yii::t('app', 'First Name'),
			'lastName' => Yii::t('app', 'Last Name'),
		];
	}
}