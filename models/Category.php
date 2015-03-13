<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $parentCategoryId
 * @property string $name
 * @property string $slug
 * @property string $createdAt
 * @property string $updatedAt
 */
class Category extends ActiveRecord
{
	private $parentCategory;

	private $childCategories;

	public static function tableName()
	{
		return '{{%category}}';
	}

	public function rules()
	{
		return [
			[['name', 'slug'], 'required'],
			[['slug'], 'unique'],
			[['userId', 'parentCategoryId'], 'integer'],
			[['createdAt', 'updatedAt'], 'safe'],
			[['slug'], 'string', 'max' => 255],
			[['parentCategoryId'], 'validateParentCategory']
		];
	}

	function validateParentCategory($attribute, $param)
	{
		if ($this->parentCategoryId == $this->id) {
			$this->addError($attribute, Yii::t('app', 'Current category can not be assigned to itself.'));
		}

		$childCategories = $this->getChildCategories();
		if (!empty($childCategories)) {
			foreach ($childCategories as $childCategory) {
				if ($this->parentCategoryId == $childCategory->id) {
					$this->addError($attribute, Yii::t('app', 'Current category already assigned as parent to the selected.'));
				}
			}
		}
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'userId' => Yii::t('app', 'User'),
			'parentCategoryId' => Yii::t('app', 'Parent Category'),
			'name' => Yii::t('app', 'Name'),
			'slug' => Yii::t('app', 'Slug'),
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

	public function getParentCategory()
	{
		return $this->parentCategory = self::find()
			->where(['id' => $this->parentCategoryId])
			->one();
	}

	public function getChildCategories()
	{
		return $this->childCategories = self::find()
			->where(['parentCategoryId' => $this->id])
			->all();
	}

	public function getArticles()
	{
		return $this->hasMany(Article::className(), ['categoryID' => 'id']);
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

	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			if (!empty($this->articles)) {
				foreach ($this->articles as $article) {
					if (!$article->delete()) {
						return false;
					}
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public static function findBySlug($slug)
	{
		return self::find()
			->where(['slug' => $slug])
			->one();
	}
}