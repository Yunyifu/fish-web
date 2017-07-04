var reader = new FileReader();
var file;
$("#goods-pic").change(
  function(){

    if (this.files.length) {
      if (!$(this).hasClass('yes')) {
          $(this).parent().before('<label class="file-upload-btn background-plus upload-btn" for="goods-pic"><img class="preview" id="preview" src="../images/plus.png" alt=""></label>');
      }
      reader.readAsDataURL( this.files[0] )
      if (!isImg( this.files[0].name.toLowerCase() )) {
        return alert('请上传图片文件')
      }
      reader.onload=function(e){
        $("#preview").css({width: "135px",height: "135px", margin: 0})
        $("#preview").attr('src', this.result)
      }
    }
    $(this).addClass('yes')
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
