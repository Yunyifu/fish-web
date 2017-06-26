<?php
namespace api\common\controllers;

use Yii;
use common\models\Auth;
use yii\web\BadRequestHttpException;



class AuthController extends BaseController
{
    public $needLoginActions = [
        'add'
    ];
    /**
     * @api {post} /auth/add 添加认证信息
     * @apiVersion 0.1.0
     * @apiParam {varchar} name 用户姓名
     * @apiParam {enum} gender 性别，1代表男，2代表女
     * @apiParam {varchar} telphone 联系电话
     * @apiParam {varchar} id_hand_pic 手持身份证照片
     * @apiParam {varchar} ship_auth_pic 船舶证书照片
     * @apiParam {varchar} ship_pic 船舶照片
     *
     * @apiGroup auth
     * @apiSuccessExample
     *
     * {
        "data": "您的认证信息已提交，等待管理员审核！",
        "api_code": 200
       }
     *
     */
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        $model = new Auth();
        $result = $model->find()->where(['user_id' => $post['user_id']])->one();
        if($result){
            try{
                $post['status'] = 1;
                $result->load($post,'');
                $result->update($post);
                return '您提交的信息已更新，请等待审核！';
            }catch(\Exception $e){
                throw new BadRequestHttpException('提交更新失败，请重试！');
            }
        }
        try{
            $post['status'] = 1;
            $model->load($post,'')&&$model->save($post);
            return '您的认证信息已提交，等待管理员审核！';
        }catch(\Exception $e){
            throw new BadRequestHttpException('提交失败，请重试！');
        }
        /*$post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        $model = new Auth();
        $result = $model->find()->where(['user_id' => $post['user_id']])->one();
        if($result){
            $post['status'] = 1;
            $result->load($post,'');
            if($result->update($post))
            {
                return '您提交的信息已更新，请等待审核！';
            }
            return '数据有误';
        }else{
            $post['status'] = 1;
            if($result->load($post,'')&&$result->save($post))
            {
                return '您提交的信息已添加，请等待审核！';
            }
        }
        throw new BadRequestHttpException('请求错误，请重试');*/

    }
}