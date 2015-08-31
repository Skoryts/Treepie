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
 * @property string $tags
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property File[] $files
 */
class Article extends ActiveRecord
{
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_UPLOAD_FILE = 'file_upload';

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
			[['tags'], 'string'],

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
		$scenarios[self::SCENARIO_UPLOAD_FILE] = ['uploadedFile'];
		$scenarios[self::SCENARIO_UPDATE] = [
			'categoryId',
			'title',
			'body',
			'slug',
			'published',
			'tags',
			'uploadedFile',
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
			'tags' => Yii::t('app', 'Tags'),
			'draft' => Yii::t('app', 'Draft'),
			'Published' => Yii::t('app', 'Published'),
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

	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'categoryId']);
	}

	public function getFiles()
	{
		return $this->hasMany(File::className(), ['relationId' => 'id'])
			->where([
				'relationTypeId' => RelationType::getRelationIdByName(self::className()),
			]);
	}

	public function getComments()
	{
		return $this->hasMany(Comment::className(), ['articleId' => 'id']);
	}

	public function getLikeNumber()
	{
		return $this->hasOne(File::className(), ['relationId' => 'id'])
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
						//todo: drunk code, you better think twice [@tooleks]
						return false;
					}
				}
			}

			if (!empty($this->tags)) {
				$tags = explode(',', $this->tags);
				foreach ($tags as $value) {
					$tag = new Tag();
					$tag->value = $value;
					$tag->save();
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

	public function getTagsList()
	{
		$tagsList = [];
		if (!empty($this->tags)) {
			$tagsList = explode(',', $this->tags);
		}

		return $tagsList;
	}

	public static function getTopArticles()
	{
		//todo: add top articles business logic [@tooleks]
		$models = self::find()
			->limit(4)
			->all();

		return $models;
	}

	public static function getWorthArticles()
	{
		//todo: add worth articles business logic [@tooleks]
		$models = self::find()
			->limit(4)
			->all();

		return $models;
	}
}