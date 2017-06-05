<?php
// ////////////////////////////////////////////////////////////////////////////
//
// ATHER.SHU WWW.ASAREA.CN
// All Rights Reserved.
// email: shushenghong@gmail.com
//
// ///////////////////////////////////////////////////////////////////////////
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Ather.Shu Jul 14, 2015 10:04:26 AM
 */
class DateTimePickerAsset extends AssetBundle {

    public $sourcePath = '@bower/datetimepicker';

    public $js = [ 
        'build/jquery.datetimepicker.full.js' 
    ];

    public $css = [ 
        'jquery.datetimepicker.css' 
    ];
}