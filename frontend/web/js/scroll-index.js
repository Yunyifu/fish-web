window.onload = function(){
	scrollPic();
}
function scrollPic() {
	var scrollPic = new ScrollPic();
	scrollPic.scrollContId   = "scrollbox-index"; //内容容器ID
	scrollPic.arrLeftId      = "scrollbox-index-left";//左箭头ID
	scrollPic.arrRightId     = "scrollbox-index-right"; //右箭头ID

	scrollPic.frameWidth     = 924;//显示框宽度
	scrollPic.pageWidth      = 239; //翻页宽度

	scrollPic.speed          = 10; //移动速度(单位毫秒，越小越快)
	scrollPic.space          = 10; //每次移动像素(单位px，越大越快)
	scrollPic.autoPlay       = true; //自动播放
	scrollPic.autoPlayTime   = 3; //自动播放间隔时间(秒)

	scrollPic.initialize(); //初始化
}