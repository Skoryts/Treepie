<?php

namespace app\models\search;

use app\models\Category;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class ArticleSearch extends Article
{
	public function rules()
	{
		return [
			[['id', 'userId', 'categoryId', 'draft', 'published'], 'integer'],
			[['title', 'slug', 'body', 'createdAt', 'updatedAt'], 'safe'],
		];
	}

	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Article::find();

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
			'categoryId' => $this->categoryId,
			'published' => $this->published,
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'slug', $this->slug])
			->andFilterWhere(['like', 'body', $this->slug])
			->andFilterWhere(['like', 'createdAt', $this->createdAt])
			->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);

		$query->andFilterWhere([
			'draft' => Article::OPTION_NOT_DRAFT,
		]);

		return $dataProvider;
	}

	public function searchByQuery($searchQuery)
	{
		$query = Article::find();

		$query->orFilterWhere(['like', 'title', $searchQuery])
			->orFilterWhere(['like', 'slug', $searchQuery])
			->orFilterWhere(['like', 'body', $searchQuery]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['createdAt' => SORT_DESC]],
		]);

		$query->andFilterWhere([
			'published' => Article::OPTION_PUBLISHED,
			'draft' => Article::OPTION_NOT_DRAFT,
		]);

		return $dataProvider;
	}

	public function searchByTag($tag)
	{
		$query = Article::find();

		$query->andFilterWhere(['like', 'tags', $tag]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['createdAt' => SORT_DESC]],
		]);

		$query->andFilterWhere([
			'published' => Article::OPTION_PUBLISHED,
			'draft' => Article::OPTION_NOT_DRAFT,
		]);

		return $dataProvider;
	}

	public function searchByCategory(Category $category = null)
	{
		$query = Article::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['createdAt' => SORT_DESC]],
		]);

		if (!empty($category)) {
			$categoryList = \app\components\helpers\Category::getCategoryRelationList($category);

			if (!empty($categoryList)) {
				foreach ($categoryList as $category) {
					$query->orFilterWhere(['categoryId' => $category->id]);
				}
			}
		}

		$query->andFilterWhere([
			'published' => Article::OPTION_PUBLISHED,
			'draft' => Article::OPTION_NOT_DRAFT,
		]);

		return $dataProvider;
	}
}
