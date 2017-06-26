<?php
namespace api\common\controllers;

use common\models\Category;
use Yii;
use yii\web\NotFoundHttpException;

class CategoryController extends BaseController
{

    /**
     * @api {get} /category/firstcate 获取一级分类
     * @apiVersion 0.1.0
     *
     * @apiGroup Category
     *
     * @apiSuccessExample 例子：
     *
     * {
        "data": [
            {
                "id": 1,
                "name": "鱼类",
                "status": 1,
                "parent_id": null,
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 2,
                "name": "贝类",
                "status": 1,
                "parent_id": null,
                "created_at": null,
                "updated_at": null
            }
            ],
         "api_code": 200
         }
     *
     **/
    public function actionFirstcate()
    {
        $model = Category::find()->where(['parent_id' => null])->all();
        return $model;
    }

    /**
     * @api {get} /category/secondcate 获取二级分类
     * @apiVersion 0.1.0
     * @apiParam {int} cateId 分类id
     * @apiGroup Category
     *
     * @apiSuccessExample 例子：
     *
        {
        "data": [
            {
                "id": 3,
                "name": "鱿鱼",
                "status": 1,
                "parent_id": 1,
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 4,
                "name": "罗非鱼",
                "status": 1,
                "parent_id": 1,
                "created_at": null,
                "updated_at": null
            }
               ],
        "api_code": 200
        }
     *
     **/
    public function actionSecondcate($cateId)
    {
        $model = Category::find()->where(['parent_id' => $cateId])->all();
        return $model;
    }
    /**
     * @api {get} /category/secondall 获取所有二级分类（6-13新需求）
     * @apiVersion 0.1.0
     *
     * @apiGroup Category
     *
     * @apiSuccessExample 例子：
     *
     * {
        {
            "id": 4,
            "name": "罗非鱼",
            "status": 1,
            "parent_id": 1,
            "created_at": null,
            "updated_at": null
        }
        ],
        "api_code": 200
        }
     *
     **/
    public function actionSecondall()
    {
        $model = Category::find()->where(['status' => 1])->andWhere(['not',['parent_id'=>NULL]])->all();
        return $model;
    }

}