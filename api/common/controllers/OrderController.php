<?php
namespace api\common\controllers;

use common\models\Order;
use common\models\OrderLog;
use common\models\Goods;
use common\util\Constants;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class OrderController extends BaseController
{
    public $needLoginActions = ['add','confirm'];

    /**
     * @api {post} /order/add 点击第一个支付支付后提交订单
     * @apiVersion 0.1.0
     * @apiParam {int} goods_id 商品ID（必填）
     * @apiGroup order
     * @apiSuccessExample 返回订单id,提示消息
     *
     * {
        "order_id": 5,
        "success": "订单生成成功，等待客户确认价格...",
        "api_code": 200
       }
     *
     */
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        //return $post['user_id'];
        $post['sn'] = date("Ymdhis").$post['user_id'].rand(100,999);
        $goods = Goods::findOne($post['goods_id']);
        //return $goods->user_id;
        if( empty($goods)){
            throw new NotFoundHttpException('商品不存在');
        }else if($post['user_id'] == $goods->user_id){
            throw new BadRequestHttpException('不能购买自己发布的商品哦！');
        }else if($goods->status == 0){
            throw new BadRequestHttpException('这个商品已被别人买走，您可以挑选其它商品...');
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $order = new Order();
            $order->goods_id = $goods->id;
            $order->sn = $post['sn'];
            $order->status = Constants::ORDER_STATUS_NOT_PAY;
            //$order->goods_amount = $post['goods_amount'];
            $order->goods_amount = $goods->price;
            $order->pay_type = Constants::PAY_TYPE_LL;
            $order->goods_name = $goods->title;
            $order->goods_price = $goods->price;
            $order->seller_id = $goods->user_id;
            $order->buyer_id = $post['user_id'];
            if( !$order->save() ) {
                throw new BadRequestHttpException( '订单存储失败' . var_export( $order->errors, true ) );
            }

            $orderlog = new OrderLog();
            $orderlog->order_id = $order->getPrimaryKey();
            $orderlog->status = $order->status;
            $goods->setStatus($post['goods_id']);
            if(!$orderlog->save()){
                throw new BadRequestHttpException('订单日志保存失败！');
            }
            $transaction->commit();
        }catch(\Exception $e){
            $transaction->rollBack();
            throw $e;
        };

        return ['order_id' => $order->id,'success'=>'订单生成成功，等待客户确认价格...'];
    }
    /**
     * @api {post} /order/confirm 点击第二个支付支付后确认订单
     * @apiVersion 0.1.0
     * @apiParam {int} order_id 订单ID（必填）
     * @apiParam {decimal} goods_amount 买家填写的定金（必填）
     * @apiGroup order
     * @apiSuccessExample
     *
     * {
        "order_id": "7",
        "success": "订单提交成功，等待支付...",
        "api_code": 200
       }
     *
     */

    public function actionConfirm()
    {
        try{
            $order_id = $this->getParam('order_id');
            $goods_amount = $this->getParam('goods_amount');
            $user_id = Yii::$app->getUser()->getId();
            $order = Order::find()->where('id = :oid and buyer_id = :uid',[':oid' => $order_id,':uid' => $user_id])->one();
            if(empty($order)){
                throw new BadRequestHttpException('订单错误！');
            }
            $data = [];
            $data['goods_amount'] = $goods_amount;
            $data['status'] = Constants::ORDER_STATUS_NOT_PAY;
            $orderlog = new OrderLog();
            $orderlog->order_id = $order_id;
            $orderlog->status = $data['status'];
            if(!$orderlog->save())
            {
                    throw new BadRequestHttpException('订单日志保存失败！');
            }
            if($order->load($data,'')&&$order->update($data))
            {
                    return ['order_id' => $order_id,'success'=>'订单提交成功，等待支付...'];
            }else{
                    throw new BadRequestHttpException('订单提交失败，请检查后再试...');
            }
            }catch (\Exception $e){
                 throw $e;
            }

    }



}
