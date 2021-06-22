function scrollAni(){
	$('.js-m').each(function() {
		var _this = $(this);
		// if(_this.offset().top<$(window).scrollTop()-_this.outerHeight()* 0.9){
		// 	_this.removeClass('animate');
		// }else if ($(window).scrollTop() > _this.offset().top - $(window).height() * 0.9) {
		// 	_this.addClass('animate');
		// }
		if ($(window).scrollTop() > _this.offset().top - $(window).height() * 0.85) {
			_this.addClass('animate');
		}
	});

	$(window).scroll(function(){
	 	$('.js-m').each(function() {
			var _this = $(this);
			// if(_this.offset().top<$(window).scrollTop()-_this.outerHeight()* 0.85){
			// 	_this.removeClass('animate');
			// }else if ($(window).scrollTop() > _this.offset().top - $(window).height() * 0.85) {
			// 	_this.addClass('animate');
			// }
			if ($(window).scrollTop() > _this.offset().top - $(window).height() * 0.85) {
				_this.addClass('animate');
			}
		});
	})
}


// $(window).scroll(function () {
// 	var w_height=$(window).height();
//     var windowTop = $(window).scrollTop();
//     if (windowTop < w_height) {
//         $('.banner .img_box').css('transform', "translate(0px," + (windowTop) / 1.5 + "px)");
//     };
	
// });
$('.go_top').click(function(){
    $('html,body').animate({
        'scrollTop':0
    })
})

$(".push-line").click(function(){
    if($(this).hasClass("currentDd")){
        $(this).removeClass("currentDd");
        $('.menu_box').slideUp();
        $('html,body').removeClass('ovh').height('auto');
        
    }else{
        $(this).addClass("currentDd");
        $('.menu_box').slideDown();
        $('html,body').addClass('ovh').height(h);
    }
})

$('.navMobile li>a').click(function(){
    if(!$(this).hasClass('show')){
        $('.navMobile li>a').removeClass('show');
        $(this).addClass('show');
        $('.navMobile li>a').siblings('.subnav').slideUp();
        $(this).siblings('.subnav').slideDown();
    }else{
        $(this).removeClass('show');
        $(this).siblings('.subnav').slideUp();
    }
})

$('.subItem>a').click(function(){
    if(!$(this).hasClass('show')){
        $('.subItem>a').removeClass('show');
        $(this).addClass('show');
        $('.subItem>a').siblings('.subnav').slideUp();
        $(this).siblings('.subnav').slideDown();
    }else{
        $(this).removeClass('show');
        $(this).siblings('.subnav').slideUp();
    }
})



$('.footer-menu h3').click(function(){
    if($(this).css('background-image') !== 'none'){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).siblings('ul').slideUp();
        }else{
            $(this).addClass('active').parent('li').siblings().find('h3').removeClass('active');
            $(this).parent('li').siblings().find('ul').slideUp();
            $(this).siblings('ul').slideDown();
        }
    }
})

function setImgMax(img, imgW, imgH, tW, tH) {
    var w_width=$(window).width();
    var w_height=$(window).height();
    var tWidth = tW || w_width;
    var tHeight = tH || w_height;
    var coe = imgH / imgW;
    var coe2 = tHeight / tWidth;
    if (coe < coe2) {
        var imgWidth = tHeight / coe;
        img.css({ height: tHeight, width: imgWidth, left: -(imgWidth - tWidth) / 2, top: 0 });
    } else {
        var imgHeight = tWidth * coe;
        img.css({ height: imgHeight, width: tWidth, left: 0, top: -(imgHeight - tHeight) / 2 });
    };
};

function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
 
var pc = IsPC();

function scr(parent,obj){
	if ($(window).scrollTop() > parent.offset().top - $(window).height() * 0.9) {
		for(var i=0;i<obj.length;i++){
			(function(i){
				setTimeout(function(){
					obj.eq(i).addClass('animate');
				},200*i);
			})(i);
		}
	}

	$(window).scroll(function(){
		if ($(window).scrollTop() > parent.offset().top - $(window).height() * 0.9) {
			for(var i=0;i<obj.length;i++){
				(function(i){
					setTimeout(function(){
						obj.eq(i).addClass('animate');
					},200*i);
				})(i);
			}
		}
	})
}

function number(n){
    if(n<10){
        return '0'+n;
    }else{
        return n;
    }
}



var isLoad = true,t_img; 
function isImgLoad(callback){
    // 注意我的图片类名都是cover，因为我只需要处理cover。其它图片可以不管。
    // 查找所有封面图，迭代处理
    $('.abanner .img').each(function(){
        // 找到为0就将isLoad设为false，并退出each
        if(this.height === 0){
            isLoad = false;
            return false;
        }
    });
    // 为true，没有发现为0的。加载完毕
    if(isLoad){
        clearTimeout(t_img); // 清除定时器
        // 回调函数
        callback();
    // 为false，因为找到了没有加载完成的图，将调用定时器递归
    }else{
        isLoad = true;
        t_img = setTimeout(function(){
            isImgLoad(callback); // 递归扫描
        },600); // 我这里设置的是500毫秒就扫描一次，可以自己调整
    }
}




// $(window).scroll(function () {
// 	var w_height=$(window).height();
//     var windowTop = $(window).scrollTop();
//     if (windowTop < w_height) {
//         $('.abanner .img').css('transform', "translate(0px," + (windowTop) / 3.5 + "px)");
//     };
	
// });





// $('.flister_box ul li').click(function(){
// 	var activeIndex=$('.dots a.active').index();
// 	var index=$(this).index();
// 	$(this).addClass('active').siblings().removeClass('active');
// 	if(index>activeIndex){
// 		for(var i=0;i<index-activeIndex;i++){
// 			arr.unshift(arr.pop());
// 		}
// 	}else if(index<activeIndex){
// 		for(var i=0;i<activeIndex-index;i++){
// 			arr.push(arr.shift());
// 		}
// 	}
// 	startMove();
// })




function textScroll(scrollbox, up, dowm){
    var aboutTime ;
    up.hover(function(){
        var top = parseInt(scrollbox.css("top")),
            h   = scrollbox.parent().height() - scrollbox.height()

        aboutTime = setInterval(function(){
            top = parseInt(scrollbox.css("top"));
            top -- ;
            if(top > h){
                scrollbox.stop().animate({top : top}, 1)
            }
        }, 1)
    }, function(){
        if(aboutTime){
            clearInterval(aboutTime);
        }
    })
    dowm.hover(function(){
        var top = parseInt(scrollbox.css("top")),
            h   = scrollbox.parent().height() - scrollbox.height()

        aboutTime = setInterval(function(){
            top = parseInt(scrollbox.css("top"));
            top ++ ;
            if(top <= 0){
                scrollbox.stop().animate({top : top}, 1)
            }
        }, 1)
    }, function(){
        if(aboutTime){
            clearInterval(aboutTime);
        }
    })
}



if($('.about_nav').length>0 && $(window).width()>850){
    var th=$('.about_nav').offset().top;
    var h=$('.about_nav').height();

    if($('#id1').length>0){
        $('.about_nav .list ul li').click(function(){
            $(this).addClass('active').siblings().removeClass('active');
        })
    }
    $(window).scroll(function(){
        if($(window).scrollTop()>th){
            $('.about_nav').addClass('fix');
            $('.about_mnav').next().css('margin-top',h);
        }else{
            $('.about_nav').removeClass('fix');
            $('.about_mnav').next().css('margin-top',0);
        }


        // if($('#id1').length>0){
        //     item.each(function (index) {
        //         href=$(this).find('a').attr('href');

        //         href=href.substring(href.indexOf('#'),href.length);
        //         if($(href).length>0){
        //             offsetTop = $(href).offset().top - h-2;
        //             if ($(window).scrollTop() > offsetTop) {
        //                 $(this).addClass("active");
        //                 $(this).siblings().removeClass("active");
        //             }
        //         }
        //     })
        // }
   })
}






!function ($) {
    function e(e, t, a, r) {
        var s = e.text(),
            i = s.split(t),
            n = "";
        i.length && ($(i).each(function (e, t) {
            n += '<span class="' + a + (e + 1) + '" aria-hidden="true">' + t + "</span>" + r
        }), e.attr("aria-label", s).empty().append(n))
    }
    var t = {
        init: function () {
            return this.each(function () {
                e($(this), "", "char", "")
            })
        },
        words: function () {
            return this.each(function () {
                e($(this), " ", "word", " ")
            })
        },
        lines: function () {
            return this.each(function () {
                var t = "eefec303079ad17405c889e092e105b0";
                e($(this).children("br").replaceWith(t).end(), t, "line", "")
            })
        }
    };
    $.fn.lettering = function (e) {
        return e && t[e] ? t[e].apply(this, [].slice.call(arguments, 1)) : "letters" !== e && e ? ($.error("Method " +
            e + " does not exist on jQuery.lettering"), this) : t.init.apply(this, [].slice.call(arguments, 0))
    }
}(jQuery);

$('.init').lettering();

if($('body').hasClass('header_no_fix')){
    position(); 
}
function position(){
	isImgLoad(function(){
		var nav_b=$('.position');
        var n=$('.position').height();
		var top = nav_b.offset().top;
        console.log(top)
		$(window).scroll(function(){
			if($(window).scrollTop()>top){
				nav_b.addClass('fix');
				nav_b.next().css('padding-top',n);
			}else{
				nav_b.removeClass('fix');
				nav_b.next().css('padding-top',0);
			}
		})

		// var nav2 = $(".animate_nav ul>li"),offsetTop;
	 //    nav2.each(function () {
	 //        var _this = $(this);
	 //        _this.on('click',function(e){
	 //        	e.preventDefault();
	 //            var anchor = _this.find(">a").attr("href").split("#")[1];
	 //            var index=$(this).index();
	 //            if(_this.parents('.anmate_box').hasClass('fix')){
	 //            	$("html,body").animate({
		//                 scrollTop: $("#" + anchor).offset().top - n
		//             });
	 //            }else{
	 //            	$("html,body").animate({
		//                 scrollTop: $("#" + anchor).offset().top-$('.anmate_box ul').height()
		//             });
	 //            }
	            
				
	 //        })
	 //    });

	 //    $(window).scroll(function () {
	 //        nav2.each(function (index) {
	 //            offsetTop = $(".container ul .li").eq(index).offset().top - n-2;
	 //            if ($(window).scrollTop() > offsetTop) {
	 //                $(this).addClass("cur").siblings().removeClass("cur");
	 //                scroll.scrollToElement($('.anmate_box ul li.cur')[0]);
	 //            }
	 //        });
	 //    });
	})
}







//璁剧疆cookie
function setCookie(name, value, seconds) {
	seconds = seconds || 0;   //seconds鏈夊€煎氨鐩存帴璧嬪€硷紝娌℃湁涓�0锛岃繖涓牴php涓嶄竴鏍枫€�
	var expires = "";
	if (seconds != 0 ) {      //璁剧疆cookie鐢熷瓨鏃堕棿
		var date = new Date();
		date.setTime(date.getTime()+(seconds*1000));
		expires = "; expires="+date.toGMTString();
	}
	document.cookie = name+"="+escape(value)+expires+"; path=/";   //杞爜骞惰祴鍊�
}
//鍙栧緱cookie
function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');    //鎶奵ookie鍒嗗壊鎴愮粍
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];                      //鍙栧緱瀛楃涓�
		while (c.charAt(0)==' ') {          //鍒ゆ柇涓€涓嬪瓧绗︿覆鏈夋病鏈夊墠瀵肩┖鏍�
			c = c.substring(1,c.length);      //鏈夌殑璇濓紝浠庣浜屼綅寮€濮嬪彇
		}
		if (c.indexOf(nameEQ) == 0) {       //濡傛灉鍚湁鎴戜滑瑕佺殑name
			return unescape(c.substring(nameEQ.length,c.length));    //瑙ｇ爜骞舵埅鍙栨垜浠鍊�
		}
	}
	return false;
}
//娓呴櫎cookie
function clearCookie(name) {
	setCookie(name, "", -1);
}





// function textScroll(scrollbox, up, down){
//     var index=0;
//     var hei=scrollbox.parent().height();
//     var totalHei=scrollbox.height();
//     var len=Math.floor(totalHei/hei);
//     var max=totalHei-hei;
//     down.click(function(){
//         index++;
//         if(index>len){
//             index=len;
//         }
        
//         if(index*hei>max){
//             console.log(1)
//             move(scrollbox,0,-max)
//         }else{
//             move(scrollbox,0,-index*hei)
//         }
        
//     })  
//     up.click(function(){
//         index--;
//         if(index<0){
//             index=0;
//         }
//         move(scrollbox,0,-index*hei)
//     })  
// }


// function mousemove(obj,son){
//     obj.mousemove(function(e){
//         var e=e || window.event;
//         var winW=$(window).width();
//         var left=(e.pageX-winW/2)*0.01;
//         son.css('transform','translate3d('+-left+'px,0px,0px)');
//     })
// }

        


(function(jQuery){
    $.fn.scrollClass = function(config){
        var defaults = {};
        var config = jQuery.extend(defaults, config);
        var target = this;

        function addAction(){
            var length = target.length;
            for(var i=0; i<length; i++){
                if(target.eq(i).hasClass('animate')) continue;
                
                var in_position = target.eq(i).offset().top + 0;
                var window_bottom_position = jQuery(window).scrollTop() + jQuery(window).height();
                if(in_position < window_bottom_position){
                    target.eq(i).addClass('animate');
                }
            }
        }
        addAction();

        jQuery(window).on('scroll', function(){
            addAction();	
        });
        return target;
    };
} )(jQuery);


// jQuery(window).load(function(){
//     jQuery('.js-m').delay(300).scrollClass();
// });

// $('.js-m').scrollClass();

$('.nav>li').each(function(){
	var link=$(this).find('a').attr('href');
	if(link.indexOf('.html') > -1){
		link=link.substring(0,link.indexOf('.html'));
	}
	var location_href=window.location.href;
	if(location_href.indexOf('.html') > -1){
		location_href=location_href.substring(0,location_href.indexOf('.html'));
	}


	if(location_href.indexOf(link)>-1){
		$(this).addClass('active');

	}
})

function init(n){
    var mySwiper = new Swiper('.position .swiper-container',{
        slidesPerView :'auto',
        initialSlide :n
    })
    $('.position .swiper-slide').eq(n).addClass('active');
}

/* AlloyFinger v0.1.15
 * By dntzhang
 * Github: https://github.com/AlloyTeam/AlloyFinger
 */
; (function () {
    function getLen(v) {
        return Math.sqrt(v.x * v.x + v.y * v.y);
    }

    function dot(v1, v2) {
        return v1.x * v2.x + v1.y * v2.y;
    }

    function getAngle(v1, v2) {
        var mr = getLen(v1) * getLen(v2);
        if (mr === 0) return 0;
        var r = dot(v1, v2) / mr;
        if (r > 1) r = 1;
        return Math.acos(r);
    }

    function cross(v1, v2) {
        return v1.x * v2.y - v2.x * v1.y;
    }

    function getRotateAngle(v1, v2) {
        var angle = getAngle(v1, v2);
        if (cross(v1, v2) > 0) {
            angle *= -1;
        }

        return angle * 180 / Math.PI;
    }

    var HandlerAdmin = function(el) {
        this.handlers = [];
        this.el = el;
    };

    HandlerAdmin.prototype.add = function(handler) {
        this.handlers.push(handler);
    }

    HandlerAdmin.prototype.del = function(handler) {
        if(!handler) this.handlers = [];

        for(var i=this.handlers.length; i>=0; i--) {
            if(this.handlers[i] === handler) {
                this.handlers.splice(i, 1);
            }
        }
    }

    HandlerAdmin.prototype.dispatch = function() {
        for(var i=0,len=this.handlers.length; i<len; i++) {
            var handler = this.handlers[i];
            if(typeof handler === 'function') handler.apply(this.el, arguments);
        }
    }

    function wrapFunc(el, handler) {
        var handlerAdmin = new HandlerAdmin(el);
        handlerAdmin.add(handler);

        return handlerAdmin;
    }

    var AlloyFinger = function (el, option) {

        this.element = typeof el == 'string' ? document.querySelector(el) : el;

        this.start = this.start.bind(this);
        this.move = this.move.bind(this);
        this.end = this.end.bind(this);
        this.cancel = this.cancel.bind(this);
        this.element.addEventListener("touchstart", this.start, false);
        this.element.addEventListener("touchmove", this.move, false);
        this.element.addEventListener("touchend", this.end, false);
        this.element.addEventListener("touchcancel", this.cancel, false);

        this.preV = { x: null, y: null };
        this.pinchStartLen = null;
        this.zoom = 1;
        this.isDoubleTap = false;

        var noop = function () { };

        this.rotate = wrapFunc(this.element, option.rotate || noop);
        this.touchStart = wrapFunc(this.element, option.touchStart || noop);
        this.multipointStart = wrapFunc(this.element, option.multipointStart || noop);
        this.multipointEnd = wrapFunc(this.element, option.multipointEnd || noop);
        this.pinch = wrapFunc(this.element, option.pinch || noop);
        this.swipe = wrapFunc(this.element, option.swipe || noop);
        this.tap = wrapFunc(this.element, option.tap || noop);
        this.doubleTap = wrapFunc(this.element, option.doubleTap || noop);
        this.longTap = wrapFunc(this.element, option.longTap || noop);
        this.singleTap = wrapFunc(this.element, option.singleTap || noop);
        this.pressMove = wrapFunc(this.element, option.pressMove || noop);
        this.twoFingerPressMove = wrapFunc(this.element, option.twoFingerPressMove || noop);
        this.touchMove = wrapFunc(this.element, option.touchMove || noop);
        this.touchEnd = wrapFunc(this.element, option.touchEnd || noop);
        this.touchCancel = wrapFunc(this.element, option.touchCancel || noop);

        this._cancelAllHandler = this.cancelAll.bind(this);

        window.addEventListener('scroll', this._cancelAllHandler);

        this.delta = null;
        this.last = null;
        this.now = null;
        this.tapTimeout = null;
        this.singleTapTimeout = null;
        this.longTapTimeout = null;
        this.swipeTimeout = null;
        this.x1 = this.x2 = this.y1 = this.y2 = null;
        this.preTapPosition = { x: null, y: null };
    };

    AlloyFinger.prototype = {
        start: function (evt) {
            if (!evt.touches) return;
            this.now = Date.now();
            this.x1 = evt.touches[0].pageX;
            this.y1 = evt.touches[0].pageY;
            this.delta = this.now - (this.last || this.now);
            this.touchStart.dispatch(evt, this.element);
            if (this.preTapPosition.x !== null) {
                this.isDoubleTap = (this.delta > 0 && this.delta <= 250 && Math.abs(this.preTapPosition.x - this.x1) < 30 && Math.abs(this.preTapPosition.y - this.y1) < 30);
                if (this.isDoubleTap) clearTimeout(this.singleTapTimeout);
            }
            this.preTapPosition.x = this.x1;
            this.preTapPosition.y = this.y1;
            this.last = this.now;
            var preV = this.preV,
                len = evt.touches.length;
            if (len > 1) {
                this._cancelLongTap();
                this._cancelSingleTap();
                var v = { x: evt.touches[1].pageX - this.x1, y: evt.touches[1].pageY - this.y1 };
                preV.x = v.x;
                preV.y = v.y;
                this.pinchStartLen = getLen(preV);
                this.multipointStart.dispatch(evt, this.element);
            }
            this._preventTap = false;
            this.longTapTimeout = setTimeout(function () {
                this.longTap.dispatch(evt, this.element);
                this._preventTap = true;
            }.bind(this), 750);
        },
        move: function (evt) {
            if (!evt.touches) return;
            var preV = this.preV,
                len = evt.touches.length,
                currentX = evt.touches[0].pageX,
                currentY = evt.touches[0].pageY;
            this.isDoubleTap = false;
            if (len > 1) {
                var sCurrentX = evt.touches[1].pageX,
                    sCurrentY = evt.touches[1].pageY
                var v = { x: evt.touches[1].pageX - currentX, y: evt.touches[1].pageY - currentY };

                if (preV.x !== null) {
                    if (this.pinchStartLen > 0) {
                        evt.zoom = getLen(v) / this.pinchStartLen;
                        this.pinch.dispatch(evt, this.element);
                    }

                    evt.angle = getRotateAngle(v, preV);
                    this.rotate.dispatch(evt, this.element);
                }
                preV.x = v.x;
                preV.y = v.y;

                if (this.x2 !== null && this.sx2 !== null) {
                    evt.deltaX = (currentX - this.x2 + sCurrentX - this.sx2) / 2;
                    evt.deltaY = (currentY - this.y2 + sCurrentY - this.sy2) / 2;
                } else {
                    evt.deltaX = 0;
                    evt.deltaY = 0;
                }
                this.twoFingerPressMove.dispatch(evt, this.element);

                this.sx2 = sCurrentX;
                this.sy2 = sCurrentY;
            } else {
                if (this.x2 !== null) {
                    evt.deltaX = currentX - this.x2;
                    evt.deltaY = currentY - this.y2;

                    //move事件中添加对当前触摸点到初始触摸点的判断，
                    //如果曾经大于过某个距离(比如10),就认为是移动到某个地方又移回来，应该不再触发tap事件才对。
                    var movedX = Math.abs(this.x1 - this.x2),
                        movedY = Math.abs(this.y1 - this.y2);

                    if(movedX > 10 || movedY > 10){
                        this._preventTap = true;
                    }

                } else {
                    evt.deltaX = 0;
                    evt.deltaY = 0;
                }
                
                
                this.pressMove.dispatch(evt, this.element);
            }

            this.touchMove.dispatch(evt, this.element);

            this._cancelLongTap();
            this.x2 = currentX;
            this.y2 = currentY;
            
            if (len > 1) {
                evt.preventDefault();
            }
        },
        end: function (evt) {
            if (!evt.changedTouches) return;
            this._cancelLongTap();
            var self = this;
            if (evt.touches.length < 2) {
                this.multipointEnd.dispatch(evt, this.element);
                this.sx2 = this.sy2 = null;
            }

            //swipe
            if ((this.x2 && Math.abs(this.x1 - this.x2) > 30) ||
                (this.y2 && Math.abs(this.y1 - this.y2) > 30)) {
                evt.direction = this._swipeDirection(this.x1, this.x2, this.y1, this.y2);
                this.swipeTimeout = setTimeout(function () {
                    self.swipe.dispatch(evt, self.element);

                }, 0)
            } else {
                this.tapTimeout = setTimeout(function () {
                    if(!self._preventTap){
                        self.tap.dispatch(evt, self.element);
                    }
                    // trigger double tap immediately
                    if (self.isDoubleTap) {
                        self.doubleTap.dispatch(evt, self.element);
                        self.isDoubleTap = false;
                    }
                }, 0)

                if (!self.isDoubleTap) {
                    self.singleTapTimeout = setTimeout(function () {
                        self.singleTap.dispatch(evt, self.element);
                    }, 250);
                }
            }

            this.touchEnd.dispatch(evt, this.element);

            this.preV.x = 0;
            this.preV.y = 0;
            this.zoom = 1;
            this.pinchStartLen = null;
            this.x1 = this.x2 = this.y1 = this.y2 = null;
        },
        cancelAll: function () {
            this._preventTap = true
            clearTimeout(this.singleTapTimeout);
            clearTimeout(this.tapTimeout);
            clearTimeout(this.longTapTimeout);
            clearTimeout(this.swipeTimeout);
        },
        cancel: function (evt) {
            this.cancelAll()
            this.touchCancel.dispatch(evt, this.element);
        },
        _cancelLongTap: function () {
            clearTimeout(this.longTapTimeout);
        },
        _cancelSingleTap: function () {
            clearTimeout(this.singleTapTimeout);
        },
        _swipeDirection: function (x1, x2, y1, y2) {
            return Math.abs(x1 - x2) >= Math.abs(y1 - y2) ? (x1 - x2 > 0 ? 'Left' : 'Right') : (y1 - y2 > 0 ? 'Up' : 'Down')
        },

        on: function(evt, handler) {
            if(this[evt]) {
                this[evt].add(handler);
            }
        },

        off: function(evt, handler) {
            if(this[evt]) {
                this[evt].del(handler);
            }
        },

        destroy: function() {
            if(this.singleTapTimeout) clearTimeout(this.singleTapTimeout);
            if(this.tapTimeout) clearTimeout(this.tapTimeout);
            if(this.longTapTimeout) clearTimeout(this.longTapTimeout);
            if(this.swipeTimeout) clearTimeout(this.swipeTimeout);

            this.element.removeEventListener("touchstart", this.start);
            this.element.removeEventListener("touchmove", this.move);
            this.element.removeEventListener("touchend", this.end);
            this.element.removeEventListener("touchcancel", this.cancel);

            this.rotate.del();
            this.touchStart.del();
            this.multipointStart.del();
            this.multipointEnd.del();
            this.pinch.del();
            this.swipe.del();
            this.tap.del();
            this.doubleTap.del();
            this.longTap.del();
            this.singleTap.del();
            this.pressMove.del();
            this.twoFingerPressMove.del()
            this.touchMove.del();
            this.touchEnd.del();
            this.touchCancel.del();

            this.preV = this.pinchStartLen = this.zoom = this.isDoubleTap = this.delta = this.last = this.now = this.tapTimeout = this.singleTapTimeout = this.longTapTimeout = this.swipeTimeout = this.x1 = this.x2 = this.y1 = this.y2 = this.preTapPosition = this.rotate = this.touchStart = this.multipointStart = this.multipointEnd = this.pinch = this.swipe = this.tap = this.doubleTap = this.longTap = this.singleTap = this.pressMove = this.touchMove = this.touchEnd = this.touchCancel = this.twoFingerPressMove = null;

            window.removeEventListener('scroll', this._cancelAllHandler);
            return null;
        }
    };

    if (typeof module !== 'undefined' && typeof exports === 'object') {
        module.exports = AlloyFinger;
    } else {
        window.AlloyFinger = AlloyFinger;
    }
})();


if($('.flister_box').length>0){
    new AlloyFinger($('.flister_box')[0],{
        touchMove:function(evt) {
            if (Math.abs(evt.deltaX) >= Math.abs(evt.deltaY)) {
                evt.preventDefault();
            }
        },
        swipe: function (evt) {
            switch (evt.direction){
                case 'Left':
                    $('.flister_box .next').trigger('click');
                    break;
                case 'Right':
                    $('.flister_box .prev').trigger('click');
                    break;
            } 
        }
    })

    var hei2=0;
    $('.flister_box ul li').each(function(){
        var pic= $(this).find('.pic');
        pic.height(Math.floor(pic.width()*(450/600)));

        var h=$(this).height();
        if(h>hei2){
            hei2=h;
        }
    })
    $('.flister_box').height(hei2)

    $(window).resize(function(){
        $('.flister_box').height('auto')
        hei2=0;
        $('.flister_box ul li').each(function(){
            var pic= $(this).find('.pic');
            pic.height(Math.floor(pic.width()*(450/600)));

            var h=$(this).height();
            if(h>hei2){
                hei2=h;
            }
        })
        $('.flister_box').height(hei2)
    })
    var arr=[];

    $('.flipster_txt').text( $('.flister_box ul li').eq(1).attr('data-text'));
    $('.flister_box ul li').each(function(i){
        arr.push(
            [
                $('.flister_box ul li').eq(i).width(),
                $('.flister_box ul li').eq(i).css('left'),
                $('.flister_box ul li').eq(i).css('z-index'),
                $('.flister_box ul li').eq(i).css('top'),
                $('.flister_box ul li').eq(i).find('img').css('opacity'),
                $('.flister_box ul li').eq(i).find('.pic').css('height')
            ]
        )
    })



    $('.flister_box .next').click(function(){
        arr.unshift(arr.pop());
        startMove();
    })

    $('.flister_box .prev').click(function(){
        arr.push(arr.shift());
        startMove();
    })
}


var browser={
    versions:function(){
        var u = navigator.userAgent, app = navigator.appVersion;
        return { //移动终端浏览器版本信息
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
            iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部 
        };
    }(),
    language:(navigator.browserLanguage || navigator.language).toLowerCase()
}

if (browser.versions.trident) { 
    
}else{
    wow = new WOW({
       animateClass: 'animated',
       mobile:true,
       live: true
    });
    wow.init();
}





function startMove(){
    var w=$('.flister_box').width();
    $('.flister_box ul li').each(function(i){
        $(this).css({'z-index':arr[i][2]});
        $(this).stop(true,true).animate({
            'top':arr[i][3],
            'width':arr[i][0],
            'left':arr[i][1]
        },500,function(){
            if(parseInt($(this).css('left')) > w*0.25-3 && parseInt($(this).css('left')) < w*0.25+3){
                var index=$(this).index();
                $('.flipster_txt').text( $('.flister_box ul li').eq(index).attr('data-text'));
            }
        })

        
        $(this).find('.pic img').stop(true,true).animate({
            'opacity':arr[i][4]
        },500)

        $(this).find('.pic').stop(true,true).animate({
            'height':arr[i][5]
        },500)
        
    })
}



var isSuppor3d=supportCss3('perspective');
function supportCss3(style) { 
    var prefix = ['webkit', 'Moz', 'ms', 'o'], 
    i, 
    humpString = [], 
    htmlStyle = document.documentElement.style, 
    _toHumb = function (string) { 
    return string.replace(/-(\w)/g, function ($0, $1) { 
    return $1.toUpperCase(); 
    }); 
    }; 
     
    for (i in prefix) 
    humpString.push(_toHumb(prefix[i] + '-' + style)); 
     
    humpString.push(_toHumb(style)); 
     
    for (i in humpString) 
    if (humpString[i] in htmlStyle) return true; 
     
    return false; 
}


function move(obj,x){
    if(isSuppor3d){
        obj.css({
            transform:'translate3d('+x+'px,0px,0px)',
            transition:'0.35s'
        })
    }else{
        obj.animate({
            'margin-left':x+'px'
        })
    }
}