<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $categoryId
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $published
 * @property string $draft
 * @property string $createdAt
 * @property string $updatedAt
 */
class Article extends ActiveRecord
{
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_FILE_UPLOAD = 'file_upload';

	const OPTION_PUBLISHED = 1;
	const OPTION_NOT_PUBLISHED = 0;

	const OPTION_DRAFT = 1;
	const OPTION_NOT_DRAFT = 0;

	public $uploadedFile;

	public static function tableName()
	{
		return '{{%article}}';
	}

	public function rules()
	{
		return [
			[['categoryId', 'title', 'body', 'slug'], 'required'],
			[['slug'], 'unique'],
			[['userId', 'categoryId', 'published', 'draft'], 'integer'],
			[['body'], 'string'],
			[['title', 'slug'], 'string', 'max' => 255],
			[['createdAt', 'updatedAt'], 'safe'],

			[['uploadedFile'], 'safe'],
			[['uploadedFile'], 'file',
				'maxFiles' => 10,
				'extensions' => 'jpg, png',
				'mimeTypes' => implode(',', File::$imageTypes),
			],
		];
	}

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_FILE_UPLOAD] = ['uploadedFile'];
		$scenarios[self::SCENARIO_UPDATE] = [
			'categoryId',
			'title',
			'body',
			'slug',
			'uploadedFile',
			'published',
		];

		return $scenarios;
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'userId' => Yii::t('app', 'User'),
			'categoryId' => Yii::t('app', 'Category'),
			'title' => Yii::t('app', 'Title'),
			'slug' => Yii::t('app', 'Slug'),
			'body' => Yii::t('app', 'Body'),
			'createdAt' => Yii::t('app', 'Created At'),
			'updatedAt' => Yii::t('app', 'Updated At'),

			'uploadedFile' => Yii::t('app', 'Files'),
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

	public function getFiles()
	{
		$this->hasMany(File::className(), ['relationId' => 'id'])
			->where([
				'relationTypeId' => RelationType::getRelationIdByName(self::className()),
			]);
	}

	public function getLikeNumber()
	{
		$this->hasOne(File::className(), ['relationId' => 'id'])
			->where([
				'relationTypeId' => RelationType::getRelationIdByName(self::className()),
			]);
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (empty($this->userId)) {
				$this->userId = Yii::$app->user->id;
			}

			if ($this->scenario == self::SCENARIO_UPDATE) {
				$this->draft = self::OPTION_NOT_DRAFT;
			}

			if (!empty($this->uploadedFile)) {
				$this->uploadedFile = UploadedFile::getInstances($this, 'uploadedFile');
				foreach ($this->uploadedFile as $uploadedFile) {
					if (!File::createFile($uploadedFile, $this)) {
						//todo: think about this piece of code [@tooleks]
						return false;
					}
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
	}

	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			if (!empty($this->files)) {
				foreach ($this->files as $file) {
					if (!$file->delete()) {
						return false;
					}
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public static function findDraft($userId)
	{
		return self::find()
			->where([
				'draft' => self::OPTION_DRAFT,
				'userId' => $userId,
			])
			->one();
	}

	public static function findBySlug($slug)
	{
		return self::find()
			->where(['slug' => $slug])
			->one();
	}
}