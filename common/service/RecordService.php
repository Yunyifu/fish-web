<?php
namespace common\service;

use common\models\AdminLog;
use Yii;

/**
 * Class RecordService
 * 后台用户在执行操作后将操作记录计入AdminLog,一般只对更新和删除操作
 * @author yifu 2017-7-19
 */
class RecordService{

    public static function record(/*$username,$controller,$action*/){
        $username = Yii::$app->user->identity->username;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $description = '用户'.$username.'在'.date('Y-m-d H:i:s').'操作了'.$controller.'的'.$action.'方法。';
        $log = new AdminLog();
        $log->description = $description;
        $log->created_at = time();
        $log->save();
    }
}