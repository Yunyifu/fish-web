<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://company.zaoing.com
//
// ///////////////////////////////////////////////////////////////////////////
namespace api\common\controllers;

use common\models\Banner;
use common\models\Goods;
use common\util\Constants;
use yii\helpers\ArrayHelper;
use common\models\User;


class HomeController extends BaseController {

    public $needLoginActions = [ ];
    /**
     * @api {get} /home/index 首页banner信息
     * @apiVersion 0.1.0
     * @apiGroup home
     *
     *
     * @apiSuccessExample 例子：type 1 为小图 type 0 为大图

     *{
    "bigbanner": [
    {
    "id": "4",
    "file_path": "/1/14957091718712.jpg",
    "link_path": "www.4399.com",
    "created_at": "1495709183",
    "updated_at": "1495709183",
    "rank": "1",
    "title": "1",
    "type": "0"
    },
    {
    "id": "5",
    "file_path": "/1/14957091923763.jpg",
    "link_path": "www.baidu.com",
    "created_at": "1495709202",
    "updated_at": "1495709202",
    "rank": "2",
    "title": "1",
    "type": "0"
    },
    {
    "id": "6",
    "file_path": "/1/14957092125675.jpg",
    "link_path": "www.4399.com",
    "created_at": "1495709223",
    "updated_at": "1495709223",
    "rank": "3",
    "title": "狗",
    "type": "0"
    }
    ],
    "smallbanner": [
    {
    "id": "1",
    "file_path": "/1/14957087952811.jpg",
    "link_path": "www.baidu.com",
    "created_at": "1495708817",
    "updated_at": "1495709094",
    "rank": "1",
    "title": "狗",
    "type": "1"
    },
    {
    "id": "2",
    "file_path": "/1/1495708855778.jpeg",
    "link_path": "www.sina.com",
    "created_at": "1495708873",
    "updated_at": "1495708873",
    "rank": "2",
    "title": "捏狗",
    "type": "1"
    },
    {
    "id": "3",
    "file_path": "/1/14957088911210.jpeg",
    "link_path": "www.4399.com",
    "created_at": "1495708908",
    "updated_at": "1495708908",
    "rank": "3",
    "title": "日狗",
    "type": "1"
    }
    ],
    "api_code": 200
    }
     */
    public function actionIndex() {
        // 分类

        // 大banner轮播
        $bigBanner = Banner::find()->where( [
            'type' => Constants::BIG_BANNER
        ] )->orderBy( 'rank asc' )->all();
        // 首页的小banner
        $smallBanner = Banner::find()->where([
            'type' => Constants::SMALL_BANNER
        ])->orderBy( 'rank asc')->all();
        // 精选信息

        return [ 
            'bigbanner' => $bigBanner,
            'smallbanner' => $smallBanner,
        ];
    }

    public function actionHotgoods(){
        $num3 = $this->getParam('goods',3,true);
        $goods = Goods::find()->orderBy('rank')->limit($num3)->all();
        return [
            'hotgoods' => $goods,
        ];
    }
    /**
     * @api {get} /home/hotgoods 首页精选信息
     * @apiVersion 0.1.0
     * @apiGroup home
     *@apiParam {int} goods 精选数量，默认为3条
     *
     * @apiSuccessExample 例子

    {
    "hotgoods": [
    {
    "id": "1",
    "title": "杭州湾鱿鱼1吨，欢迎采购！",
    "thumb": "2/123.jpg",
    "user_id": "4",
    "category_id": "1",
    "num": "1",
    "price": "198.00",
    "area": "杭州湾码头",
    "position": "中国浙江杭州",
    "status": "1",
    "desc": "杭州湾有新鲜鱿鱼1吨，量大从优！",
    "pic": "/2/1.jpg||/2/2.jpg",
    "created_at": "1",
    "updated_at": null,
    "rank": 9999,
    "username": "15889897125",
    "nickname": "用户1494929694644",
    "avatat": "123456789",
    "gender": "0",
    "categoryId": "1",
    "categoryName": "鱼类",
    "categoryParent_id": null
    },
    {
    "id": "3",
    "title": "杭州湾贝壳2吨，欢迎采购！",
    "thumb": "2/123.jpg",
    "user_id": "4",
    "category_id": "1",
    "num": "1",
    "price": "198.00",
    "area": "杭州湾码头2",
    "position": "中国浙江杭州2",
    "status": "1",
    "desc": "杭州湾有新鲜鱿鱼1吨，量大从优！",
    "pic": "/2/1.jpg||/2/2.jpg",
    "created_at": "2",
    "updated_at": null,
    "rank": 9999,
    "username": "15889897125",
    "nickname": "用户1494929694644",
    "avatat": "123456789",
    "gender": "0",
    "categoryId": "1",
    "categoryName": "鱼类",
    "categoryParent_id": null
    },
    {
    "id": "4",
    "title": "杭州湾程序猿3吨，欢迎采购！",
    "thumb": "2/123.jpg",
    "user_id": "4",
    "category_id": "2",
    "num": "1",
    "price": "198.00",
    "area": "杭州湾码头2",
    "position": "中国浙江杭州2",
    "status": "1",
    "desc": "杭州湾有新鲜鱿鱼1吨，量大从优！",
    "pic": "/2/1.jpg||/2/2.jpg",
    "created_at": "3",
    "updated_at": null,
    "rank": 9999,
    "username": "15889897125",
    "nickname": "用户1494929694644",
    "avatat": "123456789",
    "gender": "0",
    "categoryId": "2",
    "categoryName": "贝类",
    "categoryParent_id": null
    }
    ],
    "api_code": 200
    }
     */
    public function actionVersion(){
        return [
            'code' => 200,
            'versionCode' =>'8',
            'version'=>'1.0.1',
        ];
    }
}