<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////

namespace backend\models;

use yii\base\Model;

class SystemConfig extends Model
{
    public $param1;
    public $param2;

    public function rules(){
        return [
            [['param1'], 'required'],
            [['param1'], 'integer', 'min' => 0],
            [['param2'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'param1' => '测试参数1',
            'param2' => '测试参数2',
        ];
    }

    public function loadCurrentData()
    {
        foreach($this->attributes() as $attribute) {
            $this->$attribute = \Yii::$app->params[$attribute];
        }
    }

    public function save()
    {
        if ($this->validate()) {
            //写文件
            $configArray = $this->toArray();
            $data = "<?php return " . var_export($configArray, true) . "; ?>";
            file_put_contents(\Yii::getAlias("@common") . "/config/system_config.php", $data);
        }
    }


}