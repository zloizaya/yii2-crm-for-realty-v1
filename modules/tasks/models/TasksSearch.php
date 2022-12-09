<?php

namespace app\modules\tasks\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\Tasks;

/**
 * TasksSearch represents the model behind the search form of `app\modules\tasks\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deal', 'client', 'executor', 'statement', 'comments', 'status'], 'integer'],
            [['title', 'description', 'created_at', 'updated_at', 'closed_at', 'deadline'], 'safe'],
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
        $query = Tasks::find();

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
            'closed_at' => $this->closed_at,
            'deadline' => $this->deadline,
            'deal' => $this->deal,
            'client' => $this->client,
            'executor' => $this->executor,
            'statement' => $this->statement,
            'comments' => $this->comments,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
