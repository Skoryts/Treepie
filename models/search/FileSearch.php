<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\File;

/**
 * FileSearch represents the model behind the search form about `app\models\File`.
 */
class FileSearch extends File
{
	public function rules()
	{
		return [
			[['id', 'userId', 'relationTypeId', 'relationId'], 'integer'],
			[['path', 'name', 'originalName', 'extension', 'type', 'createdAt', 'updatedAt'], 'safe'],
		];
	}

	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params, $pageSize = 20)
	{
		$query = File::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
			'pagination' => [
				'pageSize' => $pageSize,
			],
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'userId' => $this->userId,
			'relationTypeId' => $this->relationTypeId,
			'relationId' => $this->relationId,
		]);

		$query->andFilterWhere(['like', 'path', $this->path])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'originalName', $this->originalName])
			->andFilterWhere(['like', 'extension', $this->extension])
			->andFilterWhere(['like', 'type', $this->type])
			->andFilterWhere(['createdAt', 'type', $this->createdAt])
			->andFilterWhere(['updatedAt', 'type', $this->updatedAt]);

		return $dataProvider;
	}
}
