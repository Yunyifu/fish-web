//_MEIQIA('withoutBtn')
_MEIQIA('allSet', function(){
  $(".consult").click(function(){
    _MEIQIA('showPanel')
    $.ajax('/api/call',{
      type: 'post',
      data: {
        api: 'goods/inquiry',
        method: 'get',
        data:{
          goods_id: window.id//PHP输出到js全局变量
        }
      }
    })
  })
})
/*
_MEIQIA('manualInit');

$(function(){
  _MEIQIA('init');
})

*/
