$("a.anchor.pay").click(
  function () {
      layer.open({
      type: 1,
      title: false,
      skin: 'layui-layer-demo', //样式类名
      closeBtn: 0, //不显示关闭按钮
      anim: 2,
      shadeClose: true, //开启遮罩关闭
      content: $("#pay")
    });
  }
)
$("a.anchor.offline-pay").click(
  function () {
      layer.open({
      type: 1,
      title: false,
      skin: 'layui-layer-demo', //样式类名
      closeBtn: 0, //不显示关闭按钮
      anim: 2,
      shadeClose: true, //开启遮罩关闭
      content: $("#offline-pay")
    });
  }
)
$("button.btn").click(
function(){
if ( $("#amount").val() > 0 ) {
  var url = '/order/add'
  $.ajax(url, {
    type: 'post',
    dataType: 'json',
    //headers: {'JOKE': 'yifu!', device: 123},
    data:{
      //api: 'order/add',
      //data: {
        'user_id': user_id,
        'goods_id': goods_id
      //}
    },
    success: function(result){
      if (result['api_code'] === 200) {
        $.ajax(
          '/order/confirm',{
            type: 'post',
            dataType: 'json',
            //headers: {'JOKE': 'yifu!', device: 123},
            data:{
            //  api: 'order/confirm',
            //  data: {
                'order_id': result['order_id'],
                'goods_amount': $("#amount").val()
            //  }
            },
            success: function(result){
              if (result['api_code'] === 200) {
                  $("#order").val( result['order_id'] )
                  $("input.pay-btn").click()
              }
              else{
                alert( 456 + result['api_msg'])
              }
            }
          }
        )
      }
      else{
        alert(123 + result['api_msg'])
      }
    }
  })
}else{
  alert('请输入金额')
}

}
)
