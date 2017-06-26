<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form about `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'goods_id', 'status', 'before_refund_status', 'refund_status', 'pay_type', 'pay_platform', 'seller_id', 'buyer_id', 'pay_time', 'post_pay_time', 'created_at', 'updated_at', 'buyersee', 'sellersee'], 'integer'],
            [['sn', 'refund_reason', 'pay_trade_no', 'goods_name', 'buyer_name', 'buyer_mobile', 'buyer_addr', 'message'], 'safe'],
            [['refund_amount', 'refund_balance', 'refund_paid', 'goods_amount', 'goods_price'], 'number'],
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
        $query = Order::find();

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
            'type' => $this->type,
            'goods_id' => $this->goods_id,
            'status' => $this->status,
            'before_refund_status' => $this->before_refund_status,
            'refund_status' => $this->refund_status,
            'refund_amount' => $this->refund_amount,
            'refund_balance' => $this->refund_balance,
            'refund_paid' => $this->refund_paid,
            'goods_amount' => $this->goods_amount,
            'pay_type' => $this->pay_type,
            'pay_platform' => $this->pay_platform,
            'goods_price' => $this->goods_price,
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
            'pay_time' => $this->pay_time,
            'post_pay_time' => $this->post_pay_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'buyersee' => $this->buyersee,
            'sellersee' => $this->sellersee,
        ]);

        $query->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'refund_reason', $this->refund_reason])
            ->andFilterWhere(['like', 'pay_trade_no', $this->pay_trade_no])
            ->andFilterWhere(['like', 'goods_name', $this->goods_name])
            ->andFilterWhere(['like', 'buyer_name', $this->buyer_name])
            ->andFilterWhere(['like', 'buyer_mobile', $this->buyer_mobile])
            ->andFilterWhere(['like', 'buyer_addr', $this->buyer_addr])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
