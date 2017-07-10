<?php
namespace frontend\controllers;

use common\models\Banner;
use common\models\Category;
use common\models\Demand;
use common\models\FileUploadForm;
use common\models\Goods;
use common\models\Order;
use common\models\User;
use common\util\Constants;
use Yii;
use common\models\LoginForm;
use common\models\RegisterForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\controllers\BaseController;
use yii\web\UploadedFile;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','publish-need','publish-supply'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','publish-need','publish-supply'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //Yii::$app->response->format = Yii\web\Response::FORMAT_JSON;
        //取出所有鱼类的分类
        $categoryModel = new Category();
        $categoryData = $categoryModel->find()->where(['parent_id' =>1])->andWhere(['status' => Constants::CATE_HOT])->all();
        //取出最新的4条大banner
        $bannerModel = new Banner();
        $bannerData = $bannerModel->find()->limit(4)->orderBy('rank DESC')->andWhere(['type' => 0])->all();
        $gallery = $bannerModel->find()->limit(10)->orderBy('rank DESC')->andWhere(['type' => 1])->all();
        $adv = $bannerModel->find()->where(['type' => 2])->orderBy('id DESC')->one();
        $adv = isset($adv)?$adv:'';

        //取出最新的6条需求信息
        $demandModel = new Demand();
        $demandData = $demandModel->find()->limit(6)->orderBy('created_at DESC')->all();
        //取出最新的6条供应信息
        $goodsModel = new Goods();
        $goodsData = $goodsModel->find()->limit(6)->orderBy('created_at DESC')->all();
        //取出最新成交的订单6条
        $lastOrders = Order::find()->limit(6)->orderBy('created_at DESC')->all();
        //var_dump($lastOrders[0]->test);exit;
        $buyerMobile = [];
        $sellerMobile = [];
        return $this->render('index',[
            'categoryData' => $categoryData,
            'bannerData' => $bannerData,
            'demandData' => $demandData,
            'lastOrders' => $lastOrders,
            'goodsData' => $goodsData,
            'gallery' => $gallery,
            'adv' => $adv
        ]);
    }
    /**
     * 发布页
     *
     * @return mixed
     */

    public function actionPublish()
    {
        $dataArray = Category::find()->where(['status' => 1])->andWhere(['not',['parent_id'=>NULL]])->all();
        return $this->render('publish',[
            'dataArray' => $dataArray,
        ]);
    }
    /**
     * 发布需求
     *
     * @return mixed
     */

    public function actionPublishNeed()
    {
        $demand = new Demand();
        $demand->user_id = Yii::$app->user->id;
        if(Yii::$app->request->get()){
            $id = Yii::$app->request->get('id');
            if(Demand::findOne(['id' => $id,'user_id' => $demand->user_id])){
                $demand = Demand::findOne($id);
            }
        }
        if(Yii::$app->request->post()){
            $demand->category_id = Yii::$app->request->get('cataid',1);
            $demand->load(Yii::$app->request->post());
            if ($demand->save()) {
                echo "<script>alert('发布成功！')</script>";
                return $this->redirect('/user-center/demand');
            }
        }
        return $this->render('publish-need', ['demand' => $demand]);
    }
    /**
     * 发布供应
     *
     * @return mixed
     */

    public function actionPublishSupply()
    {
        $goods = new Goods();
        $goods->user_id = Yii::$app->getUser()->getId();
        if(Yii::$app->request->get()){
            $id = Yii::$app->request->get('id');
            if(Goods::findOne(['id' => $id,'user_id' => $goods->user_id])){
                $goods = Goods::findOne($id);
            }
        }
        if(Yii::$app->request->post()){
            $goods->load(Yii::$app->request->post());
            $temp = $goods->pic;
            $goods->pic = $this->actionUpload('Goods[pic]');
            $goods->pic = isset($this->actionUpload('Goods[pic]')[0])?$goods->pic[0]:$temp;
            $goods->category_id = Yii::$app->request->get('cataid',1);
            //return var_dump($goods->pic);
            if ($goods->save()) {
                echo "<script>alert('发布成功！')</script>";
                return $this->redirect('/user-center/goods');
            }
        }
        return $this->render('publish-supply', ['goods'=> $goods]);
    }
    /**
     * 资讯列表
     *
     * @return mixed
     */

    public function actionNews()
    {
        /*$searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        return $this->render('news');
    }
    /**
     * 资讯详情
     *
     * @return mixed
     */

    public function actionNewsDetail()
    {

        return $this->render('/news/detail');
    }
    /**
     * 需求列表
     *
     * @return mixed
     */
    public function actionNeed()
    {
        /*$searchModel = new DemandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        return $this->render('need');
    }
    /**
     * 需求详情
     *
     * @return mixed
     */
    public function actionNeedDetail()
    {
        return $this->render('need-detail');
    }
    /**
     * Register a user.
     *
     * @return mixed
     */
    public function actionReg(){
        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->check()) {
                $data = ['type'=>1, 'external_uid'=>$model->username, 'external_name'=>$model->username, 'token'=>$model->validation, 'password'=>$model->password];
                $register = $this->callApi('users/oauth', $data, 'post', 'v1');
                if ($register['api_code'] == 500) {
                    $model->addError('username', $register['api_msg']);
                }
                elseif ($register['api_code'] == 401){
                    $model->addError('username',$register['api_msg']);
                }
                //return var_dump($register);
                elseif (Yii::$app->user->login( User::findOne($register['user']['id']),  3600 * 24 * 30 )) {
                    $this->redirect('/site/index');
                }
            }
        }
        return $this->render('reg', ['model'=>$model]);
    }
    public function actionResetPassword(){
        //var_dump('123');exit;
        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $data = ['mobile'=>$model->username, 'code'=>$model->validation, 'password'=>$model->password];
            if ($reset = $this->callApi('user/reset-pwd', $data, 'post', 'v1')) {
                if ($reset['api_code'] == 200) {
                  if( Yii::$app->user->login( User::findOne($reset['user']['id']),  3600 * 24 * 30 )){
                      return $this->redirect('/site/index');
                  }
                }
                else{
                    $model->addError('username', $reset['api_msg']);
                }
            }
        }
        return $this->render('reset', ['model'=>$model]);

    }

    public function actionLogin2()
    {
        $post = Yii::$app->request->post();
        //$post = json_encode($post);
        //var_dump($post);exit;
        $apiLogin = $this->callApi('users/login',$post,"post","v1");
        if($apiLogin){
            //$user = Yii::$app->getUser()->getIdentity();
            Yii::$app->response->format = Yii\web\Response::FORMAT_XML;

            return $apiLogin;
            //var_dump(Yii::$app->user->identity);exit;
        }else{
            var_dump('调用API失败');exit;
        }
    }

    public function actionTest2()
    {
        $user = Yii::$app->getUser()->getIdentity();
        Yii::$app->response->format = Yii\web\Response::FORMAT_XML;
        return $user;
    }

    public function actionTest(){
        $user = $this->callApi('deal/index',[]);
        Yii::$app->response->format = Yii\web\Response::FORMAT_XML;
        return $user;
    }

    public function actionLogin()
    {


        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $post = Yii::$app->request->post();

        if ($model->load($post)&&$model->login()) {
            return $this->redirect(['site/index']);
        } else {
            //var_dump('登录失败！');exit;
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    /*public function actionLogout()
    {
        $user = Yii::$app->getUser()->identity;
        $user2 = Yii::$app->user->identity;
        var_dump($user);
        var_dump($user2);exit;
        return $this->goHome();
    }*/

    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->response->cookies->remove( 'auth' );
        //return $this->goHome();
        return $this->redirect( [
            'index',//'id'=>'yifu'
        ] );
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword0($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionUpload($name){
        $type = 2;
        $imgs = UploadedFile::getInstancesByName($name);
        $path = [];
        foreach($imgs as $img)
        {
        $fileForm = new FileUploadForm();
        $fileForm->file = $img;
        $fileForm->type = $type;
        $savePath = $fileForm->save();
        if($savePath) {
            $path[] = $savePath;
        }
        else {
            //删除已存储图片
            //FileUploadForm::deleteUploadedFile($savePath);
            return '保存失败';
            }
        }
        return $path;
    }
}
