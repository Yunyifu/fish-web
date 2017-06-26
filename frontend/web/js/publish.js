$(".publish .anchor").click(function(){
  if ($(this).attr("href").indexOf("cata") === -1) {
    alert("请先选择一个分类！")
    return false;
  }
})
