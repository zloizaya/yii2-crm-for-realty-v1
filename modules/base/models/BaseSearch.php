<?php

namespace app\modules\base\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\base\models\Base;

/**
 * BaseSearch represents the model behind the search form of `app\modules\base\models\Base`.
 */
class BaseSearch extends Base
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'agent', 'client', 'typeAds', 'typeObj', 'rid', 'kv', 'roomCount', 'floor', 'floors', 'wall', 'repair', 'balcon', 'bathroom', 'elevator', 'communication', 'plot'], 'integer'],
            [['created_at', 'updated_at', 'price_sale', 'price_owner', 'kadastr', 'land', 'city', 'street', 'house', 'title', 'totalSquare', 'liveSquare', 'kitchenSquare', 'builded', 'description', 'acres'], 'safe'],
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
        $query = Base::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'agent' => $this->agent,
            'client' => $this->client,
            'typeAds' => $this->typeAds,
            'typeObj' => $this->typeObj,
            'rid' => $this->rid,
            'kv' => $this->kv,
            'roomCount' => $this->roomCount,
            'floor' => $this->floor,
            'floors' => $this->floors,
            'wall' => $this->wall,
            'repair' => $this->repair,
            'balcon' => $this->balcon,
            'bathroom' => $this->bathroom,
            'elevator' => $this->elevator,
            'communication' => $this->communication,
            'plot' => $this->plot,
        ]);

        $query->andFilterWhere(['like', 'price_sale', $this->price_sale])
            ->andFilterWhere(['like', 'price_owner', $this->price_owner])
            ->andFilterWhere(['like', 'kadastr', $this->kadastr])
            ->andFilterWhere(['like', 'land', $this->land])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'house', $this->house])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'totalSquare', $this->totalSquare])
            ->andFilterWhere(['like', 'liveSquare', $this->liveSquare])
            ->andFilterWhere(['like', 'kitchenSquare', $this->kitchenSquare])
            ->andFilterWhere(['like', 'builded', $this->builded])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'acres', $this->acres]);

        return $dataProvider;
    }
}
