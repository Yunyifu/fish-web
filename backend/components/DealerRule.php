<?php
namespace backend\components;


use Yii;
use yii\rbac\Rule;


class DealerRule extends Rule
{
    public $name = 'Dealer';
    public function execute($user, $item, $params)
    {
        // 这里先设置为false,逻辑上后面再完善
        return false;
    }
}