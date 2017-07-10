//轮播
$("#slider").unslider({dots:true})
var slide = slider()
$("#slide-left").click(function(){
  slide('right')
})
$("#slide-right").click(function(){
  slide('left')
})

//相册滚动
function slider(){
  var hidden = window.gallery - 5
  var current = 0
  return function(direction){
    if (direction === 'left') {
      if (hidden > current) {
        current++
        $("#gallery ul").animate({left: -(182*current) + 'px'}, "normal");
        //console.log(-(182*current) + 'px')
      }
    }
    if (direction === 'right') {
      if (current > 0) {
        current--
        $("#gallery ul").animate({left: -(182*current) + 'px'}, "normal");
        //$("#gallery ul").css('left', -(182*current) + 'px')
      }
    }
  }
}
//客服按钮
$(".cs").click(function(){
  $("#MEIQIA-BTN").click()
})
//滚到到顶部
$('.top').click(function(){
  $('html, body').animate({scrollTop:0}, 'slow');
});
//最新动态滚动
function newsSlide(){
  var news = $("#latest")
  var nodes = $("li", news)
  if (nodes.length>3) {
    var node = nodes[nodes.length-1]
    $(node).hide()
    news.prepend( nodes[nodes.length-1] )
    $(node).slideDown()
  }
}
setInterval(newsSlide, 2000)
