<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://company.zaoing.com
//
// ///////////////////////////////////////////////////////////////////////////
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 主站点 asset
 * 
 * @author Ather.Shu Oct 11, 2016 5:23:51 PM
 */
class SiteAsset extends AssetBundle {

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [ 
        'css/site.css' 
    ];

    public $js = [ ];

    public $depends = [ 
        'yii\web\YiiAsset' 
    ];
}