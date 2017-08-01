<?php
namespace api\common\controllers;

use yii\web\UploadedFile;
use common\models\FileUploadForm;

class UploadController extends BaseController{

    public $needLoginAction = '*';
    /**
     * @api {post} /upload/upload 图片上传
     * @apiVersion 0.1.0
     * @apiParam {int} type 上传类型 1代表用户头像，2代表goods图片，3代表demand图片，4代表认证图片，5代表其它
     * @apiParam {file} imgs 上传文件的对象，多张图片，用imags[1],imags[2]...即可
     * @apiGroup upload
     *
     * @apiSuccessExample 例子：
     *
     * {
        "data":
         [
            "/3/14956913619581.png"
         ],
        "api_code": 200
        }
     */

     //图片前缀 http://dev.image.alimmdn.com


    public function actionUpload(){
        $type = $this->getParam('type');
        $imgs = UploadedFile::getInstancesByName('imgs');
        $paths = [];
        foreach($imgs as $img) {
            $fileForm = new FileUploadForm();
            $fileForm->file = $img;
            $fileForm->type = $type;
            $savePath = $fileForm->save();
            if($savePath){
                $paths [] = $savePath;
            }
            else {
                //删除已存储图片
                foreach($paths as $path){
                    FileUploadForm::deleteUploadedFile($path);
                }
                //return $fileForm;
            }

        }
        return $paths;
    }

}