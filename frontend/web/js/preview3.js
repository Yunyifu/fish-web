var reader = new FileReader();
var file;
$("#auth-id_hand_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview1").css({width: "135px",height: "135px", margin: 0})
      $("#preview1").attr('src', this.result)
    }
  }
)
$("#auth-ship_auth_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview2").css({width: "135px",height: "135px", margin: 0})
      $("#preview2").attr('src', this.result)
    }
  }
)
$("#auth-ship_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview3").css({width: "135px",height: "135px", margin: 0})
      $("#preview3").attr('src', this.result)
    }
  }
)
$("#companyauth-company_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview1").css({width: "135px",height: "135px", margin: 0})
      $("#preview1").attr('src', this.result)
    }
  }
)
$("#companyauth-id_hand_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview2").css({width: "135px",height: "135px", margin: 0})
      $("#preview2").attr('src', this.result)
    }
  }
)
$("#companyauth-factory_pic").change(
  function(){
    reader.readAsDataURL( this.files[0] )
    window.temp = this.files
    if (!isImg( this.files[0].name.toLowerCase() )) {
      return alert('请上传图片文件')
    }
    reader.onload=function(e){
      $("#preview3").css({width: "135px",height: "135px", margin: 0})
      $("#preview3").attr('src', this.result)
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
