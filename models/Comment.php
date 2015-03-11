<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $parentCommentId
 * @property integer $articleId
 * @property string $body
 * @property string $createdAt
 * @property string $updatedAt
 */
class Comment extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%comment}}';
	}

	public function rules()
	{
		return [
			[['userId', 'parentCommentId', 'articleId'], 'integer'],
			[['body', 'articleId'], 'required'],
			[['body'], 'string'],
			[['createdAt'], 'safe'],
			[['updatedAt'], 'string', 'max' => 45]
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

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'userId' => Yii::t('app', 'User ID'),
			'parentCommentId' => Yii::t('app', 'Parent Comment ID'),
			'articleId' => Yii::t('app', 'Article ID'),
			'body' => Yii::t('app', 'Body'),
			'createdAt' => Yii::t('app', 'Created At'),
			'updatedAt' => Yii::t('app', 'Updated At'),
		];
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'userId']);
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (empty($this->userId)) {
				$this->userId = Yii::$app->user->id;
			}

			return true;
		} else {
			return false;
		}
	}

	public static function findByArticleId($articleId)
	{
		return self::find()
			->where(['articleId' => $articleId])
			->all();
	}
}
