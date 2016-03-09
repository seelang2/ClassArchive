/*!
 * build 2015-07-28 15:13:17
 */
var HRS_COMMON=HRS_COMMON||{};!function(t){"use strict";var i=t.HRS_COMMON;i.Slider=function(){function s(){var t=l.is()&&l.version()<6,i=c.is()&&c.version()<4.3,s=u.transform(),n=s;return(t||i)&&(n=!1),n}function n(t,n){p=s(),n.responsive=!!n.responsive,n.animate=!!n.animate,n.pager=!!n.pager,n.pagerTarget=n.pagerTarget||"",n.control=!!n.control,n.controlTarget=n.controlTarget||"",n.pause=n.pause||6e3,n.minSlides=n.minSlides||1,n.maxSlides=n.maxSlides||1,n.perSlides=n.perSlides||1,this._$container=t.parent(),this._options=n;var e=t,h=e.find(">li"),r=h.length;this._width=i.width,this._$ul=e,this._$li=h,this._$a=h.find(">a"),this._wrapper=document.createElement("div"),this._inner=document.createElement("div"),this._$span=null,this._index=-1,this._x=-1,this._startX=-1,this._timer=0,this._isPause=!0,this._limit=r,this._end=r-1,this._$stage=e,this._targetLeft=0/0,this._boundTouchStart=this.onTouchStart.bind(this),this._boundTouchEnd=this.onTouchEnd.bind(this),this._boundTouchMove=this.onTouchMove.bind(this),this._boundCancel=this.cancelMove.bind(this),this._boundClick=this.onDisabledClick.bind(this),this._endEvent="transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",this._$pager=null,this._$control=null,this._$spans=[],this._startTime=0,this._css={position:"relative",top:0,width:"99999999px","transition-property":"transform","-webkit-transition-property":"-webkit-transform","transition-duration":"0.5s","-webkit-transition-duration":"0.5s"},this._polling=new _(n.pause),this._boundUpdate=this.pollingUpdate.bind(this),this._touchTimer=0,this._currentWidth=0,this.enableSilde=!0}var e=Math.abs,h=parseFloat,r=t.jQuery,o=t.Sagen,a=o.Browser,u=a.Css3,l=a.iOS,c=a.Android,d=a.Mobile,_=t.Gasane.Polling,p=i.can3d,f=u.transition(),v=d.phone(),m=d.tablet(),x=r(t),g=n.prototype;return g.constructor=n,g.init=function(){var t,i,s,n,e,h,o,a,u=this._$container,l=this._options,c=this._$ul,d=this._$li,p=this._limit,f=l.pager,g=this._wrapper,w=this._inner;if(l.height&&"auto"!==l.height&&u.height(l.height),f&&(t=r(l.pagerTarget),this._$pager=t),l.control&&l.controlTarget&&(i=r(l.controlTarget),this._$control=i),1>=p||p<=l.minSlides)return t&&t.length>0&&t.children(":first").addClass("current"),i&&i.length>0&&i.hide(),this.enableSilde=!1,this;for(i&&this._setUpControl(),h=this.width(),this._currentWidth=h,s=0;p>s;s++)n=d[s],n.style.cssText="float: left; position: relative; margin: 0; width: "+h+"px",c.append(r(n).clone());for(f&&this._setUpPager(),s=0;p>s;s++)c.append(r(d[s]).clone());return a=c.find(">li"),this._$li=a,e=h*a.length,this._css.width=e+"px",o=h*-p+10,this.sliderCSS(o,"0.5s"),this.containerCSS(),c.wrap(g).wrap(w),(m||v)&&this._$stage.on("touchstart",this._boundTouchStart),x.on("resize",this.onResize.bind(this)),l.animate?(this._polling.on(_.PAST,this._boundUpdate),this.resume().next()):this.next(),this},g.start=function(){return this.enableSilde?(this._options.animate?(this._polling.on(_.PAST,this._boundUpdate),this.resume()):this.next(),this):this},g.onResize=function(){var t=this.width();t!==this._currentWidth&&(this._currentWidth=t,this.restore(t))},g.restore=function(t){var i=this._$li,s=i.length,n=t*s;i.css("width",t+"px"),this._css.width=n+"px",this.jump(this._index)},g.jump=function(t){this._index=t-1,this.next()},g._setUpPager=function(){var t,i,s,n,e=this._$pager,h=this._$spans;for(i=e.find(".aeoncinema-slider-thumbnail"),s=0,n=i.length;n>s;s++)h.push(r(i[s]));v||(t=this,i.on("click",function(i){i.preventDefault(),i.stopPropagation();var s=r(this),n=1*s.attr("data-index").split("-").pop();t.jump(n)})),this._$spans=h,this._$span=i},g._setUpControl=function(){var t=this._$control,i="click",s=t.find(".prev"),n=t.find(".next");(m||v)&&(i="touchstart"),s.on(i,this.onPrevTouch.bind(this)),n.on(i,this.onNextTouch.bind(this))},g.onPrevTouch=function(t){t.preventDefault(),t.stopPropagation(),this._index<0&&(this._index=0),this.pause().prev()},g.onNextTouch=function(t){t.preventDefault(),t.stopPropagation(),this._index<0&&(this._index=0),this.pause().next()},g.onDisabledClick=function(t){t.preventDefault(),t.stopPropagation()},g.abortClick=function(){return this._$a.on("touchstart touchend",this._boundClick),this},g.activateClick=function(){return this._$a.off("touchstart touchend",this._boundClick),this},g.sliderCSS=function(t,i){var s,n=t+"px";return f?(s=Object.create(this._css),p?this.slide3d(n,i,s):this.slideLeft(n,i)):this.slideLeft(n,i),this},g.slide3d=function(t,i,s){s.transform="translate3d("+t+", 0, 0)",s["-webkit-transform"]="translate3d("+t+", 0, 0)",s["transition-duration"]=i,s["-webkit-transition-duration"]=i,this._$ul.css(s)},g.slide2d=function(t,i,s){s.transform="translate("+t+", 0)",s["-webkit-transform"]="translate("+t+", 0)",s["transition-duration"]=i,s["-webkit-transition-duration"]=i,this._$ul.css(s)},g.slideLeft=function(t,i){var s=1e3*h(i),n=this._$ul,e=this._css,r=this;n.stop().css({width:e.width,top:e.top,position:e.position}),s>0?n.animate({left:t},s,function(){r.cancelMove()}):(n.css("left",t),r.cancelMove())},g.containerCSS=function(){return this._wrapper.style.cssText="margin: 0 auto; position: relative;",this._inner.style.cssText="position: relative;",this},g.maxWidth=function(){return this.width()},g.width=function(){return this._$container.width()},g.normalizeNext=function(t,i){return t+=i,t>this._end&&(t=t-this._end-1),t},g.normalizePrev=function(t,i){return t-=i,0>t&&(t=t+this._end+1),t},g.markCurrent=function(t){function i(i){try{r(s[i]).addClass(a)}catch(n){console.warn("banner out of range: "+i+", index: "+t)}}var s=this._$li,n=this._limit,e=t,h=e+n,o=h+n,a="current";s.removeClass(a),i(e),i(h),i(o)},g.pager=function(t){var i=this._$span;if(i){i.removeClass("current");try{this._$spans[t].addClass("current")}catch(s){console.warn("pager out of range: "+t)}}return this.markCurrent(t),this},g.resetPosition=function(t){return 0===t?this.warp(this._limit):t>=this._end&&this.warp(this._end),this},g.prepareNextPosition=function(t){var i,s,n,e,h,r=this._options.perSlides;return i=this.normalizeNext(t,r),s=this.width(),n=this.left(),e=-s*(i+this._limit),e>n&&(h=s*this._limit,this.frozen(h+n)),this},g.preparePrevPosition=function(t){var i,s,n,e,h,r=this._options.perSlides;return s=this.width(),i=this.left(),e=this.normalizePrev(t,r),h=-s*(e+this._limit),i>h&&(n=-s*this._limit,this.frozen(i+n)),this},g.frozen=function(t){return this._targetLeft=t,this.sliderCSS(t,"0s"),this},g.warp=function(t){var i=this.width(),s=-i*t;return this.frozen(s),this},g.drag=function(t){var i=this.left();return i+=t,this.frozen(i),this},g.moving=function(t,i){var s,n,e=this.width(),h=-e*(t+this._limit);return h!==this.left()&&(s=this._targetLeft,i=!!i,n=i?"0.25s":"0.5s",this.waitMoving(s,h,t,n)),this},g.waitMoving=function(t,i,s,n){if(e(t-this.left())>10){var h=this;return setTimeout(function(){h.waitMoving(t,i,s,n)},25),this}return this._targetLeft=i,this.sliderCSS(i,n).pager(s),this.resume(),this._$ul.on(this._endEvent,this._boundCancel),this._timer=1,this},g.cancelMoveStrong=function(){var t,i,s=this._$ul;return this._timer&&(t=s[0],i=t.style.cssText,i=i.split("0.5s").join("0s").split("0.25s").join("0s"),t.style.cssText=i,this.cancelMove()),this},g.cancelMove=function(){return this._timer&&(this._$ul.off(this._endEvent,this._boundCancel),this._timer=0),this},g.next=function(){this.cancelMoveStrong().pause();var t=this._options.perSlides;return this._index===this._end&&this.warp(this._end),1!==t&&this._index+t>this._end&&this.warp(this._index-this._limit+this._limit),this._index=this.normalizeNext(this._index,t),this.moving(this._index),this},g.prev=function(){this.cancelMoveStrong().pause();var t=this._options.perSlides;return 0===this._index&&this.warp(this._limit+this._limit),1!==t&&this._index-t<0&&this.warp(this._limit+this._limit+this._index),this._index=this.normalizePrev(this._index,t),this.moving(this._index),this},g.pause=function(){return this._options.animate&&(this._isPause||(this._isPause=!0,this._polling.stop())),this},g.resume=function(){return this._options.animate&&this._isPause&&(this._isPause=!1,this._polling.start(!0)),this},g.pollingUpdate=function(){this.next()},g.x=function(t){return this.position(t).x},g.y=function(t){return this.position(t).y},g.position=function(t){var i=t.originalEvent.changedTouches[0];return{x:h(i.pageX),y:h(i.pageY)}},g.left=function(){var t,i,s,n,e=this._$ul;return f?(i=e.css("-webkit-transform"),p?(i||(i=e.css("transform")),-1!==i.indexOf("matrix3d")?(t=e[0].style.cssText,s=t.split("translate3d(").pop(),n=s.split(",").shift()):(s=i.split(", "),s.pop(),n=s.pop())):n=e.css("left")):n=e.css("left"),h(n)},g.onTouchStart=function(t){clearTimeout(this._touchTimer),this.cancelMoveStrong(),this.pause().abortClick();var i=this._$stage,s=this.x(t);this._x=s,this._startX=s,i.on("touchmove",this._boundTouchMove),i.on("touchend",this._boundTouchEnd)},g.onTouchMove=function(t){var i=this.x(t),s=i-this._x;(e(s)>=10||e(i-this._startX)>=10)&&(t.preventDefault(),this.cancelMove().drag(s),this._x=i)},g.onTouchEnd=function(t){var i=this._x,s=i-this._startX,n=this._$stage,h=this._options.perSlides,r=this;n.off("touchmove",this._boundTouchMove),n.off("touchend",this._boundTouchEnd),e(s)>=50||e(i-this._startX)>=50?(t.preventDefault(),this.reIndex(s,h),this._x=-1,this._index<0&&(this._index=0),0>s?(this.prepareNextPosition(this._index),this._index=this.normalizeNext(this._index,h)):(this.preparePrevPosition(this._index),this._index=this.normalizePrev(this._index,h)),this.moving(this._index)):this.moving(this._index,!0),setTimeout(function(){r.activateClick()},750)},g.reIndex=function(t,i){var s,n=this.width();0>t?(s=Math.floor(-t/n*i),s>0&&(this._index+=s)):(s=Math.floor(t/n*i),s>0&&(this._index-=s))},g.onLoad=function(){},n}()}(window);