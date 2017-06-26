<?php
use common\util\Constants;
return [
    'adminEmail' => 'admin@example.com',
    'buyStatusText' => [
        Constants::ORDER_STATUS_NOT_PAY => '待支付',
        Constants::ORDER_STATUS_CANCEL => '<span class="grey">已取消</span>',
        Constants::ORDER_STATUS_PAID => '<span class="red">已支付：</span>',
        Constants::ORDER_STATUS_CONFIRMED => '<span class="green">待发货:</span>',
        Constants::ORDER_STATUS_DELIVERED => '<span class="green">已发货</span>',
        Constants::ORDER_STATUS_FINISHED => '<span class="grey">已完成</span>',
        Constants::ORDER_STATUS_REFUND => '退货'
    ],
    'sellStatusText' => [
        Constants::ORDER_STATUS_NOT_PAY => '待支付',
        Constants::ORDER_STATUS_CANCEL => '<span class="grey">已取消</span>',
        Constants::ORDER_STATUS_PAID => '<span class="red">收到货款：</span>',
        Constants::ORDER_STATUS_CONFIRMED => '<span class="green">待发货:</span>',
        Constants::ORDER_STATUS_DELIVERED => '<span class="green">已发货</span>',
        Constants::ORDER_STATUS_FINISHED => '<span class="grey">已完成</span>',
        Constants::ORDER_STATUS_REFUND => '退货'
    ],

];
