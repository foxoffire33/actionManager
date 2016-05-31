<?php

namespace backend\modules\user\models\search;

use backend\modules\user\models\Role;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RoleSearch represents the model behind the search form about `\backend\modules\user\models\Role;`.
 */
class RoleSearch extends Role
{
	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Role::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'type'       => $this->type,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'rule_name', $this->rule_name])
			->andFilterWhere(['like', 'data', $this->data]);

		return $dataProvider;
	}
}
