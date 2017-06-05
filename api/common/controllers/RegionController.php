<?php

namespace api\common\controllers;

use common\models\Region;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use Yii;

class RegionController extends BaseController
{
    /*public $needLoginActions = [

    ];*/

    /**
     * @api {get} /region/province 获取省份
     * @apiVersion 0.1.0
     *
     * @apiGroup region
     *
     * @apiSuccessExample 例子：
     *
     *{
         "data": [
                {
                    "id": 2,
                    "parent_id": 1,
                    "region_name": "北京",
                    "region_type": 1,
                    "agency_id": 0,
                    "areaid": "110000",
                    "zip": "110000",
                    "code": null
                },
                {
                    "id": 3,
                    "parent_id": 1,
                    "region_name": "天津",
                    "region_type": 1,
                    "agency_id": 0,
                    "areaid": "120000",
                    "zip": "120000",
                    "code": null
                }
            ],
          "api_code": 200
     *}
     *
     **/
    public function actionProvince()
    {
        $provinces = Region::findAll( array(
            'region_type' => 1,
            'parent_id' => 1
        ));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $provinces;
    }

    /**
     * @api {get} /region/cities 获取省份下面的城市
     * @apiVersion 0.1.0
     * @apiParam {int} province 省份的id
     * @apiGroup region
     *
     * @apiSuccessExample 例子：
     *
     *{
            "data": [
                {
                    "id": 381,
                    "parent_id": 36,
                    "region_name": "西城区",
                    "region_type": 3,
                    "agency_id": 0,
                    "areaid": "110101",
                    "zip": "100000",
                    "code": "010"
                },
                {
                    "id": 382,
                    "parent_id": 36,
                    "region_name": "崇文区",
                    "region_type": 3,
                    "agency_id": 0,
                    "areaid": "110101",
                    "zip": "100000",
                    "code": "010"
                }
            ],
            "api_code": 200
      }
     *
     * */

    public function actionCities($province){
        $cities = Region::findAll( array(
            'region_type' => 2,
            'parent_id' => $province
        ));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $cities;
    }

    /**
     * @api {get} /region/regions 获取城市下面的区或县
     * @apiVersion 0.1.0
     * @apiParam {int} city 城市的id
     * @apiGroup region
     *
     * @apiSuccessExample 例子：
     *
     * {
        "data": [
        {
            "id": 36,
            "parent_id": 2,
            "region_name": "北京市辖区",
            "region_type": 2,
            "agency_id": 0,
            "areaid": "110100",
            "zip": "110100",
            "code": "010"
        },
        {
            "id": 37,
            "parent_id": 2,
            "region_name": "北京下属县",
            "region_type": 2,
            "agency_id": 0,
            "areaid": "110200",
            "zip": "110200",
            "code": "010"
        }
        ],
        "api_code": 200
    }
     *
     * */

    public function actionRegions($city){
        $regions = Region::findAll(array(
            'region_type' => 3,
            'parent_id' => $city
        ));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $regions;
    }
}
