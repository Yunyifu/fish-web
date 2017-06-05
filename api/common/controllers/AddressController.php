<?php
namespace api\common\controllers;

use common\models\UserAddress;
use yii\web\BadRequestHttpException;

class AddressController extends BaseController
{
    public $needLoginActions = [
        'add'
    ];

    /**
     * @api {post} /address/add 添加地址信息
     * @apiVersion 0.1.0
     * @apiParam {varchar} title 标题
     * @apiParam {int} category_id categoryID
     * @apiParam {decimal} price 采购价格
     * @apiParam {varchar} num 采购数量
     * @apiParam {varchar} demandstatus 状态需求
     * @apiParam {varchar} otherstatus 状态需求
     * @apiParam {varchar} area 地理位置
     * @apiGroup address
     * @apiSuccessExample
     *
     * {
    "data": "恭喜，地址添加成功！",
    "api_code": 200
    }
     *
     */

}