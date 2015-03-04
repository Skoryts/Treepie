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
 * @property string $createdAt
 * @property string $updatedAt
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
			[['createdAt', 'updatedAt'], 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'userId' => Yii::t('app', 'User ID'),
			'firstName' => Yii::t('app', 'First Name'),
			'lastName' => Yii::t('app', 'Last Name'),
			'createdAt' => Yii::t('app', 'Created At'),
			'updatedAt' => Yii::t('app', 'Updated At'),
		];
	}

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'createdAt',
				'updatedAtAttribute' => 'updatedAt',
				'value' => new Expression('NOW()'),
			],
		];
	}
}