function Delete(id){
if (confirm('您确认要删除一条数据？')) {
  $.ajax(url,{
    type: 'post',
    dataType: 'json',
    data: {id: id},
    success: function(result){
      //console.log(result)
      location.reload()
    }
  })
}
}
