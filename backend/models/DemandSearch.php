<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Demand;

/**
 * DemandSearch represents the model behind the search form about `common\models\Demand`.
 */
class DemandSearch extends Demand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'thumb', 'num', 'price', 'demandstatus', 'otherstatus', 'area', 'position', 'desc', 'pic'], 'safe'],
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
        $query = Demand::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
            ]
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'num', $this->num])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'demandstatus', $this->demandstatus])
            ->andFilterWhere(['like', 'otherstatus', $this->otherstatus])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'pic', $this->pic]);
            $query->orderBy('created_at DESC');

        return $dataProvider;
    }
}
