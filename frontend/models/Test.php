<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017-5-12
 * Time: 15:15
 */
namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class Test extends ActiveRecord{

    public static function tableName(){
        return "user";
    }
}
