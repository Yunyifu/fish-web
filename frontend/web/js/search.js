$("form.search").submit(function(){
  if ($("#search").val()==="") {
    alert("请输入要查找的内容!!!")
    return false
  }
})
