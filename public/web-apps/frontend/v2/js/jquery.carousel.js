!function(t){function e(e){this.options=t.extend({mask:"div.mask",slider:">*",slides:">*",activeClass:"active",disabledClass:"disabled",btnPrev:"a.btn-prev",btnNext:"a.btn-next",generatePagination:!1,pagerList:"<ul>",pagerListItem:'<li><a href="#"></a></li>',pagerListItemText:"a",pagerLinks:".pagination li",currentNumber:"span.current-num",totalNumber:"span.total-num",btnPlay:".btn-play",btnPause:".btn-pause",btnPlayPause:".btn-play-pause",galleryReadyClass:"gallery-js-ready",autorotationActiveClass:"autorotation-active",autorotationDisabledClass:"autorotation-disabled",stretchSlideToMask:!1,circularRotation:!0,disableWhileAnimating:!1,autoRotation:!1,pauseOnHover:i?!1:!0,maskAutoSize:!1,switchTime:4e3,animSpeed:600,event:"click",swipeThreshold:15,handleTouch:!0,vertical:!1,useTranslate3D:!1,step:!1},e),this.init()}e.prototype={init:function(){this.options.holder&&(this.findElements(),this.attachEvents(),this.refreshPosition(),this.refreshState(!0),this.resumeRotation(),this.makeCallback("onInit",this))},findElements:function(){if(this.fullSizeFunction=this.options.vertical?"outerHeight":"outerWidth",this.innerSizeFunction=this.options.vertical?"height":"width",this.slideSizeFunction="outerHeight",this.maskSizeProperty="height",this.animProperty=this.options.vertical?"marginTop":"marginLeft",this.gallery=t(this.options.holder).addClass(this.options.galleryReadyClass),this.mask=this.gallery.find(this.options.mask),this.slider=this.mask.find(this.options.slider),this.slides=this.slider.find(this.options.slides),this.btnPrev=this.gallery.find(this.options.btnPrev),this.btnNext=this.gallery.find(this.options.btnNext),this.currentStep=0,this.stepsCount=0,this.options.step===!1){var e=this.slides.filter("."+this.options.activeClass);e.length&&(this.currentStep=this.slides.index(e))}this.calculateOffsets(),"string"==typeof this.options.generatePagination?(this.pagerLinks=t(),this.buildPagination()):(this.pagerLinks=this.gallery.find(this.options.pagerLinks),this.attachPaginationEvents()),this.btnPlay=this.gallery.find(this.options.btnPlay),this.btnPause=this.gallery.find(this.options.btnPause),this.btnPlayPause=this.gallery.find(this.options.btnPlayPause),this.curNum=this.gallery.find(this.options.currentNumber),this.allNum=this.gallery.find(this.options.totalNumber)},attachEvents:function(){var e=this;this.bindHandlers(["onWindowResize"]),t(window).bind("load resize orientationchange",this.onWindowResize),this.btnPrev.length&&(this.prevSlideHandler=function(t){t.preventDefault(),e.prevSlide()},this.btnPrev.bind(this.options.event,this.prevSlideHandler)),this.btnNext.length&&(this.nextSlideHandler=function(t){t.preventDefault(),e.nextSlide()},this.btnNext.bind(this.options.event,this.nextSlideHandler)),this.options.pauseOnHover&&!i&&(this.hoverHandler=function(){e.options.autoRotation&&(e.galleryHover=!0,e.pauseRotation())},this.leaveHandler=function(){e.options.autoRotation&&(e.galleryHover=!1,e.resumeRotation())},this.gallery.bind({mouseenter:this.hoverHandler,mouseleave:this.leaveHandler})),this.btnPlay.length&&(this.btnPlayHandler=function(t){t.preventDefault(),e.startRotation()},this.btnPlay.bind(this.options.event,this.btnPlayHandler)),this.btnPause.length&&(this.btnPauseHandler=function(t){t.preventDefault(),e.stopRotation()},this.btnPause.bind(this.options.event,this.btnPauseHandler)),this.btnPlayPause.length&&(this.btnPlayPauseHandler=function(t){t.preventDefault(),e.gallery.hasClass(e.options.autorotationActiveClass)?e.stopRotation():e.startRotation()},this.btnPlayPause.bind(this.options.event,this.btnPlayPauseHandler)),i&&this.options.useTranslate3D&&this.slider.css({"-webkit-transform":"translate3d(0px, 0px, 0px)"}),i&&this.options.handleTouch&&window.Hammer&&this.mask.length&&(this.swipeHandler=new Hammer.Manager(this.mask[0]),this.swipeHandler.add(new Hammer.Pan({direction:e.options.vertical?Hammer.DIRECTION_VERTICAL:Hammer.DIRECTION_HORIZONTAL,threshold:e.options.swipeThreshold})),this.swipeHandler.on("panstart",function(){e.galleryAnimating?e.swipeHandler.stop():(e.pauseRotation(),e.originalOffset=parseFloat(e.slider.css(e.animProperty)))}).on("panmove",function(t){var i=e.originalOffset+t[e.options.vertical?"deltaY":"deltaX"];i=Math.max(Math.min(0,i),e.maxOffset),e.slider.css(e.animProperty,i)}).on("panend",function(t){e.resumeRotation(),t.distance>e.options.swipeThreshold?t.offsetDirection===Hammer.DIRECTION_RIGHT||t.offsetDirection===Hammer.DIRECTION_DOWN?e.nextSlide():e.prevSlide():e.switchSlide()}))},onWindowResize:function(){this.galleryAnimating?this.resizeQueue=!0:(this.calculateOffsets(),this.refreshPosition(),this.buildPagination(),this.refreshState(),this.resizeQueue=!1)},refreshPosition:function(){this.currentStep=Math.min(this.currentStep,this.stepsCount-1),this.tmpProps={},this.tmpProps[this.animProperty]=this.getStepOffset(),this.slider.stop().css(this.tmpProps)},calculateOffsets:function(){var e,i,n=this;if(this.options.stretchSlideToMask){var s={};s[this.innerSizeFunction]=this.mask[this.innerSizeFunction](),this.slides.css(s)}if(this.maskSize=this.mask[this.innerSizeFunction](),this.sumSize=this.getSumSize(),this.maxOffset=this.maskSize-this.sumSize,this.options.vertical&&this.options.maskAutoSize){this.options.step=1,this.stepsCount=this.slides.length,this.stepOffsets=[0],e=0;for(var o=0;o<this.slides.length;o++)e-=t(this.slides[o])[this.fullSizeFunction](!0),this.stepOffsets.push(e);return void(this.maxOffset=e)}if("number"==typeof this.options.step&&this.options.step>0)for(this.slideDimensions=[],this.slides.each(t.proxy(function(e,i){n.slideDimensions.push(t(i)[n.fullSizeFunction](!0))},this)),this.stepOffsets=[0],this.stepsCount=1,e=i=0;e>this.maxOffset;)e-=this.getSlideSize(i,i+this.options.step),i+=this.options.step,this.stepOffsets.push(Math.max(e,this.maxOffset)),this.stepsCount++;else for(this.stepSize=this.maskSize,this.stepsCount=1,e=0;e>this.maxOffset;)e-=this.stepSize,this.stepsCount++},getSumSize:function(){var e=0;return this.slides.each(t.proxy(function(i,n){e+=t(n)[this.fullSizeFunction](!0)},this)),this.slider.css(this.innerSizeFunction,e),e},getStepOffset:function(t){return t=t||this.currentStep,"number"==typeof this.options.step?this.stepOffsets[this.currentStep]:Math.min(0,Math.max(-this.currentStep*this.stepSize,this.maxOffset))},getSlideSize:function(t,e){for(var i=0,n=t;n<Math.min(e,this.slideDimensions.length);n++)i+=this.slideDimensions[n];return i},buildPagination:function(){if("string"==typeof this.options.generatePagination&&(this.pagerHolder||(this.pagerHolder=this.gallery.find(this.options.generatePagination)),this.pagerHolder.length&&this.oldStepsCount!=this.stepsCount)){this.oldStepsCount=this.stepsCount,this.pagerHolder.empty(),this.pagerList=t(this.options.pagerList).appendTo(this.pagerHolder);for(var e=0;e<this.stepsCount;e++)t(this.options.pagerListItem).appendTo(this.pagerList).find(this.options.pagerListItemText).text(e+1);this.pagerLinks=this.pagerList.children(),this.attachPaginationEvents()}},attachPaginationEvents:function(){var t=this;this.pagerLinksHandler=function(e){e.preventDefault(),t.numSlide(t.pagerLinks.index(e.currentTarget))},this.pagerLinks.bind(this.options.event,this.pagerLinksHandler)},prevSlide:function(){this.options.disableWhileAnimating&&this.galleryAnimating||(this.currentStep>0?(this.currentStep--,this.switchSlide()):this.options.circularRotation&&(this.currentStep=this.stepsCount-1,this.switchSlide()))},nextSlide:function(t){this.options.disableWhileAnimating&&this.galleryAnimating||(this.currentStep<this.stepsCount-1?(this.currentStep++,this.switchSlide()):(this.options.circularRotation||t===!0)&&(this.currentStep=0,this.switchSlide()))},numSlide:function(t){this.currentStep!=t&&(this.currentStep=t,this.switchSlide())},switchSlide:function(){var t=this;this.galleryAnimating=!0,this.tmpProps={},this.tmpProps[this.animProperty]=this.getStepOffset(),this.slider.stop().animate(this.tmpProps,{duration:this.options.animSpeed,complete:function(){t.galleryAnimating=!1,t.resizeQueue&&t.onWindowResize(),t.makeCallback("onChange",t),t.autoRotate()}}),this.refreshState(),this.makeCallback("onBeforeChange",this)},refreshState:function(t){(1===this.options.step||this.stepsCount===this.slides.length)&&this.slides.removeClass(this.options.activeClass).eq(this.currentStep).addClass(this.options.activeClass),this.pagerLinks.removeClass(this.options.activeClass).eq(this.currentStep).addClass(this.options.activeClass),this.curNum.html(this.currentStep+1),this.allNum.html(this.stepsCount),this.options.maskAutoSize&&"number"==typeof this.options.step&&(this.tmpProps={},this.tmpProps[this.maskSizeProperty]=this.slides.eq(Math.min(this.currentStep,this.slides.length-1))[this.slideSizeFunction](!0),this.mask.stop()[t?"css":"animate"](this.tmpProps)),this.options.circularRotation||(this.btnPrev.add(this.btnNext).removeClass(this.options.disabledClass),0===this.currentStep&&this.btnPrev.addClass(this.options.disabledClass),this.currentStep===this.stepsCount-1&&this.btnNext.addClass(this.options.disabledClass)),this.gallery.toggleClass("not-enough-slides",this.sumSize<=this.maskSize)},startRotation:function(){this.options.autoRotation=!0,this.galleryHover=!1,this.autoRotationStopped=!1,this.resumeRotation()},stopRotation:function(){this.galleryHover=!0,this.autoRotationStopped=!0,this.pauseRotation()},pauseRotation:function(){this.gallery.addClass(this.options.autorotationDisabledClass),this.gallery.removeClass(this.options.autorotationActiveClass),clearTimeout(this.timer)},resumeRotation:function(){this.autoRotationStopped||(this.gallery.addClass(this.options.autorotationActiveClass),this.gallery.removeClass(this.options.autorotationDisabledClass),this.autoRotate())},autoRotate:function(){var t=this;clearTimeout(this.timer),!this.options.autoRotation||this.galleryHover||this.autoRotationStopped?this.pauseRotation():this.timer=setTimeout(function(){t.nextSlide(!0)},this.options.switchTime)},bindHandlers:function(e){var i=this;t.each(e,function(t,e){var n=i[e];i[e]=function(){return n.apply(i,arguments)}})},makeCallback:function(t){if("function"==typeof this.options[t]){var e=Array.prototype.slice.call(arguments);e.shift(),this.options[t].apply(this,e)}},destroy:function(){t(window).unbind("load resize orientationchange",this.onWindowResize),this.btnPrev.unbind(this.options.event,this.prevSlideHandler),this.btnNext.unbind(this.options.event,this.nextSlideHandler),this.pagerLinks.unbind(this.options.event,this.pagerLinksHandler),this.gallery.unbind("mouseenter",this.hoverHandler),this.gallery.unbind("mouseleave",this.leaveHandler),this.stopRotation(),this.btnPlay.unbind(this.options.event,this.btnPlayHandler),this.btnPause.unbind(this.options.event,this.btnPauseHandler),this.btnPlayPause.unbind(this.options.event,this.btnPlayPauseHandler),this.swipeHandler&&this.swipeHandler.destroy();var e=[this.options.galleryReadyClass,this.options.autorotationActiveClass,this.options.autorotationDisabledClass];this.gallery.removeClass(e.join(" ")),this.slider.add(this.slides).removeAttr("style"),"string"==typeof this.options.generatePagination&&this.pagerHolder.empty()}};var i=/Windows Phone/.test(navigator.userAgent)||"ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch;t.fn.scrollGallery=function(i){return this.each(function(){t(this).data("ScrollGallery",new e(t.extend(i,{holder:this})))})}}(jQuery),Object.create&&!function(t,e,i,n){"use strict";function s(t,e,i){return setTimeout(h(t,i),e)}function o(t,e,i){return Array.isArray(t)?(r(t,i[e],i),!0):!1}function r(t,e,i){var s;if(t)if(t.forEach)t.forEach(e,i);else if(t.length!==n)for(s=0;s<t.length;)e.call(i,t[s],s,t),s++;else for(s in t)t.hasOwnProperty(s)&&e.call(i,t[s],s,t)}function a(t,e,i){for(var s=Object.keys(e),o=0;o<s.length;)(!i||i&&t[s[o]]===n)&&(t[s[o]]=e[s[o]]),o++;return t}function l(t,e){return a(t,e,!0)}function c(t,e,i){var n,s=e.prototype;n=t.prototype=Object.create(s),n.constructor=t,n._super=s,i&&a(n,i)}function h(t,e){return function(){return t.apply(e,arguments)}}function u(t,e){return typeof t==ht?t.apply(e?e[0]||n:n,e):t}function p(t,e){return t===n?e:t}function d(t,e,i){r(v(e),function(e){t.addEventListener(e,i,!1)})}function f(t,e,i){r(v(e),function(e){t.removeEventListener(e,i,!1)})}function m(t,e){for(;t;){if(t==e)return!0;t=t.parentNode}return!1}function g(t,e){return t.indexOf(e)>-1}function v(t){return t.trim().split(/\s+/g)}function y(t,e,i){if(t.indexOf&&!i)return t.indexOf(e);for(var n=0;n<t.length;){if(i&&t[n][i]==e||!i&&t[n]===e)return n;n++}return-1}function b(t){return Array.prototype.slice.call(t,0)}function w(t,e,i){for(var n=[],s=[],o=0;o<t.length;){var r=e?t[o][e]:t[o];y(s,r)<0&&n.push(t[o]),s[o]=r,o++}return i&&(n=e?n.sort(function(t,i){return t[e]>i[e]}):n.sort()),n}function x(t,e){for(var i,s,o=e[0].toUpperCase()+e.slice(1),r=0;r<lt.length;){if(i=lt[r],s=i?i+o:e,s in t)return s;r++}return n}function C(){return ft++}function k(t){var e=t.ownerDocument;return e.defaultView||e.parentWindow}function T(t,e){var i=this;this.manager=t,this.callback=e,this.element=t.element,this.target=t.options.inputTarget,this.domHandler=function(e){u(t.options.enable,[t])&&i.handler(e)},this.init()}function S(t){var e,i=t.options.inputClass;return new(e=i?i:vt?B:yt?q:gt?W:z)(t,A)}function A(t,e,i){var n=i.pointers.length,s=i.changedPointers.length,o=e&Tt&&n-s===0,r=e&(At|$t)&&n-s===0;i.isFirst=!!o,i.isFinal=!!r,o&&(t.session={}),i.eventType=e,$(t,i),t.emit("hammer.input",i),t.recognize(i),t.session.prevInput=i}function $(t,e){var i=t.session,n=e.pointers,s=n.length;i.firstInput||(i.firstInput=_(e)),s>1&&!i.firstMultiple?i.firstMultiple=_(e):1===s&&(i.firstMultiple=!1);var o=i.firstInput,r=i.firstMultiple,a=r?r.center:o.center,l=e.center=O(n);e.timeStamp=dt(),e.deltaTime=e.timeStamp-o.timeStamp,e.angle=D(a,l),e.distance=I(a,l),E(i,e),e.offsetDirection=H(e.deltaX,e.deltaY),e.scale=r?N(r.pointers,n):1,e.rotation=r?L(r.pointers,n):0,P(i,e);var c=t.element;m(e.srcEvent.target,c)&&(c=e.srcEvent.target),e.target=c}function E(t,e){var i=e.center,n=t.offsetDelta||{},s=t.prevDelta||{},o=t.prevInput||{};(e.eventType===Tt||o.eventType===At)&&(s=t.prevDelta={x:o.deltaX||0,y:o.deltaY||0},n=t.offsetDelta={x:i.x,y:i.y}),e.deltaX=s.x+(i.x-n.x),e.deltaY=s.y+(i.y-n.y)}function P(t,e){var i,s,o,r,a=t.lastInterval||e,l=e.timeStamp-a.timeStamp;if(e.eventType!=$t&&(l>kt||a.velocity===n)){var c=a.deltaX-e.deltaX,h=a.deltaY-e.deltaY,u=R(l,c,h);s=u.x,o=u.y,i=pt(u.x)>pt(u.y)?u.x:u.y,r=H(c,h),t.lastInterval=e}else i=a.velocity,s=a.velocityX,o=a.velocityY,r=a.direction;e.velocity=i,e.velocityX=s,e.velocityY=o,e.direction=r}function _(t){for(var e=[],i=0;i<t.pointers.length;)e[i]={clientX:ut(t.pointers[i].clientX),clientY:ut(t.pointers[i].clientY)},i++;return{timeStamp:dt(),pointers:e,center:O(e),deltaX:t.deltaX,deltaY:t.deltaY}}function O(t){var e=t.length;if(1===e)return{x:ut(t[0].clientX),y:ut(t[0].clientY)};for(var i=0,n=0,s=0;e>s;)i+=t[s].clientX,n+=t[s].clientY,s++;return{x:ut(i/e),y:ut(n/e)}}function R(t,e,i){return{x:e/t||0,y:i/t||0}}function H(t,e){return t===e?Et:pt(t)>=pt(e)?t>0?Pt:_t:e>0?Ot:Rt}function I(t,e,i){i||(i=Lt);var n=e[i[0]]-t[i[0]],s=e[i[1]]-t[i[1]];return Math.sqrt(n*n+s*s)}function D(t,e,i){i||(i=Lt);var n=e[i[0]]-t[i[0]],s=e[i[1]]-t[i[1]];return 180*Math.atan2(s,n)/Math.PI}function L(t,e){return D(e[1],e[0],Nt)-D(t[1],t[0],Nt)}function N(t,e){return I(e[0],e[1],Nt)/I(t[0],t[1],Nt)}function z(){this.evEl=Bt,this.evWin=Mt,this.allow=!0,this.pressed=!1,T.apply(this,arguments)}function B(){this.evEl=Ft,this.evWin=Wt,T.apply(this,arguments),this.store=this.manager.session.pointerEvents=[]}function M(){this.evTarget=Yt,this.evWin=Xt,this.started=!1,T.apply(this,arguments)}function j(t,e){var i=b(t.touches),n=b(t.changedTouches);return e&(At|$t)&&(i=w(i.concat(n),"identifier",!0)),[i,n]}function q(){this.evTarget=Qt,this.targetIds={},T.apply(this,arguments)}function F(t,e){var i=b(t.touches),n=this.targetIds;if(e&(Tt|St)&&1===i.length)return n[i[0].identifier]=!0,[i,i];var s,o,r=b(t.changedTouches),a=[],l=this.target;if(o=i.filter(function(t){return m(t.target,l)}),e===Tt)for(s=0;s<o.length;)n[o[s].identifier]=!0,s++;for(s=0;s<r.length;)n[r[s].identifier]&&a.push(r[s]),e&(At|$t)&&delete n[r[s].identifier],s++;return a.length?[w(o.concat(a),"identifier",!0),a]:void 0}function W(){T.apply(this,arguments);var t=h(this.handler,this);this.touch=new q(this.manager,t),this.mouse=new z(this.manager,t)}function U(t,e){this.manager=t,this.set(e)}function Y(t){if(g(t,ee))return ee;var e=g(t,ie),i=g(t,ne);return e&&i?ie+" "+ne:e||i?e?ie:ne:g(t,te)?te:Jt}function X(t){this.id=C(),this.manager=null,this.options=l(t||{},this.defaults),this.options.enable=p(this.options.enable,!0),this.state=se,this.simultaneous={},this.requireFail=[]}function V(t){return t&ce?"cancel":t&ae?"end":t&re?"move":t&oe?"start":""}function Q(t){return t==Rt?"down":t==Ot?"up":t==Pt?"left":t==_t?"right":""}function G(t,e){var i=e.manager;return i?i.get(t):t}function Z(){X.apply(this,arguments)}function K(){Z.apply(this,arguments),this.pX=null,this.pY=null}function J(){Z.apply(this,arguments)}function tt(){X.apply(this,arguments),this._timer=null,this._input=null}function et(){Z.apply(this,arguments)}function it(){Z.apply(this,arguments)}function nt(){X.apply(this,arguments),this.pTime=!1,this.pCenter=!1,this._timer=null,this._input=null,this.count=0}function st(t,e){return e=e||{},e.recognizers=p(e.recognizers,st.defaults.preset),new ot(t,e)}function ot(t,e){e=e||{},this.options=l(e,st.defaults),this.options.inputTarget=this.options.inputTarget||t,this.handlers={},this.session={},this.recognizers=[],this.element=t,this.input=S(this),this.touchAction=new U(this,this.options.touchAction),rt(this,!0),r(e.recognizers,function(t){var e=this.add(new t[0](t[1]));t[2]&&e.recognizeWith(t[2]),t[3]&&e.requireFailure(t[3])},this)}function rt(t,e){var i=t.element;r(t.options.cssProps,function(t,n){i.style[x(i.style,n)]=e?t:""})}function at(t,i){var n=e.createEvent("Event");n.initEvent(t,!0,!0),n.gesture=i,i.target.dispatchEvent(n)}var lt=["","webkit","moz","MS","ms","o"],ct=e.createElement("div"),ht="function",ut=Math.round,pt=Math.abs,dt=Date.now,ft=1,mt=/mobile|tablet|ip(ad|hone|od)|android/i,gt="ontouchstart"in t,vt=x(t,"PointerEvent")!==n,yt=gt&&mt.test(navigator.userAgent),bt="touch",wt="pen",xt="mouse",Ct="kinect",kt=25,Tt=1,St=2,At=4,$t=8,Et=1,Pt=2,_t=4,Ot=8,Rt=16,Ht=Pt|_t,It=Ot|Rt,Dt=Ht|It,Lt=["x","y"],Nt=["clientX","clientY"];T.prototype={handler:function(){},init:function(){this.evEl&&d(this.element,this.evEl,this.domHandler),this.evTarget&&d(this.target,this.evTarget,this.domHandler),this.evWin&&d(k(this.element),this.evWin,this.domHandler)},destroy:function(){this.evEl&&f(this.element,this.evEl,this.domHandler),this.evTarget&&f(this.target,this.evTarget,this.domHandler),this.evWin&&f(k(this.element),this.evWin,this.domHandler)}};var zt={mousedown:Tt,mousemove:St,mouseup:At},Bt="mousedown",Mt="mousemove mouseup";c(z,T,{handler:function(t){var e=zt[t.type];e&Tt&&0===t.button&&(this.pressed=!0),e&St&&1!==t.which&&(e=At),this.pressed&&this.allow&&(e&At&&(this.pressed=!1),this.callback(this.manager,e,{pointers:[t],changedPointers:[t],pointerType:xt,srcEvent:t}))}});var jt={pointerdown:Tt,pointermove:St,pointerup:At,pointercancel:$t,pointerout:$t},qt={2:bt,3:wt,4:xt,5:Ct},Ft="pointerdown",Wt="pointermove pointerup pointercancel";t.MSPointerEvent&&(Ft="MSPointerDown",Wt="MSPointerMove MSPointerUp MSPointerCancel"),c(B,T,{handler:function(t){var e=this.store,i=!1,n=t.type.toLowerCase().replace("ms",""),s=jt[n],o=qt[t.pointerType]||t.pointerType,r=o==bt,a=y(e,t.pointerId,"pointerId");s&Tt&&(0===t.button||r)?0>a&&(e.push(t),a=e.length-1):s&(At|$t)&&(i=!0),0>a||(e[a]=t,this.callback(this.manager,s,{pointers:e,changedPointers:[t],pointerType:o,srcEvent:t}),i&&e.splice(a,1))}});var Ut={touchstart:Tt,touchmove:St,touchend:At,touchcancel:$t},Yt="touchstart",Xt="touchstart touchmove touchend touchcancel";c(M,T,{handler:function(t){var e=Ut[t.type];if(e===Tt&&(this.started=!0),this.started){var i=j.call(this,t,e);e&(At|$t)&&i[0].length-i[1].length===0&&(this.started=!1),this.callback(this.manager,e,{pointers:i[0],changedPointers:i[1],pointerType:bt,srcEvent:t})}}});var Vt={touchstart:Tt,touchmove:St,touchend:At,touchcancel:$t},Qt="touchstart touchmove touchend touchcancel";c(q,T,{handler:function(t){var e=Vt[t.type],i=F.call(this,t,e);i&&this.callback(this.manager,e,{pointers:i[0],changedPointers:i[1],pointerType:bt,srcEvent:t})}}),c(W,T,{handler:function(t,e,i){var n=i.pointerType==bt,s=i.pointerType==xt;if(n)this.mouse.allow=!1;else if(s&&!this.mouse.allow)return;e&(At|$t)&&(this.mouse.allow=!0),this.callback(t,e,i)},destroy:function(){this.touch.destroy(),this.mouse.destroy()}});var Gt=x(ct.style,"touchAction"),Zt=Gt!==n,Kt="compute",Jt="auto",te="manipulation",ee="none",ie="pan-x",ne="pan-y";U.prototype={set:function(t){t==Kt&&(t=this.compute()),Zt&&(this.manager.element.style[Gt]=t),this.actions=t.toLowerCase().trim()},update:function(){this.set(this.manager.options.touchAction)},compute:function(){var t=[];return r(this.manager.recognizers,function(e){u(e.options.enable,[e])&&(t=t.concat(e.getTouchAction()))}),Y(t.join(" "))},preventDefaults:function(t){if(!Zt){var e=t.srcEvent,i=t.offsetDirection;if(this.manager.session.prevented)return void e.preventDefault();var n=this.actions,s=g(n,ee),o=g(n,ne),r=g(n,ie);return s||o&&i&Ht||r&&i&It?this.preventSrc(e):void 0}},preventSrc:function(t){this.manager.session.prevented=!0,t.preventDefault()}};var se=1,oe=2,re=4,ae=8,le=ae,ce=16,he=32;X.prototype={defaults:{},set:function(t){return a(this.options,t),this.manager&&this.manager.touchAction.update(),this},recognizeWith:function(t){if(o(t,"recognizeWith",this))return this;var e=this.simultaneous;return t=G(t,this),e[t.id]||(e[t.id]=t,t.recognizeWith(this)),this},dropRecognizeWith:function(t){return o(t,"dropRecognizeWith",this)?this:(t=G(t,this),delete this.simultaneous[t.id],this)},requireFailure:function(t){if(o(t,"requireFailure",this))return this;var e=this.requireFail;return t=G(t,this),-1===y(e,t)&&(e.push(t),t.requireFailure(this)),this},dropRequireFailure:function(t){if(o(t,"dropRequireFailure",this))return this;t=G(t,this);var e=y(this.requireFail,t);return e>-1&&this.requireFail.splice(e,1),this},hasRequireFailures:function(){return this.requireFail.length>0},canRecognizeWith:function(t){return!!this.simultaneous[t.id]},emit:function(t){function e(e){i.manager.emit(i.options.event+(e?V(n):""),t)}var i=this,n=this.state;ae>n&&e(!0),e(),n>=ae&&e(!0)},tryEmit:function(t){return this.canEmit()?this.emit(t):void(this.state=he)},canEmit:function(){for(var t=0;t<this.requireFail.length;){if(!(this.requireFail[t].state&(he|se)))return!1;t++}return!0},recognize:function(t){var e=a({},t);return u(this.options.enable,[this,e])?(this.state&(le|ce|he)&&(this.state=se),this.state=this.process(e),void(this.state&(oe|re|ae|ce)&&this.tryEmit(e))):(this.reset(),void(this.state=he))},process:function(){},getTouchAction:function(){},reset:function(){}},c(Z,X,{defaults:{pointers:1},attrTest:function(t){var e=this.options.pointers;return 0===e||t.pointers.length===e},process:function(t){var e=this.state,i=t.eventType,n=e&(oe|re),s=this.attrTest(t);return n&&(i&$t||!s)?e|ce:n||s?i&At?e|ae:e&oe?e|re:oe:he}}),c(K,Z,{defaults:{event:"pan",threshold:10,pointers:1,direction:Dt},getTouchAction:function(){var t=this.options.direction,e=[];return t&Ht&&e.push(ne),t&It&&e.push(ie),e},directionTest:function(t){var e=this.options,i=!0,n=t.distance,s=t.direction,o=t.deltaX,r=t.deltaY;return s&e.direction||(e.direction&Ht?(s=0===o?Et:0>o?Pt:_t,i=o!=this.pX,n=Math.abs(t.deltaX)):(s=0===r?Et:0>r?Ot:Rt,i=r!=this.pY,n=Math.abs(t.deltaY))),t.direction=s,i&&n>e.threshold&&s&e.direction},attrTest:function(t){return Z.prototype.attrTest.call(this,t)&&(this.state&oe||!(this.state&oe)&&this.directionTest(t))},emit:function(t){this.pX=t.deltaX,this.pY=t.deltaY;var e=Q(t.direction);e&&this.manager.emit(this.options.event+e,t),this._super.emit.call(this,t)}}),c(J,Z,{defaults:{event:"pinch",threshold:0,pointers:2},getTouchAction:function(){return[ee]},attrTest:function(t){return this._super.attrTest.call(this,t)&&(Math.abs(t.scale-1)>this.options.threshold||this.state&oe)},emit:function(t){if(this._super.emit.call(this,t),1!==t.scale){var e=t.scale<1?"in":"out";this.manager.emit(this.options.event+e,t)}}}),c(tt,X,{defaults:{event:"press",pointers:1,time:500,threshold:5},getTouchAction:function(){return[Jt]},process:function(t){var e=this.options,i=t.pointers.length===e.pointers,n=t.distance<e.threshold,o=t.deltaTime>e.time;if(this._input=t,!n||!i||t.eventType&(At|$t)&&!o)this.reset();else if(t.eventType&Tt)this.reset(),this._timer=s(function(){this.state=le,this.tryEmit()},e.time,this);else if(t.eventType&At)return le;return he},reset:function(){clearTimeout(this._timer)},emit:function(t){this.state===le&&(t&&t.eventType&At?this.manager.emit(this.options.event+"up",t):(this._input.timeStamp=dt(),this.manager.emit(this.options.event,this._input)))}}),c(et,Z,{defaults:{event:"rotate",threshold:0,pointers:2},getTouchAction:function(){return[ee]},attrTest:function(t){return this._super.attrTest.call(this,t)&&(Math.abs(t.rotation)>this.options.threshold||this.state&oe)}}),c(it,Z,{defaults:{event:"swipe",threshold:10,velocity:.65,direction:Ht|It,pointers:1},getTouchAction:function(){return K.prototype.getTouchAction.call(this)},attrTest:function(t){var e,i=this.options.direction;return i&(Ht|It)?e=t.velocity:i&Ht?e=t.velocityX:i&It&&(e=t.velocityY),this._super.attrTest.call(this,t)&&i&t.direction&&t.distance>this.options.threshold&&pt(e)>this.options.velocity&&t.eventType&At},emit:function(t){var e=Q(t.direction);e&&this.manager.emit(this.options.event+e,t),this.manager.emit(this.options.event,t)}}),c(nt,X,{defaults:{event:"tap",pointers:1,taps:1,interval:300,time:250,threshold:2,posThreshold:10},getTouchAction:function(){return[te]},process:function(t){var e=this.options,i=t.pointers.length===e.pointers,n=t.distance<e.threshold,o=t.deltaTime<e.time;if(this.reset(),t.eventType&Tt&&0===this.count)return this.failTimeout();if(n&&o&&i){if(t.eventType!=At)return this.failTimeout();var r=this.pTime?t.timeStamp-this.pTime<e.interval:!0,a=!this.pCenter||I(this.pCenter,t.center)<e.posThreshold;this.pTime=t.timeStamp,this.pCenter=t.center,a&&r?this.count+=1:this.count=1,this._input=t;var l=this.count%e.taps;if(0===l)return this.hasRequireFailures()?(this._timer=s(function(){this.state=le,this.tryEmit()},e.interval,this),oe):le}return he},failTimeout:function(){return this._timer=s(function(){this.state=he},this.options.interval,this),he},reset:function(){clearTimeout(this._timer)},emit:function(){this.state==le&&(this._input.tapCount=this.count,this.manager.emit(this.options.event,this._input))}}),st.VERSION="2.0.4",st.defaults={domEvents:!1,touchAction:Kt,enable:!0,inputTarget:null,inputClass:null,preset:[[et,{enable:!1}],[J,{enable:!1},["rotate"]],[it,{direction:Ht}],[K,{direction:Ht},["swipe"]],[nt],[nt,{event:"doubletap",taps:2},["tap"]],[tt]],cssProps:{userSelect:"none",touchSelect:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}};var ue=1,pe=2;ot.prototype={set:function(t){return a(this.options,t),t.touchAction&&this.touchAction.update(),t.inputTarget&&(this.input.destroy(),this.input.target=t.inputTarget,this.input.init()),this},stop:function(t){this.session.stopped=t?pe:ue},recognize:function(t){var e=this.session;if(!e.stopped){this.touchAction.preventDefaults(t);var i,n=this.recognizers,s=e.curRecognizer;(!s||s&&s.state&le)&&(s=e.curRecognizer=null);for(var o=0;o<n.length;)i=n[o],e.stopped===pe||s&&i!=s&&!i.canRecognizeWith(s)?i.reset():i.recognize(t),!s&&i.state&(oe|re|ae)&&(s=e.curRecognizer=i),o++}},get:function(t){if(t instanceof X)return t;for(var e=this.recognizers,i=0;i<e.length;i++)if(e[i].options.event==t)return e[i];return null},add:function(t){if(o(t,"add",this))return this;var e=this.get(t.options.event);return e&&this.remove(e),this.recognizers.push(t),t.manager=this,this.touchAction.update(),t},remove:function(t){if(o(t,"remove",this))return this;var e=this.recognizers;return t=this.get(t),e.splice(y(e,t),1),this.touchAction.update(),this},on:function(t,e){var i=this.handlers;return r(v(t),function(t){i[t]=i[t]||[],i[t].push(e)}),this},off:function(t,e){var i=this.handlers;return r(v(t),function(t){e?i[t].splice(y(i[t],e),1):delete i[t]}),this},emit:function(t,e){this.options.domEvents&&at(t,e);var i=this.handlers[t]&&this.handlers[t].slice();if(i&&i.length){e.type=t,e.preventDefault=function(){e.srcEvent.preventDefault()};for(var n=0;n<i.length;)i[n](e),n++}},destroy:function(){this.element&&rt(this,!1),this.handlers={},this.session={},this.input.destroy(),this.element=null}},a(st,{INPUT_START:Tt,INPUT_MOVE:St,INPUT_END:At,INPUT_CANCEL:$t,STATE_POSSIBLE:se,STATE_BEGAN:oe,STATE_CHANGED:re,STATE_ENDED:ae,STATE_RECOGNIZED:le,STATE_CANCELLED:ce,STATE_FAILED:he,DIRECTION_NONE:Et,DIRECTION_LEFT:Pt,DIRECTION_RIGHT:_t,DIRECTION_UP:Ot,DIRECTION_DOWN:Rt,DIRECTION_HORIZONTAL:Ht,DIRECTION_VERTICAL:It,DIRECTION_ALL:Dt,Manager:ot,Input:T,TouchAction:U,TouchInput:q,MouseInput:z,PointerEventInput:B,TouchMouseInput:W,SingleTouchInput:M,Recognizer:X,AttrRecognizer:Z,Tap:nt,Pan:K,Swipe:it,Pinch:J,Rotate:et,Press:tt,on:d,off:f,each:r,merge:l,extend:a,inherit:c,bindFn:h,prefixed:x}),typeof define==ht&&define.amd?define(function(){return st}):"undefined"!=typeof module&&module.exports?module.exports=st:t[i]=st}(window,document,"Hammer");