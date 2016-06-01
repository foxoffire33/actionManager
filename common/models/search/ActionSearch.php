<?php

namespace common\models\search;

use common\models\Action;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActionSearch represents the model behind the search form about `common\models\Action`.
 */
class ActionSearch extends Action
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organization_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['name', 'intro', 'description', 'image', 'image_facebook', 'description_facebook', 'image_twitter', 'description_twitter'], 'safe'],
        ];
    }

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
        $query = Action::find()->joinWith('organization');
        if (!Yii::$app->user->can('admin')) {
            $query->where(['organization.organization_user' => Yii::$app->user->id]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_facebook', $this->image_facebook])
            ->andFilterWhere(['like', 'description_facebook', $this->description_facebook])
            ->andFilterWhere(['like', 'image_twitter', $this->image_twitter])
            ->andFilterWhere(['like', 'description_twitter', $this->description_twitter]);

        return $dataProvider;
    }
}
