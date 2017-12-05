/*! # HRS
 * lastupdate : Thu Jul 30 2015 11:33:44
 * version    : 1.0.0
 *
 * © 2015 ARCHETYP.
*/
var HRS_COMMON=HRS_COMMON||{};!function(a){"use strict";var b=a.document,c=a.jQuery,d=c,e=a.Sagen,f=e.Viewport,g=e.Browser,h=g.Mobile.is(),i=a.HRS_COMMON;g.Mobile.tablet()&&f.rewrite("width=980, user-scalable=yes, maximum-scale=1.6"),c.easing.easeInBounce=function(a,b,d,e,f){return e-c.easing.easeOutBounce(a,f-b,0,e,f)+d},c.easing.easeOutBounce=function(a,b,c,d,e){return(b/=e)<1/2.75?7.5625*d*b*b+c:2/2.75>b?d*(7.5625*(b-=1.5/2.75)*b+.75)+c:2.5/2.75>b?d*(7.5625*(b-=2.25/2.75)*b+.9375)+c:d*(7.5625*(b-=2.625/2.75)*b+.984375)+c},c.easing.easeInOutBounce=function(a,b,d,e,f){return f/2>b?.5*c.easing.easeInBounce(a,2*b,0,e,f)+d:.5*c.easing.easeOutBounce(a,2*b-f,0,e,f)+.5*e+d},d(b).ready(function(){function c(){var a=new RegExp("@2","g");t.each(function(){var b=d(this),c=b.attr("src");g>j?c.match(a)?b.attr("src",c.replace("@2x","")).show():b.show():j>=g&&(c.match(a)||b.attr("src",c.replace(/(\.gif|\.jpg|\.png)/g,"@2x$1")))})}function e(a){t=a}var f=d(a),g=d(a).width(),j=768,k=d(".head-sec"),l=d("header .nav-block"),m=d(".snavMenu"),n=d(".snav-trigger"),o=d(".nav-overlay"),p=d(".hnav2"),q=d(".hnav2 > a");if(d(".smoothing").on("click",function(a){g=f.width(),a.preventDefault(),a.stopPropagation();var b,c=k.height(),e=400,h=d(this).attr("href"),i=h.split("#").pop(),l=d(""===i?"html":"#"+i);"#whole"!==d(this).attr("href")&&"#body_sec"!==d(this).attr("href")&&g>j?(b=l.offset().top-c,d("body,html").stop().animate({scrollTop:b},e)):(b=l.offset().top,d("body,html").stop().animate({scrollTop:b},e))}),!h){var r=d(".enter-bounce");r.length>0&&(r.animate({scale:1},{duration:1,easing:"linear",step:function(a,b){if(!(1>=a)){var c="scale("+a+","+a+")";d(this).css({transform:c,"-webkit-transform":c,"-ms-transform":c})}}}),r.on("mouseenter",function(){var a=d(this);a.stop().animate({scale:1.2},{duration:120,easing:"swing",step:function(b,c){var d="scale("+b+","+b+")";a.css({transform:d,"-webkit-transform":d,"-ms-transform":d})}}).animate({scale:.8},{duration:200,easing:"swing",step:function(b,c){var d="scale("+b+","+b+")";a.css({transform:d,"-webkit-transform":d,"-ms-transform":d})}}).animate({scale:1.05},{duration:120,easing:"swing",step:function(b,c){var d="scale("+b+","+b+")";a.css({transform:d,"-webkit-transform":d,"-ms-transform":d})}}).animate({scale:1},{duration:60,easing:"swing",step:function(b,c){var d="scale("+b+","+b+")";a.css({transform:d,"-webkit-transform":d,"-ms-transform":d})}})}))}d(".gnav-trigger, .nav-overlay").on("click",function(a){if(a.preventDefault(),a.stopPropagation(),d(this).closest(".head-sec").toggleClass("gnav-active"),l.fadeToggle(200),l.toggleClass("active"),l.hasClass("active")){var b=d(".whole").height(),c=b-50;o.show().css({height:c,top:50}),d(".snav").css("z-index",99)}else o.hide(),d(".snav").css("z-index",9999)}),h?q.on("click",function(a){a.preventDefault(),a.stopPropagation(),d(this).toggleClass("active"),d(this).next("ul").fadeToggle(200)}):(p.on({mouseenter:function(){},mouseleave:function(){},click:function(){d(this).children().toggleClass("active"),d(this).find("ul").fadeToggle(200)}}),q.hasClass("active")&&d(b).on("click",function(a){d.contains(p[0],a.target)||(p.children().toggleClass("active"),p.find("ul").fadeToggle(200))})),d(b).on("click",function(a){q.hasClass("active")&&!d.contains(p[0],a.target)&&(p.children().toggleClass("active"),p.find("ul").fadeToggle(200))});var s=d('<div class="snav-overlay"></div>');n.on("click",function(a){if(a.preventDefault(),a.stopPropagation(),n.toggleClass("active"),n.next().fadeToggle(200),d(this).hasClass("active")){var b=d(".whole").height();d("#whole").prepend(s),s.on("click",function(){d(this).off("click").remove(),n.toggleClass("active"),n.next().fadeToggle(200)}),d(".snav-overlay").css("height",b)}else d(".snav-overlay").off("click").remove()});var t;i.setImages=e,f.on("resize load",function(){g=f.width();var a=d(".whole").height();if(g>j&&!k.hasClass("gnav-active")?l.css("display","block"):g>j&&k.hasClass("gnav-active")?o.css("display","none"):j>=g&&!k.hasClass("gnav-active")?l.css("display","none"):j>=g&&k.hasClass("gnav-active")&&o.css("display","block"),g>j&&!n.hasClass("active")?m.css("display","block"):j>=g&&!n.hasClass("active")&&m.css("display","none"),l.hasClass("active")){var b=a-50;o.css({height:b,top:50})}e(d("img.responsive")),c()});var u,v=d(".tabMenu"),w=d(".tabCategory");v.length>0&&w.length>0&&(u=v.find("a"),u.length>0&&u.on("click",function(a){a.preventDefault(),a.stopPropagation();var b,c=d(this),e=c.attr("href");u.removeClass("active"),w.hide(),c.addClass("active"),-1!==e.indexOf("#")&&(b=e.split("#").pop(),b&&d("#"+b).fadeToggle())}));var x=d(".pagetop");f.on("load scroll resize",function(){var c=d(b).height(),e=d(a).height()+d(a).scrollTop(),f=d(".foot-sec").innerHeight(),g=d(a).width();g>768?(d(b).scrollTop()>=400?x.addClass("fixed").fadeIn(300):x.removeClass("fixed").fadeOut(300),f>=c-e?x.removeClass("fixed"):x.addClass("fixed"),g>=1128?x.css("width",g):1128>g&&g>980?x.css("width",g):980>=g&&x.css("width",980)):x.removeClass("fixed").removeAttr("style")});var y=d(".mod-list-unorderdB li");y.matchHeight()})}(window);