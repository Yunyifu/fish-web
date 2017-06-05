<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace backend\util;

use common\util\Constants;
/**
 *
 * @author Ather.Shu Jul 10, 2015 4:14:05 PM
 */
class Utils {

    /**
     * 获取后端图片渲染前缀
     */
    public static function getImgUrlPrefix() {
        $imgPrefix = \Yii::$app->params ['frontUrl'];
        if( !empty( \Yii::$app->params ['alibc'] ['wantu'] ['ns'] ) ) {
            $imgPrefix = "http://" . \Yii::$app->params ['alibc'] ['wantu'] ['ns'] . ".image.alimmdn.com";
        }
        return $imgPrefix;
    }
    
    /**
     * 获取图片全路径
     *
     * @param string $img 存储在数据库中的图片路径
     * @param string $default 如果img为空，用的路径
     * @return string
     */
    public static function getImgFullUrl($img, $default = "") {
        if( empty( $img ) ) {
            $img = $default;
        }
        return stripos( $img, "http:" ) === false ? ( self::getImgUrlPrefix() . $img ) : $img;
    }
    
    /**
     * 渲染一张预览图
     *
     * @param string $img
     * @return string
     */
    public static function renderPreviewImg($img, $small = false, $fixUrl = true) {
        if( empty( $img ) ) {
            return '';
        }
        $img = $fixUrl ? self::getImgFullUrl($img) : $img;
        return "<div class='img-preview " . ($small ? 'img-preview-sm' : '') . "'><img src='{$img}'></div>";
    }
    
    public static function renderPreviewImgs($imgs, $small = false, $max = null, $fixUrl = true) {
        if( empty( $imgs ) ) {
            return '';
        }
        if( is_string( $imgs ) ) {
            $imgs = explode( Constants::IMG_DELIMITER, $imgs );
        }
        $rtn = '';
        $index = 0;
        foreach ( $imgs as $img ) {
            $rtn .= self::renderPreviewImg( $img, $small, $fixUrl );
            $index++;
            if( $max && $index == $max ) {
                break;
            }
        }
        return $rtn;
    }
}