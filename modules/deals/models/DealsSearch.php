<?php

namespace app\modules\deals\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\deals\models\Deals;

/**
 * DealsSearch represents the model behind the search form of `app\modules\deals\models\Deals`.
 */
class DealsSearch extends Deals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_deal', 'buyer', 'seller', 'status', 'object', 'task', 'responsible'], 'integer'],
            [['title', 'created_at', 'updated_at', 'closed_at', 'price', 'commission'], 'safe'],
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
        $query = Deals::find();

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
            'type_deal' => $this->type_deal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'closed_at' => $this->closed_at,
            'responsible' => $this->responsible,
            'buyer' => $this->buyer,
            'seller' => $this->seller,
            'responsible' => $this->responsible,
            'status' => $this->status,
            'object' => $this->object,
            'task' => $this->task,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'commission', $this->commission]);

        return $dataProvider;
    }
}
