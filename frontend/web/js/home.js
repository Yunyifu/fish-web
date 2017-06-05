//首页焦点图及右滚动
(function($){
    $.fn.ckSlide = function(opts){
		//.extend() 扩展jQuery类，添加ckSlide方法，参数是对象类型{}
        opts = $.extend({}, $.fn.ckSlide.opts, opts);
        this.each(function(){
            var slidewrap = $(this).find('.ck-slide-wrapper');//轮播元素父对象
            var slide = slidewrap.find('li');//获取<li>对象集
            var count = slide.length;//计算对象集长度
            var that = this;//存放父对象
            var index = 0;//起始位置
            var time = null;
            $(this).data('opts', opts);//给轮播对象添加参数 数据
            // next
            $(this).find('.ck-next').on('click', function(){
                if(opts['isAnimate'] == true){
                    return;
                }

                var old = index;
                if(index >= count - 1){
                    index = 0;
                }else{
                    index++;
                }
                change.call(that, index, old);//调用图片切换方法，.call() 每个JS函数都包含的一个非继承而来的方法，主要用来指定函数的作用域 that ，通常不严谨写法是change()，有可能会函数冲突。
            });
            // prev
            $(this).find('.ck-prev').on('click', function(){
                if(opts['isAnimate'] == true){
                    return;
                }
                
                var old = index;
                if(index <= 0){
                    index = count - 1;
                }else{                                      
                    index--;
                }
                change.call(that, index, old);
            });
			//点击切换相应序号的图片
            $(this).find('.ck-slidebox li').each(function(cindex){
                $(this).on('click.slidebox', function(){
                    change.call(that, cindex, index);
                    index = cindex;
                });
            });
			//自己添加——鼠标移入小圆点切换轮播图片
			$(this).find('.ck-slidebox li').each(function(cindex){
                $(this).on('mouseover.slidebox', function(){
                    change.call(that, cindex, index);
                    index = cindex;
                });
            });
            
            // 鼠标悬停停止自动播放，显示左右切换按钮
            $(this).on('mouseover', function(){
                if(opts.autoPlay){
                    clearInterval(time);
                }
                $(this).find('.ctrl-slide').css({opacity:0.6});
            });
            //  鼠标离开轮播界面，开始自动播放，同时隐藏按钮
            $(this).on('mouseleave', function(){
                if(opts.autoPlay){
                    startAtuoPlay(opts.interval);
                }
                $(this).find('.ctrl-slide').css({opacity:0});
            });
            startAtuoPlay(opts.interval);
            // 自动滚动播放
            function startAtuoPlay(inum){
                if(opts.autoPlay){
                    time  = setInterval(function(){
                        var old = index;
                        if(index >= count - 1){
                            index = 0;
                        }else{
                            index++;
                        }
                        change.call(that, index, old);
                    }, inum);//2秒
                }
            }
            // 修正box  标记居中
            var box = $(this).find('.ck-slidebox');
            box.css({
                'margin-left':-(box.width() / 2)
            })
            // dir  移动方向参数
            switch(opts.dir){
                case "x":
                    opts['width'] = $(this).width();
                    slidewrap.css({
                        'width':count * opts['width']
                    });
                    slide.css({
                        'float':'left',
                        'position':'relative',
						'margin-left':'0px'
                    });
					//.wrap()包裹页面已经定义的.ck-slide-wrapper以及子元素
                    slidewrap.wrap('<div class="ck-slide-dir"></div>');
                    slide.show();
                    break;
				case "y":  //添加垂直移动参数
                    opts['height'] = $(this).height();
                    slidewrap.css({
                        'height':count * opts['height']
                    });
                    slide.css({
                        'float':'left',
                        'position':'relative',
						'margin-top':'0px'
                    });
                    slidewrap.wrap('<div class="ck-slide-dir"></div>');
                    slide.show();
                break;
            }
        });
    };
    function change(show, hide){
		//获取之前设置在ckSlide对象上的参数 数据
        var opts = $(this).data('opts');
		//水平移动
        if(opts.dir == 'x'){
            var x = show * opts['width'];
			//animate() 与css()执行结果相同，但是过程不同，前者有渐变动画效果
            $(this).find('.ck-slide-wrapper').stop().animate({'margin-left':-x}, function(){opts['isAnimate'] = false;});
            opts['isAnimate'] = true;//图片在移动过程中设置按钮点击不可用，确保每一次轮播视觉上执行完成，
        }else if(opts.dir == 'y'){//垂直移动——自己添加
            var y = show * opts['height'];
            $(this).find('.ck-slide-wrapper').stop().animate({'margin-top':-y}, function(){opts['isAnimate'] = false;});
            opts['isAnimate'] = true;
        }
		else{
			//默认的淡隐淡出效果
            $(this).find('.ck-slide-wrapper li').eq(hide).stop().animate({opacity:0});
            $(this).find('.ck-slide-wrapper li').eq(show).show().css({opacity:0}).stop().animate({opacity:1});
        }
       //切换对应标记的颜色
        $(this).find('.ck-slidebox li').removeClass('current');
        $(this).find('.ck-slidebox li').eq(show).addClass('current');
    }
    $.fn.ckSlide.opts = {
		autoPlay: false,//默认不自动播放
        dir: null,//默认淡隐淡出效果
        isAnimate: false,//默认按钮可用
		interval:2000//默认自动2秒切换 
		 };
})(jQuery); 
 
 
 
 
 
//超级工给滚动
	  jQuery_1_8_2(function($) {
                $('div.pro_box').hover(function() {
                    $(this).toggleClass('pro_box_hover')
                });
//c的值为每次滚动数
                var slideContainer = $('#slideContainer'), c = 1, s_w = 239 * c, counts_l = 0, counts_r = 0, maxCounts = slideContainer.find(' ').size() - 0, gameOver = true, slideCounts = 7, sTimer;
                $('#link_prev').on('click', function() {
                    clearInterval(sTimer);
                    if (gameOver) {
                        gameOver = false;
                        counts_l++;
                        slideContainer.animate({
                            left: '+=' + s_w
                        }, 500, function() {
                            gameOver = true;
                            slideContainer.animate({
                                left: '-=' + s_w
                            }, 0);
                            var html = '';
                            slideContainer.find('li:gt(' + (maxCounts - c - 1) + ')').each(function() {
                                html += '<li>' + $(this).html() + '</li>';
                            });
                            slideContainer.find('li:gt(' + (maxCounts - c - 1) + ')').remove();
                            slideContainer.html(html + slideContainer.html());
                        });
                    }
                });
                $('#link_next').on('click', function() {
                    clearInterval(sTimer);
                    link_next_event();
                });

                function link_next_event() {
                    if (gameOver) {
                        gameOver = false;
                        counts_r++;
                        slideContainer.animate({
                            left: '-=' + s_w
                        }, 500, function() {
                            gameOver = true;
                            slideContainer.animate({
                                left: '+=' + s_w
                            }, 0);
                            slideContainer.find('li:lt(' + c + ')').clone().appendTo(slideContainer);
                            slideContainer.find('li:lt(' + c + ')').remove();
                        });
                    }
                }

                lastCLiHtml();
                slideContainer.find('li:gt(' + (maxCounts - 1) + ')').remove();
                function lastCLiHtml() {
                    var html = '';
                    slideContainer.find('li:gt(' + (maxCounts - c - 1) + ')').each(function() {
                        html += '<li>' + $(this).html() + '</li>';
                    });
                    slideContainer.html(html + slideContainer.html()).css({
                        'margin-left': -s_w + 'px'
                    });
                }

                var l_hover = false, m_hover = false, r_hover = false;
                $('#co-show').on({
                    'mouseover': function() {
                        m_hover = true;
                        clearInterval(sTimer);
                    },
                    'mouseout': function() {
                        m_hover = false;
                        isStartGo();
                    }
                });

                $('#link_next, #link_prev').on('mouseout', function() {
                    l_hover = false;
                    r_hover = false;
                    isStartGo();
                })
                $('#link_next, #link_prev').on('mouseover', function() {
                    l_hover = true;
                    r_hover = true;
                    clearInterval(sTimer);
                })
                setInverterTimer();
                function setInverterTimer() {
                    clearInterval(sTimer);
                    sTimer = setInterval(function() {
                        link_next_event();
                    }, 2000);
                }

                function isStartGo() {
                    var st = setTimeout(function() {
                        if (!l_hover && !m_hover && !r_hover) {
                            setInverterTimer();
                        }
                    }, 1000);
                }

            });
		
		
		
		
		
//焦点图
		$('.ck-slide').ckSlide({
				autoPlay: true,//默认为不自动播放，需要时请以此设置
				dir: 'x',//默认效果淡隐淡出，x为水平移动，y 为垂直滚动
				interval:3000//默认间隔2000毫秒
				
			});
			
		 $('.main-data').ckSlide({
				autoPlay: true,//默认为不自动播放，需要时请以此设置
				dir: 'y',//默认效果淡隐淡出，x为水平移动，y 为垂直滚动
				interval:5000//默认间隔2000毫秒
				
			});
			
			$('.trade-con').ckSlide({
				autoPlay: true,//默认为不自动播放，需要时请以此设置
				dir: 'y',//默认效果淡隐淡出，x为水平移动，y 为垂直滚动
				interval:5000//默认间隔2000毫秒
				
			});
			
			//底部关闭效果
			  var photo_bottom = document.getElementById("photo_bottom");
            photo_bottom.style.display = "block";
            function func() {
                if(photo_bottom.style.display == "block")
                    photo_bottom.style.display = "none";
                else
                    photo_bottom.style.display = "block";
            }