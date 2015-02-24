<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%like}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $relationTypeId
 * @property integer $relationId
 */
class Like extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%like}}';
    }

    public function rules()
    {
        return [
            [['userId', 'relationTypeId', 'relationId'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'relationTypeId' => Yii::t('app', 'Relation Type ID'),
            'relationId' => Yii::t('app', 'Relation ID'),
        ];
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $likeNumber = LikeNumber::find()
            ->where([
                'relationTypeId' => $this->relationTypeId,
                'relationId' => $this->relationId,
            ])
            ->one();

        if (empty($likeNumber)) {
            $likeNumber = new LikeNumber();
            $likeNumber->relationTypeId = $this->relationTypeId;
            $likeNumber->relationId = $this->relationId;
        }

        $likeNumber->number = self::find()
            ->where([
                'relationTypeId' => $this->relationTypeId,
                'relationId' => $this->relationId,
            ])
            ->count();

        $likeNumber->save(false);
    }
}