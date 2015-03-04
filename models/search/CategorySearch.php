<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

class CategorySearch extends Category
{
	public function rules()
	{
		return [
			[['id', 'userId'], 'integer'],
			[['parentCategoryId', 'name', 'slug', 'createdAt', 'updatedAt'], 'safe'],
		];
	}

	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Category::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
			'parentCategoryId' => $this->parentCategoryId,
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'slug', $this->slug])
			->andFilterWhere(['like', 'createdAt', $this->createdAt])
			->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);

		return $dataProvider;
	}
}