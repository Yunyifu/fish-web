<?php
namespace api\common\controllers;

use Yii;
use common\models\Companyauth;
use yii\web\BadRequestHttpException;



class CompanyauthController extends BaseController
{
    public $needLoginActions = [
        'add'
    ];
    /**
     * @api {post} /companyauth/add 添加公司认证信息
     * @apiVersion 0.1.0
     * @apiParam {varchar} name 法人代表姓名
     * @apiParam {enum} gender 性别，1代表男，2代表女
     * @apiParam {varchar} telphone 联系电话
     * @apiParam {varchar} company_pic 营业执照照片
     * @apiParam {varchar} id_hand_pic 手持身份证照片
     * @apiParam {varchar} factory_pic 工厂照片
     *
     * @apiGroup companyauth
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
        $model = new Companyauth();
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

    }
}