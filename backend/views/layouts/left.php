<?php
use common\util\Constants;
use yii\bootstrap\Nav;
use mdm\admin\components\MenuHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <?php
        $callback = function($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
            $items && $return['items'] = $items;
            return $return;
        };
        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback),
//                'items' => [
//                    ['label' => '操作菜单', 'options' => ['class' => 'header']],
//                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'], 'visible' => YII_DEBUG],
//                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'], 'visible' => YII_DEBUG],
//                    [
//                        'label' => '用户管理',
//                        'icon' => 'fa fa-user',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '用户管理', 'icon' => 'fa fa-user ', 'url' => ['/user/index?sort=-id'], 'active' => Yii::$app->controller->id === 'user'],
//                        ]
//                    ],
//                    [
//                        'label' => '交易管理',
//                        'icon' => 'fa fa-deal',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '供应管理', 'icon' => 'fa fa-deal ', 'url' => ['/goods/index'], 'active' => Yii::$app->controller->id === 'goods'],
//                            ['label' => '需求管理', 'icon' => 'fa fa-deal ', 'url' => ['/demand/index'], 'active' => Yii::$app->controller->id === 'demand'],
//                            ['label' => '分类管理', 'icon' => 'fa fa-category ', 'url' => ['/category/index'], 'active' => Yii::$app->controller->id === 'category'],
//                            ['label' => '订单管理', 'icon' => 'fa fa-order ', 'url' => ['/order/index'], 'active' => Yii::$app->controller->id === 'order'],
//                        ]
//                    ],
//
//                    [
//                        'label' => '权限管理',
//                        'icon' => 'fa fa-cog',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '后台用户', 'icon' => 'fa fa-circle-o', 'url' => ['/admin-user/index'], 'active' => Yii::$app->controller->id === 'admin-user'],
//                            ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/route'],],
//                            ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/permission'],],
//                            ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/role'],],
//                            ['label' => '分配', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/assignment'],],
//                            ['label' => '菜单', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/menu'],],
//                            ['label' => '系统配置', 'icon' => 'fa fa-file-o', 'url' => ['/system-config/index'], 'active' => Yii::$app->controller->id === 'system-config'],
//                        ]
//                    ],
//                    [
//                        'label' => 'banner管理',
//                        'icon' => 'fa fa-cog',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'banner管理', 'icon' => 'fa fa-circle-o', 'url' => ['/banner/index'], 'active' => Yii::$app->controller->id === 'banner'],
//                        ]
//                    ],
//                    [
//                            'label'=>'认证管理',
//                            'icon' => 'fa fa-cog',
//                            'url' => '#',
//                        'items' => [
//                            ['label' => '渔民认证', 'icon' => 'fa fa-circle-o', 'url' => ['/auth/index'], 'active' => Yii::$app->controller->id === 'auth'],
//                            ['label' => '工场认证', 'icon' => 'fa fa-file-o', 'url' => ['/companyauth/index'], 'active' => Yii::$app->controller->id === 'companyauth'],
//                        ]
//                    ]
//                ],
            ]
        ) ?>
        <ul class="sidebar-menu">
            <li><a href="/site/logout" data-method="post"><i class="fa fa-sign-out"></i><span>退出登录</span></a></li>
        </ul>
    </section>

</aside>
