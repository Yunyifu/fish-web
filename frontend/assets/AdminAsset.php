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
 * 用户管理中心admin asset
 * 
 * @author Ather.Shu Oct 11, 2016 5:23:51 PM
 */
class AdminAsset extends AssetBundle {

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [ 
        'css/reset.css',
        'css/base.css',
        'css/backstage.css',
        'css/uploadfile.css',
    ];

    public $js = [
        'js/common.js',
//         'js/dropzone.js',
            'js/jquery.ui.widget.js',
         'js/jquery.iframe-transport.js',
        'js/jquery.fileupload.js',
        'js/uploadfile.js',
     ];

    public $depends = [ 
        'yii\web\YiiAsset',
        'frontend\assets\DateTimePickerAsset',
    ];
}