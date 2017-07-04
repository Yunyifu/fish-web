$("#slider").unslider({dots:true})
var slide = slider()
$("#slide-left").click(function(){
  slide('right')
})
$("#slide-right").click(function(){
  slide('left')
})

function slider(){
  var hidden = window.gallery*3 - 5
  var current = 0
  return function(direction){
    if (direction === 'left') {
      if (hidden > current) {
        current++
        $("#gallery ul").css('left', -(182*current) + 'px')
      }
    }
    if (direction === 'right') {
      if (current > 0) {
        current--
        $("#gallery ul").css('left', -(182*current) + 'px')
      }
    }
  }
}
