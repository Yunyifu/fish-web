<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //'css/uploadfile.css',
    ];
    public $js = [
      'js/meiqiaDefault.js'
        //'js/dropzone.js',
        //'js/uploadfile.js',
//         'https://g.alicdn.com/aliww/??h5.imsdk/2.1.5/scripts/yw/wsdk.js,h5.openim.kit/0.4.0/scripts/kit.js'
        //'https://g.alicdn.com/aliww/h5.openim.sdk/1.0.6/scripts/wsdk.js'
        //'https://g.alicdn.com/aliww/??h5.openim.sdk/1.0.6/scripts/wsdk.js,h5.openim.kit/0.3.3/scripts/kit.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\DateTimePickerAsset'
    ];
}
