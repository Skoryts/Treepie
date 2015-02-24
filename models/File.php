<?php

namespace app\models;

use app\components\helpers\Constant;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $relationTypeId
 * @property integer $relationId
 * @property string $type
 * @property string $path
 * @property string $name
 * @property string $originalName
 * @property string $extension
 * @property string $createdAt
 * @property string $updatedAt
 */
class File extends ActiveRecord
{
	const NAME_LENGTH = 32;
	const NAME_IMAGE_THUMBNAIL_SUFFIX = '_th';

	public $uploadedFile;

	public static $imageTypes = [
		'image/jpeg',
		'image/png',
	];

	public static function tableName()
	{
		return '{{%file}}';
	}

	public function rules()
	{
		return [
			[['originalName', 'type', 'path', 'extension'], 'required'],
			[['userId', 'relationTypeId', 'relationId'], 'integer'],
			[['createdAt', 'updatedAt'], 'safe'],
			[['type', 'path', 'originalName', 'extension'], 'string', 'max' => 255],
			[['path'], 'string', 'min' => 1],
			[['name'], 'string', 'max' => self::NAME_LENGTH],

			[['uploadedFile'], 'safe'],
			[['uploadedFile'], 'file',
				'extensions' => 'jpg, png',
				'mimeTypes' => implode(',', File::$imageTypes),
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'userId' => Yii::t('app', 'User ID'),
			'relationTypeId' => Yii::t('app', 'Relation Type ID'),
			'relationId' => Yii::t('app', 'Relation ID'),
			'type' => Yii::t('app', 'Type'),
			'path' => Yii::t('app', 'Path'),
			'name' => Yii::t('app', 'Name'),
			'originalName' => Yii::t('app', 'originalName'),
			'extension' => Yii::t('app', 'Extension'),
			'createdAt' => Yii::t('app', 'Created At'),
			'updatedAt' => Yii::t('app', 'Updated At'),

			'uploadedFile' => Yii::t('app', 'File'),
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

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (empty($this->userId)) {
				$this->userId = Yii::$app->user->id;
			}

			if (empty($this->name)) {
				$this->name = self::createFileName();
			}

			return true;
		} else {
			return false;
		}
	}

	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			if (!unlink($this->getAbsolutePath())) {
				return false;
			}

			return true;
		} else {
			return false;
		}
	}

	public function getRelativePath()
	{
		$relativePath = Constant::DIR_SEPARATOR . Constant::DIR_FILES . Constant::DIR_SEPARATOR;
		$relativePath .= $this->path . Constant::DIR_SEPARATOR;
		$relativePath .= $this->name . '.' . $this->extension;

		return $relativePath;
	}

	public function getAbsolutePath()
	{
		return Yii::getAlias('@webroot') . $this->getRelativePath();
	}

	public function exist()
	{
		return file_exists($this->absolutePath);
	}

	public static function createFile(UploadedFile $file, ActiveRecord $relationModel = null)
	{
		$model = new self;
		$model->path = self::createDirectory();
		$model->name = self::createFileName();
		$model->originalName = $file->name;
		$model->extension = $file->extension;
		$model->type = $file->type;
		if (!empty($relationModel)) {
			$model->relationTypeId = RelationType::getRelationIdByName($relationModel::className());
			$model->relationId = $relationModel->id;
		}

		$path = Constant::DIR_FILES . Constant::DIR_SEPARATOR . $model->path . Constant::DIR_SEPARATOR;
		$fileName = $model->name . '.' . $model->extension;
		if ($model->validate() && $file->saveAs($path . $fileName) && $model->exist()) {
			return $model->save(false);
		}

		return false;
	}

	private static function createFileName()
	{
		return Yii::$app->security->generateRandomString(self::NAME_LENGTH);
	}

	private static function createDirectory()
	{
		$directoryPath = Constant::DIR_FILES;
		$directoryName = (new \DateTime())->format('Y-m-d');
		$directoryFullPath = $directoryPath . Constant::DIR_SEPARATOR . $directoryName;

		if (!file_exists($directoryFullPath)) {
			if (!mkdir($directoryFullPath)) {
				return false;
			}
		}

		return $directoryName;
	}
}