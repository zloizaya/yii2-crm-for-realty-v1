<?php

namespace app\modules\clients\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\clients\models\Clients;

/**
 * ClientsSearch represents the model behind the search form of `app\modules\clients\models\Clients`.
 */
class ClientsSearch extends Clients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['surname', 'name', 'middle_name', 'phone', 'email', 'p_serial', 'p_number', 'p_date_take', 'p_who_take', 'p_code'], 'safe'],
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
        $query = Clients::find();

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
            'p_date_take' => $this->p_date_take,
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'p_serial', $this->p_serial])
            ->andFilterWhere(['like', 'p_number', $this->p_number])
            ->andFilterWhere(['like', 'p_who_take', $this->p_who_take])
            ->andFilterWhere(['like', 'p_code', $this->p_code]);

        return $dataProvider;
    }
}
