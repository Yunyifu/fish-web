<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use frontend\widgets\CustomForm2;
/* @var $this \yii\web\View */

$this->registerJsFile("@web/js/login.js", ['depends' => ['frontend\assets\AdminAsset'], 'position' => View::POS_END]);
$this->registerCssFile("@web/css/login.css", ['depends' => ['frontend\assets\AdminAsset']]);

$this->title = '渔鱼网平台登录';
?>
<script type="text/javascript">
    //平台、设备和操作系统
    var system ={
        win : false,
        mac : false,
        xll : false
    };
    //检测平台
    var p = navigator.platform;
    system.win = p.indexOf("Win") == 0;
    system.mac = p.indexOf("Mac") == 0;
    system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
    if(system.win||system.mac||system.xll){
    }else{
        var nowUrl = window.location.href.split('/');
        nowUrl.pop();
        nowUrl.push('phonelogin');
        nowUrl = nowUrl.join('/');
        window.location.href = nowUrl;
    }
</script>
<div class="login ">
  <div class="w1100">
    <div id="logintab" class="fr">
      <div class="tab">
        <ul >
          <li class="tab_current" id="tab11"><a href="javascript:void(0);">手机登录</a></li>
          <li class="tab_link" id="tab12"><a href="javascript:void(0);">账号注册</a></li>
        </ul>
      </div>
      <div class="tab-down">
        <div  id="sub11" style="display: block;">
            <form action="/site/login2" method="post" id="login-form">
          <div class="li_tel">
              <?= Html::input('hidden', Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
              <?= Html::input('text', 'username', '', ['class' => 'ipt phone-number rev', 'placeholder' => '请输入您的手机号']) ?>
            <span class="icon-phone"></span> </div>
          <div class=" clearfix li_code">
              <?= Html::input('password', 'password', '', ['class' => 'ipt phone-number rev', 'placeholder' => '密码']) ?>
            <!--<span class="icon-psw"></span> <a class="acquire ui-btn btn-code-big fr p0-15">获取验证码</a> </div>-->
          <p class="ft-12 mt-20 mb-20">登录即同意《<a href="/help/index?id=x9gyo" target="_blank">用户服务协议</a>》</p>
               <button type="submit" class="ui-btn btn-big br-3 wb100 bg-org login-btn">立即登录</button>
          <div class=" tac ft-12 mt-20 text-gray-9 ">————&nbsp;&nbsp;&nbsp;<a href="#" class="text-gray-9 ">下载渔鱼网APP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扫码登录更快捷&nbsp;&nbsp;&nbsp;</a>————</div>
            </form>
        </div>
        <div   id="sub12" style="display: none;">
          <div class="ercode"></div>
          <p><img src="/images/login-code-tips.png" width="310"  /></p>
        </div>
      </div>
    </div>
  </div>
</div>

