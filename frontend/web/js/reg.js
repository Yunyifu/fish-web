$("#validation-btn").click(function() {
  if (window.count < 60) {
    return false
  }
  if (($("#registerform-username").val().length===11)) {
    var url = '/api/call'//check-mobile?mobile=' + 13588888888
    $.ajax(url, {
      type: 'post',
      dataType: 'json',
      headers: {'JOKE': 'yifu!', device: 123},
      data:{
        api: 'user/code',
        data: {
          'mobile': $("#registerform-username").val(),
          'type': codeType
        }
      },
      success: function(result){
        if (result['api_code'] === 200) {
          $("#validation-btn").text('验证码已发送').css({'color':'#dddddd'})
          window.timer = setInterval("countDown()", 1000)
        }
        else{
          alert(result['api_msg'])
        }

      }
    })
  }
  else{
    alert('请输入正确的11位手机号！')
  }
})
$("#reg-btn").click(function(){
  if (!($("#registerform-username").val().length===11)){
    return alert('手机号输入有误');
  }
  if (! $("#validation").val().length===6){
    return alert('验证码应该是六位数字');
  }
  if (! $("#password").val()===$("#repeat").val()){
    return alert('手机号输入有误');
  }
  $(this).css({'background-color': '#aaa'})
  $(this).text('正在注册')

})
var count = 60;
function countDown(){
  //console.log(count)
  if (window.count > 1) {
    count --
    $('#countDown').text(count)
    return true
  }
  $("#validation-btn").text('发送验证码')
  $('#countDown').text('')
  window.count = 60
  clearInterval(window.timer)
  return false
}
