!function(t){t.fn.slideAccordion=function(n){var s=t.extend({addClassBeforeAnimation:!1,allowClickWhenExpanded:!1,activeClass:"active",opener:".opener",slider:".slide",animSpeed:300,collapsible:!0,event:"click"},n);return this.each(function(){var n=t(this),o=n.find(":has("+s.slider+")");o.each(function(){var n=t(this),o=n.find(s.opener),r=n.find(s.slider);o.bind(s.event,function(t){if(!r.is(":animated"))if(n.hasClass(s.activeClass)){if(s.allowClickWhenExpanded)return;s.collapsible&&r.slideUp(s.animSpeed,function(){i(r),n.removeClass(s.activeClass)})}else{var o=n.siblings("."+s.activeClass),a=o.find(s.slider);n.addClass(s.activeClass),e(r).hide().slideDown(s.animSpeed),a.slideUp(s.animSpeed,function(){o.removeClass(s.activeClass),i(a)})}t.preventDefault()}),n.hasClass(s.activeClass)?e(r):i(r)})})};var e=function(t){return t.css({position:"",top:"",left:"",width:""})},i=function(t){return t.show().css({position:"absolute",top:-9999,left:-9999,width:t.width()})}}(jQuery);
