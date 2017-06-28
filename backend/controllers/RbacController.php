<?php
/**
 * Created by PhpStorm.
 * User: yi-fu
 * Date: 2017-6-26
 * Time: 22:53
 */
namespace backend\controllers;

use backend\models\Rbac;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class RbacController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['createrole'],
                'rules' => [
                    [
                        //'actions' => ['view', 'view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreaterole(){
        if(Yii::$app->request->isPost){
            $auth = Yii::$app->authManager;
            $role = $auth->createRole(null);
            $post = Yii::$app->request->post();
            if(empty($post['name']) || empty($post['description'])){
                throw new \Exception('参数错误');
            }
            $role->name = $post['name'];
            $role->description = $post['description'];
            $role->ruleName = $post['rule_name']?$post['rule_name']:null;
            $role->data = $post['data']?$post['data']:null;
            if($auth->add($role)){
                Yii::$app->session->setFlash('info','添加成功');
            }
        }

        return $this->render('createrole');
    }

    public function actionRoles(){
        $auth = Yii::$app->authManager;
        //var_dump($auth->itemTable);exit;
        $data = new ActiveDataProvider(
            ['query' => (new Query())->from($auth->itemTable)->where('type = 1')->orderBy('created_at DESC')],
            ['pagination' => ['pageSize' => 5]]
            );


        return $this->render('index',['dataProvider' => $data]);
    }

    public function actionAssignitem($name)
    {
        $name = htmlspecialchars($name);
        $auth = Yii::$app->authManager;
        $parent = $auth->getRole($name);

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (Rbac::addChild($post['children'], $name)) {
                Yii::$app->session->setFlash('info', '分配成功');
            }
        }

        $children = Rbac::getChildrenByName($name);
        $roles = Rbac::getOptions($auth->getRoles(), $parent);
        $permissions = Rbac::getOptions($auth->getPermissions(), $parent);

        return $this->render('_assignitem', ['parent' => $name, 'roles' => $roles, 'permissions' => $permissions, 'children' => $children]);
    }

    public function actionCreaterule()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (empty($post['class_name'])) {
                throw new \Exception('参数错误');
            }
            $className = "app\\models\\". $post['class_name'];
            if (!class_exists($className)) {
                throw new \Exception('规则类不存在');
            }
            $rule = new $className;
            if (Yii::$app->authManager->add($rule)) {
                Yii::$app->session->setFlash('info', '添加成功');
            }
        }
        return $this->render("_createrule");
    }



}