<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%relation_type}}".
 *
 * @property integer $id
 * @property string $name
 */
class RelationType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%relation_type}}';
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public static function getRelationIdByName($name)
    {
        $model = self::find()->where(['name' => $name])->one();

        if (!empty($model)) {
            return $model->id;
        }

        return null;
    }
}