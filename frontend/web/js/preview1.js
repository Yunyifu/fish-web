var reader = new FileReader();
var file;
$("#goods-pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview").css({width: "135px",height: "135px", margin: 0})
      $("#preview").attr('src', this.result)
    }
  }
)
function isImg(filename){
  if (filename.includes('jpg')) {
    return true
  }
  if (filename.includes('jpeg')) {
    return true
  }
  if (filename.includes('gif')) {
    return true
  }
  if (filename.includes('png')) {
    return true
  }
  return false
}
