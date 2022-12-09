<?php

namespace app\modules\residential\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\residential\models\Residential;

/**
 * ResidentialSearch represents the model behind the search form of `app\modules\residential\models\Residential`.
 */
class ResidentialSearch extends Residential
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'developer'], 'integer'],
            [['title', 'land', 'city', 'distric', 'street', 'law', 'floors', 'squares', 'type_buildings', 'stage', 'deadline', 'comfort', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Residential::find();

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
            'developer' => $this->developer,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'land', $this->land])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'distric', $this->distric])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'law', $this->law])
            ->andFilterWhere(['like', 'floors', $this->floors])
            ->andFilterWhere(['like', 'squares', $this->squares])
            ->andFilterWhere(['like', 'type_buildings', $this->type_buildings])
            ->andFilterWhere(['like', 'stage', $this->stage])
            ->andFilterWhere(['like', 'deadline', $this->deadline])
            ->andFilterWhere(['like', 'comfort', $this->comfort])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
