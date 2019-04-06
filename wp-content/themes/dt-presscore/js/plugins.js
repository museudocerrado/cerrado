/*
 * Isotope v1.5.25
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd otransitionend",transitionProperty:"transitionend"}[j],r=h("transitionDuration"));var s=b.event,t=b.event.handle?"handle":"dispatch",u;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",u&&clearTimeout(u),u=setTimeout(function(){s[t].apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var v=["width","height"],w=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=v.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&w.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return c=c.filter(function(a,b){return b.nodeType===1}),this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){this.$allAtoms=this.$allAtoms.not(a),this.$filteredAtoms=this.$filteredAtoms.not(a);var c=this,d=function(){a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),w.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var x=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){x("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){x("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
/**
 * jquery.dlmenu.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

	// global
	var Modernizr = window.Modernizr, $body = $( 'body' );

	$.DLMenu = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.DLMenu.defaults = {
		// classes for the animation effects
		animationClasses : { animIn : 'dl-animate-in-2', animOut : 'dl-animate-out-2' }
	};

	$.DLMenu.prototype = {
		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.DLMenu.defaults, options );
			// cache some elements and initialize some variables
			this._config();
			
			var animEndEventNames = {
					'WebkitAnimation' : 'webkitAnimationEnd',
					'OAnimation' : 'oAnimationEnd',
					'msAnimation' : 'MSAnimationEnd',
					'animation' : 'animationend'
				},
				transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				};
			// animation end event name
			this.animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ] + '.dlmenu';
			// transition end event name
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.dlmenu',
			// support for css animations and css transitions
			this.supportAnimations = Modernizr.cssanimations,
			this.supportTransitions = Modernizr.csstransitions;

			this._initEvents();

		},
		_config : function() {
			this.open = false;
			this.$trigger = this.$el.find( '#mobile-menu' );
/* ! !changed */
			this.openCap = '<span class="wf-phone-visible">&nbsp;</span><span class="wf-phone-hidden">'+this.$trigger.find( '.menu-open' ).html()+"</span>";
			this.closeCap = '<span class="wf-phone-visible">&nbsp;</span><span class="wf-phone-hidden">'+this.$trigger.find( '.menu-close' ).html()+"</span>";
/* !changed: end */
			this.$menu = this.$el.find( 'ul.dl-menu' );
			this.$menuitems = this.$menu.find( 'li:not(.dl-back)' );
			this.$back = this.$menu.find( 'li.dl-back' );
		},
		_initEvents : function() {

			var self = this;

			this.$trigger.on( 'click.dlmenu', function() {

				if( self.open ) {
					self._closeMenu();
				} 
				else {
					self._openMenu();
					// clicking somewhere else makes the menu close
					$body.off( 'click' ).on( 'click.dlmenu', function() {
						self._closeMenu() ;
					} );
					
				}
				return false;

			} );

			this.$menuitems.on( 'click.dlmenu', function( event ) {
				
				event.stopPropagation();

				var $item = $(this),
					$submenu = $item.children( 'ul.dl-submenu' );

				if( $submenu.length > 0 ) {
					$("html, body").animate({ scrollTop: self.$el.offset().top - 20 }, 150);

					var $flyin = $submenu.clone().insertAfter( self.$menu ).addClass( self.options.animationClasses.animIn ),
						onAnimationEndFn = function() {
							self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.animOut ).addClass( 'dl-subview' );
							$item.addClass( 'dl-subviewopen' ).parents( '.dl-subviewopen:first' ).removeClass( 'dl-subviewopen' ).addClass( 'dl-subview' );
							$flyin.remove();
						};

					self.$menu.addClass( self.options.animationClasses.animOut );

					if( self.supportAnimations ) {
						self.$menu.on( self.animEndEventName, onAnimationEndFn );
					}
					else {
						onAnimationEndFn.call();
					}

					return false;

				}
			} );

			this.$back.on( 'click.dlmenu', function( event ) {

				$("html, body").animate({ scrollTop: self.$el.offset().top - 20 }, 150);

				var $this = $( this ),
					$submenu = $this.parents( 'ul.dl-submenu:first' ),
					$item = $submenu.parent(),


					$flyin = $submenu.clone().insertAfter( self.$menu ).addClass( self.options.animationClasses.animOut );

				var onAnimationEndFn = function() {
					self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.animIn );
					$flyin.remove();
				};

				self.$menu.addClass( self.options.animationClasses.animIn );

				if( self.supportAnimations ) {
					self.$menu.on( self.animEndEventName, onAnimationEndFn );
				}
				else {
					onAnimationEndFn.call();
				}

				$item.removeClass( 'dl-subviewopen' );
				
				var $subview = $this.parents( '.dl-subview:first' );
				if( $subview.is( 'li' ) ) {
					$subview.addClass( 'dl-subviewopen' );
				}
				$subview.removeClass( 'dl-subview' );

				return false;

			} );
			
		},
		_closeMenu : function() {
			var self = this,
				onTransitionEndFn = function() {
					self.$menu.off( self.transEndEventName );
					self._resetMenu();
				};
			
			this.$menu.removeClass( 'dl-menuopen' );
			this.$menu.addClass( 'dl-menu-toggle' );
			this.$trigger.removeClass( 'dl-active' ).html(this.openCap);
			
			if( this.supportTransitions ) {
				this.$menu.on( this.transEndEventName, onTransitionEndFn );
			}
			else {
				onTransitionEndFn.call();
			}

			this.open = false;

/*
			this.$el.css({
				position : "fixed",
				top : ""
			});
*/
		},
		_openMenu : function() {
			this.$menu.addClass( 'dl-menuopen dl-menu-toggle' ).on( this.transEndEventName, function() {
				$( this ).removeClass( 'dl-menu-toggle' );
			} );

			this.$trigger.addClass( 'dl-active' ).html(this.closeCap);
			this.open = true;
			
			$("html, body").animate({ scrollTop: this.$el.offset().top - 20 }, 150);

		},
		// resets the menu to its original state (first level of options)
		_resetMenu : function() {
			this.$menu.removeClass( 'dl-subview' );
			this.$menuitems.removeClass( 'dl-subview dl-subviewopen' );
		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.dlmenu = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'dlmenu' );
				if ( !instance ) {
					logError( "cannot call methods on dlmenu prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for dlmenu instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {	
				var instance = $.data( this, 'dlmenu' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'dlmenu', new $.DLMenu( options, this ) );
				}
			});
		}
		return this;
	};

} )( jQuery, window );
/****************************************************************************************************************************/

 /* !- Tooltip*/  
 function simple_tooltip(target_items, name){
 	jQuery(target_items).each(function(i){
		jQuery("body").append("<div class='"+name+"' id='"+name+i+"'>"+jQuery(this).find('span.tooltip-c').html()+"</div>");
		var my_tooltip = jQuery("#"+name+i);

		jQuery(this).removeAttr("title").mouseover(function(){
					my_tooltip.css({opacity:1, display:"none"}).fadeIn(400);
		}).mousemove(function(kmouse){
				var border_top = jQuery(window).scrollTop();
				var border_right = jQuery(window).width();
				var left_pos;
				var top_pos;
				var offset = 15;
				if(border_right - (offset *2) >= my_tooltip.width() + kmouse.pageX){
					left_pos = kmouse.pageX+offset;
					} else{
					left_pos = border_right-my_tooltip.width()-offset;
					}

				if(border_top + (offset *2)>= kmouse.pageY - my_tooltip.height()){
					top_pos = border_top +offset;
					} else{
					top_pos = kmouse.pageY-my_tooltip.height()-2.2*offset;
					}

				my_tooltip.css({left:left_pos, top:top_pos});
		}).mouseout(function(){
				my_tooltip.css({left:"-9999px"});
		});
	});
}
/********************************************************************************************************************************/
 /* !- Accordion, Toggle*/ 
(function( window, $, undefined ) {
	
	/*
	* smartresize: debounced resize event for jQuery
	*
	* latest version and complete README available on Github:
	* https://github.com/louisremi/jquery.smartresize.js
	*
	* Copyright 2011 @louis_remi
	* Licensed under the MIT license.
	*/

	var $event = $.event;
	var callClick = 0;

		
	$.Accordion 				= function( options, element ) {
	
		this.$el			= $( element );
		// list items
		this.$items			= this.$el.children('ul').children('li');
		// total number of items
		this.itemsCount		= this.$items.length;
		
		// initialize accordion
		this._init( options );
		
	};
	
	$.Accordion.defaults 		= {
		// index of opened item. -1 means all are closed by default.
		open			: -1,
		// if set to true, only one item can be opened. Once one item is opened, any other that is opened will be closed first
		oneOpenedItem	: false,
		// speed of the open / close item animation
		speed			: 600,
		// easing of the open / close item animation
		easing			: 'easeInOutExpo',
		// speed of the scroll to action animation
		scrollSpeed		: 900,
		// easing of the scroll to action animation
		scrollEasing	: 'easeInOutExpo'
    };
	
	$.Accordion.prototype 		= {
		_init 				: function( options ) {
			
			this.options 		= $.extend( true, {}, $.Accordion.defaults, options );
			
			// validate options
			this._validate();
			
			// current is the index of the opened item
			this.current		= this.options.open;
			
			// hide the contents so we can fade it in afterwards
			this.$items.find('div.st-content').hide();
			
			// save original height and top of each item	
			this._saveDimValues();
			
			// if we want a default opened item...
			if( this.current != -1 )
				this._toggleItem( this.$items.eq( this.current ) );
			
			// initialize the events
			this._initEvents();
			
		},
		_saveDimValues		: function() {
		
			this.$items.each( function() {
				
				var $item		= $(this);
				
				$item.data({
					originalHeight 	: $item.find('a:first').height(),
					offsetTop		: $item.offset().top
				});
				
			});
			
		},
		// validate options
		_validate			: function() {
		
			// open must be between -1 and total number of items, otherwise we set it to -1
			if( this.options.open < -1 || this.options.open > this.itemsCount - 1 )
				this.options.open = -1;
	 	
		},
		_initEvents			: function() {
			
			var instance	= this;
			
			// open / close item
			this.$items.find('a:first').bind('click.accordion', function( event ) {
				
				var $item			= $(this).parent();
				
				// close any opened item if oneOpenedItem is true
				if( instance.options.oneOpenedItem && instance._isOpened() && instance.current!== $item.index() ) {
					
					instance._toggleItem( instance.$items.eq( instance.current ) );
				
				}
				
				// open / close item
				instance._toggleItem( $item );				
				
				return false;
			
			});
			instance.$el.find('li').each( function() {
					
				var $this	= $(this);
				$this.css( 'height', $this.data( 'originalHeight' ));
			
			});
			
			$(window).bind('debouncedresize', function( event ) {
				
				// reset orinal item values
				instance._saveDimValues();
			
				// reset the content's height of any item that is currently opened
				instance.$el.find('li').not('.st-open').each( function() {
					
					var $this	= $(this);
					$this.css( 'height', $this.data( 'originalHeight' ));
				
				});
				instance.$el.find('li.st-open').each( function() {
					
					var $this	= $(this);
					$this.css( 'height', $this.data( 'originalHeight' ) + $this.find('div.st-content').outerHeight( true ) );
				
				});
			});
		
			
		},
		// checks if there is any opened item
		_isOpened			: function() {
		
			return ( this.$el.find('li.st-open').length > 0 );
		
		},
		// open / close item
		_toggleItem			: function( $item ) {
			callClick++;
			var instance	= this;
			var $content = $item.find('div.st-content');

			
			( $item.hasClass( 'st-open' ) ) 
					
				? ( this.current = -1, $content.stop(true, true).fadeOut( this.options.speed ), $item.removeClass( 'st-open' ).stop().animate({
					height	: $item.data( 'originalHeight' )
				}, this.options.speed, this.options.easing, function(){	
					if(callClick > 1){
						instance._scroll();
					}
				} ) )
				
				: ( this.current = $item.index(), $content.stop(true, true).fadeIn( this.options.speed ), $item.addClass( 'st-open' ).stop().animate({
					height	: $item.data( 'originalHeight' ) + $content.outerHeight( true )
				}, this.options.speed, this.options.easing, function(){	
					/*if(callClick > 1){
						console.log('call click 2')
						instance._scroll();
					}*/
				} ))
		
		},
		// scrolls to current item or last opened item if current is -1
		//Ф-Я СКРОЛЛ
		_scroll				: function( instance ) {
			
			var instance	= instance || this, current;
			
			( instance.current !== -1 ) ? current = instance.current : current = instance.$el.find('li.st-open:last').index();
			if(window.innerWidth < 760){
				$('html, body').stop().animate({
					scrollTop	: instance.$items.eq( current ).offset().top
				}, instance.options.scrollSpeed, instance.options.scrollEasing );
			}
		
		}
	};
	
	var logError 				= function( message ) {
		
		if ( this.console ) {
			
			console.error( message );
			
		}
		
	};
	
	$.fn.accordion 				= function( options ) {
	
		if ( typeof options === 'string' ) {
		
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
			
				var instance = $.data( this, 'accordion' );
				
				if ( !instance ) {
					logError( "cannot call methods on accordion prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for accordion instance" );
					return;
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
				var instance = $.data( this, 'accordion' );
				if ( !instance ) {
					$.data( this, 'accordion', new $.Accordion( options, this ) );
				}
			});
		
		}
		
		return this;
		
	};
	
})( window, jQuery );

(function( window, $, undefined ) {
	
	/*
	* smartresize: debounced resize event for jQuery
	*
	* latest version and complete README available on Github:
	* https://github.com/louisremi/jquery.smartresize.js
	*
	* Copyright 2011 @louis_remi
	* Licensed under the MIT license.
	*/
	var callClick = 0;
	
	$.Toggle 				= function( options, element ) {
	
		this.$el			= $( element );
		// list items
		this.$items			= this.$el
		// total number of items
		this.itemsCount		= this.$items.length;
		
		// initialize accordion
		this._init( options );
		
	};
	$.Toggle.defaults 		= {
		// index of opened item. -1 means all are closed by default.
		open			: -1,
		// if set to true, only one item can be opened. Once one item is opened, any other that is opened will be closed first
		oneOpenedItem	: false,
		// speed of the open / close item animation
		speed			: 600,
		// easing of the open / close item animation
		easing			: 'easeInOutExpo',
		// speed of the scroll to action animation
		scrollSpeed		: 900,
		// easing of the scroll to action animation
		scrollEasing	: 'easeInOutExpo'
    };
	
	$.Toggle.prototype 		= {
		_init 				: function( options ) {
			
			this.options 		= $.extend( true, {}, $.Toggle.defaults, options );
			
			// validate options
			this._validate();
			
			// current is the index of the opened item
			this.current		= this.options.open;
			
			// hide the contents so we can fade it in afterwards
			this.$items.find('div.st-toggle-content').hide();
			
			// save original height and top of each item	
			this._saveDimValues();
			
			// if we want a default opened item...
			if( this.current != -1 )
				this._toggleItem( this.$items.eq( this.current ) );
			
			// initialize the events
			this._initEvents();
			
		},
		_saveDimValues		: function() {
		
			this.$items.each( function() {
				
				var $item		= $(this);
				
				$item.data({
					originalHeight 	: $item.find('a:first').height(),
					offsetTop		: $item.offset().top
				});
				
			});
			
		},
		// validate options
		_validate			: function() {
		
			// open must be between -1 and total number of items, otherwise we set it to -1
			if( this.options.open < -1 || this.options.open > this.itemsCount - 1 )
				this.options.open = -1;
	 	
		},
		_initEvents			: function() {
			
			var instance	= this;
			
			// open / close item
			this.$items.find('a:first').bind('click.toggle', function( event ) {
				
				var $item			= $(this).parent();
				
				// close any opened item if oneOpenedItem is true
				if( instance.options.oneOpenedItem && instance._isOpened() && instance.current!== $item.index() ) {
					
					instance._toggleItem( instance.$items.eq( instance.current ) );
				
				}
				
				// open / close item
				instance._toggleItem( $item );
				
				return false;
			
			});
			
			instance.$el.each( function() {
					
				var $this	= $(this);
				$this.css( 'height', $this.data( 'originalHeight' ));
			
			});
			$(window).bind('debouncedresize', function( event ) {
				
				// reset orinal item values
				instance._saveDimValues();
			
				// reset the content's height of any item that is currently opened
				instance.$el.not('.st-open').each( function() {
					
					var $this	= $(this);
					$this.css( 'height', $this.data( 'originalHeight' ));
				
				});
				instance.$el.each( function() {
					
					if($(this).hasClass('st-open')){
						var $this	= $(this);
						$this.css( 'height', $this.data( 'originalHeight' ) + $this.find('div.st-toggle-content').outerHeight( true ) );
					}
				});
				
				
				// scroll to current
			});
		
			
		},
		// checks if there is any opened item
		_isOpened			: function() {
		
			return ( this.$el.is('.st-toggle-open').length > 0 );
		
		},
		// open / close item
		_toggleItem			: function( $item ) {
			callClick++;
			var instance	= this;
			var $content = $item.find('div.st-toggle-content');
			
			( $item.hasClass( 'st-open' ) ) 
					
				? ( this.current = -1, $content.stop(true, true).fadeOut( this.options.speed ), $item.removeClass( 'st-open' ).stop().animate({
					height	: $item.data( 'originalHeight' )
				}, this.options.speed, this.options.easing, function(){	
					if(callClick > 1){
						instance._scroll();
					}
				} ) )
				
				: ( this.current = $item.index(), $content.stop(true, true).fadeIn( this.options.speed ), $item.addClass( 'st-open' ).stop().animate({
					height	: $item.data( 'originalHeight' ) + $content.outerHeight( true )
				}, this.options.speed, this.options.easing , function(){	
					if(callClick > 1){
						instance._scroll();
					}
				} ) )
		
		},
		// scrolls to current item or last opened item if current is -1
		_scroll				: function( instance ) {
			
			var instance	= instance || this, current;
			
			( instance.current !== -1 ) ? current = instance.current : current = instance.$el.find('li.st-open:last').index();
			if(window.innerWidth < 760){
				$('html, body').stop().animate({
					scrollTop	: instance.$items.eq( current ).offset().top
				}, instance.options.scrollSpeed, instance.options.scrollEasing );
			}
		
		}
	};
	
	var logError 				= function( message ) {
		
		if ( this.console ) {
			
			console.error( message );
			
		}
		
	};
	
	$.fn.toggle 				= function( options ) {
	
		if ( typeof options === 'string' ) {
		
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
			
				var instance = $.data( this, 'toggle' );
				
				if ( !instance ) {
					logError( "cannot call methods on toggle prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for toggle instance" );
					return;
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
				var instance = $.data( this, 'toggle' );
				if ( !instance ) {
					$.data( this, 'toggle', new $.Toggle( options, this ) );
				}
			});
		
		}
		
		return this;
		
	};
	
})( window, jQuery );
/*********************************************************************************************************************/
 /* !- Tabs*/ 
jQuery(document).ready(function($) { 
	$.fn.goTabs = function (options) {
	    var defaults = {
	        heading: '.tab',
	        content: '.tab-content',
	        active: 'active-tab'
	    };
	    
	    $('.tab-content .tab-inner-content').fadeOut();
	    $('.tab-content.active-tab-content .tab-inner-content').fadeIn();
	    var win = $(window)
	    options = $.extend(defaults, options);
	    return this.each(function () {
	        var container = $(this),
	            tab_titles = $('<div class="nav"></div>').prependTo(container),
	            tabs = $(options.heading, container),
	            content = $(options.content, container),
	            newtabs = false,
	            oldtabs = false;
	        newtabs = tabs.clone();
	        oldtabs = tabs.addClass('fullsize-tab');
	        tabs = newtabs;
	       
	        tabs.prependTo(tab_titles).each(function (i) {
	            var tab = $(this),
	                the_oldtab = false;
	            if (newtabs) the_oldtab = oldtabs.filter(':eq(' + i + ')');
	            tab.addClass('tab-counter-' + i).bind('click', function () {
	                open_content(tab, i, the_oldtab);
	                return false;
	            });
	            if (newtabs) {
	                the_oldtab.bind('click', function () {
	                    open_content(the_oldtab, i, tab);
	                    return false;
	                });
	            }
	        });
	        trigger_default_open();
	       

	        function open_content(tab, i, alternate_tab) {
	            if (!tab.is('.' + options.active)) {
	            	var act_height = content.filter(':eq(' + i + ')').find('.tab-inner-content').outerHeight()/* + parseInt(content.filter(':eq(' + i + ')').find('.tab-inner-content').css('padding-top')) + parseInt(content.filter(':eq(' + i + ')').find('.tab-inner-content').css('padding-bottom'))*/;
	              
	                $('.' + options.active, container).removeClass(options.active);
	                $('.' + options.active + '-content', container).removeClass(options.active + '-content')/*.css({'height': ""})*/.find('.tab-inner-content').css({'height': ""}).fadeOut(400, function(){
	                	
	                var active_t = tab.addClass(options.active);
	            	var active_c = content.filter(':eq(' + i + ')').addClass(options.active + '-content')
	            	active_c.find('.tab-inner-content').fadeIn(400);
	            	if(window.innerWidth < 760){
						$('html, body').stop().animate({
							scrollTop	: active_t.offset().top
						}, 900, 'easeInOutExpo' );
					}
	            		/*var act_height = content.filter(':eq(' + i + ')').find('.tab-inner-content').outerHeight()
	            		content.filter(':eq(' + i + ')').find('.tab-inner-content').css('height',act_height );
	            		var act_height = content.filter(':eq(' + i + ')').find('.tab-inner-content').outerHeight()
	            		active_c.animate({'height': act_height}, 600, 'easeInOutExpo');*/
	            		/*active_c.find('.tab-inner-content').fadeIn(400, function(){
	            			//active_c.find('.tab-inner-content').removeAttr( 'style' );
	            			console.log(active_c.attr('style'))
	            		});*/
	                });

	             /*  if(window.innerWidth < 760){
						$('html, body').stop().animate({
							scrollTop	:  tab.offset().top
						}, 400 );
					}*/
	                var new_loc = tab.data('fake-id');
	               // if (typeof new_loc == 'string') location.replace(new_loc);
	                if (alternate_tab) alternate_tab.addClass(options.active);

	              
	            }

	        }
	       /* function scroll_content ( instance, tab, i, alternate_tab ) {
				
				
				if(window.innerWidth < 760){
					$('html, body').stop().animate({
						scrollTop	: $('.' + options.active, container).last().offset().top
					}, 400 );
				}
				console.log($('.' + options.active, container).last())
			
			}
			$(window).on('load', function( event ) {
				
				scroll_content();
				
			});*/

	        function trigger_default_open() {
	           // if (!window.location.hash) return;
	            var open = tabs.filter('[data-fake-id=""]');
	            if (open.length) {
	                if (!open.is('.active-tab')) open.trigger('click');
	            }
	        }
	    });
	};
});
/*********************************************************************************************************************************/

jQuery(document).ready(function($) {

$.theScroller = function(el, options) {
	var	self = this,
		$el = $(el);
	$el.data("theScroller", self);

	var	isActive = false,
		isScrolling = false,
		threshold = 20,
		contentX = 0,
		contentCurX = 0,
		offsetX, startX, lockX, offsetY, startY, lockY;

	var	elWidth = 0,
		$content = $el.children(),
		contentWidth = 0,
		$slides = $content.children(),
		slidesPosition = [],
		csstransitions = ( typeof Modernizr != "undefined" ) ? Modernizr.csstransitions : false;

	var tempStyle = document.createElement('div').style,
		vendors = ['webkit','Moz','ms','O'],
		vendor = '',
		tempV;

	for (i = 0; i < vendors.length; i++ ) {
		tempV = vendors[i];
		if (!vendor && (tempV + 'Transform') in tempStyle ) {
			vendor = "-"+tempV.toLowerCase()+"-";
		}
	}

	var	tempCSS = {};
		tempCSS[vendor+"user-select"] = "none";
		tempCSS["user-select"] = "none";
	$content.css(tempCSS);


	$slides.each(function(i) {
		slidesPosition[i] = -contentWidth;
		contentWidth = $(this).width() + contentWidth;
	});
	$content.css({"width": contentWidth});

	setUp();

	if(options.prev) {
		options.prev.on("click", function() {
			if (!isScrolling) toPrev();
		});
	}
	if(options.next) {
		options.next.on("click", function() {
			if (!isScrolling) toNext();
		});	
	}


	function transitionStart(coord) {
		if (csstransitions) {
			var	tempCSS = {};
				tempCSS["left"] = coord;
				tempCSS[vendor+"transition"] = "left 150ms ease-out";
				tempCSS["transition"] = "left 150ms ease-out";

			$content.css(tempCSS);
		}
		else {
			$content.animate({
				"left": coord
			}, 150, "linear");
		};
	};

	function transitionStop() {
		if (csstransitions) {
			var	tempCSS = {};
				tempCSS[vendor+"transition"] = "none";
				tempCSS["transition"] = "none";
	
			$content.css(tempCSS);
		};
	};

	function time() {
		return (new Date()).getTime();
	}

	function unifiedEvent(event) {
		if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
			event.pageX = event.originalEvent.touches[0].pageX;
			event.pageY = event.originalEvent.touches[0].pageY;
		}
		return event;
	}

	function setNav() {

		if (contentX <= -contentWidth + elWidth) {
			rightMost();
			notLeftMost();
		}
		else if (contentX >= 0) {
			leftMost();
			notRightMost();
		}
		else {
			notRightMost();
			notLeftMost();
		};
	}

	function setUp() {
		unbindEvents();
		elWidth = $el.width();

		if (elWidth > contentWidth) {
			isActive = false;
			$content.css({
				left: (elWidth - contentWidth)/2
			});
			contentX = 0;
			rightMost();
			leftMost();

			return false;
		}

		isActive = true;
		if (contentX <= -contentWidth + elWidth) contentX = -contentWidth + elWidth;
		setNav();
		$content.css({
			"left": contentX
		});

		bindEvents();
	};

	function onStart(event) {
		if (!isScrolling) {
			transitionStop();

			isScrolling = true;
			startX = event.pageX;
			startY = event.pageY;
			contentX = $content.position().left;

			offsetX = 0;
			offsetY = 0;
			lockX = false;
			lockY = false;
		}
	};

	function onScroll(event) {
		if (isScrolling) {
			offsetX = event.pageX - startX;
			offsetY = event.pageY - startY;

			if ( (Math.abs(offsetX) >= threshold-1) && (Math.abs(offsetX) > Math.abs(offsetY)) && !lockX ) {
				lockX = false;
				lockY = true;
				if (event.type == "touchmove") offsetY = 0;
			} else if( (Math.abs(offsetY) >= threshold-1) &&  (Math.abs(offsetX) < Math.abs(offsetY)) && !lockY ) {
				lockX = true;
				lockY = false;
				if (event.type == "touchmove") offsetX = 0;
			};

			if (lockX && event.type == "touchmove") offsetX = 0;
			else if (lockY && event.type == "touchmove") offsetY = 0;

			if (lockY) event.preventDefault();

			contentCurX = contentX + offsetX;
			if ( contentCurX < 0 && contentCurX > -contentWidth + elWidth) {
				$content.css({
					"left": contentCurX
				});
			}
			else if (contentCurX >= 0) {
				$content.css({
					"left": contentCurX/4
				});
			}
			else {
				$content.css({
					"left": (-contentWidth + elWidth) + ((contentWidth - elWidth + contentCurX) / 4)
				});
			};

		};
	};

	function onStop(event) {
		if (isScrolling) {
			isScrolling = false;
	
			if (contentCurX > 0) {
				contentX = 0;
				transitionStart(contentX);
			}
			else if ( contentCurX <= -contentWidth + elWidth ) {
				contentX = -contentWidth + elWidth
				transitionStart(contentX);
			}
			else {
				$slides.each(function(i) {
					if ( contentCurX > slidesPosition[i] ) {
						if (offsetX < -threshold) {
							contentX = !(slidesPosition[i] <= -contentWidth + elWidth) ? slidesPosition[i] : -contentWidth + elWidth;
						}
						else if(offsetX > threshold) {
							contentX = slidesPosition[i-1]
						}
						else {
							contentX = contentX;
						}
						
						transitionStart(contentX);

						return false;
					};
				});
			};

		}
		setNav();
		return false;
	};

	function bindEvents() {
		$content.on("mousedown.theScroller touchstart.theScroller", function(event) {

			if (event.type != "touchstart") event.preventDefault();

			onStart( unifiedEvent(event) );

			$(document).on("mousemove.theScroller touchmove.theScroller", function(event) {
				onScroll( unifiedEvent(event) );
			});

			$(document).on("mouseup.theScroller mouseleave.theScroller touchend.theScroller touchcancel.theScroller", function(event) {
				$(document).off("mousemove.theScroller mouseup.theScroller mouseleave.theScroller touchmove.theScroller touchend.theScroller touchcancel.theScroller");
				onStop( unifiedEvent(event) );
			});

		});
	};

	function unbindEvents() {
		$content.off();
	};

	function rightMost() {
		if(options.next) {
			options.next.addClass("disabled");
		}
	};

	function leftMost() {
		if(options.prev) {
			options.prev.addClass("disabled");
		}
	};

	function notRightMost() {
		if(options.next) {
			options.next.removeClass("disabled");
		}
	};

	function notLeftMost() {
		if(options.prev) {
			options.prev.removeClass("disabled");
		}
	};

	function toNext() {
		if (!isActive) return false;

		isScrolling = true;
		contentCurX = $content.position().left;
		offsetX = - threshold - 1;

		onStop();
	};

	function toPrev() {
		if (!isActive) return false;

		isScrolling = true;
		contentCurX = $content.position().left + 1;
		offsetX = threshold + 1;

		onStop();
	};

	self.update = function() {
		if(!isScrolling) setUp(); /* Fixes bug with "resize" event triggering in Safari 6 on iPhone; probably causes other bugs :P */
	};
};

$.fn.theScroller = function(options) {
	return this.each(function() {
		( new $.theScroller(this, options) );
	});
};


});

 /*3D slideshow*/
 jQuery(document).ready(function($){
	if ( $('.three-d-slider').length > 0){
		var GiveMoreSpace = 1.3;
		if( $('#main-slideshow').hasClass('fixed') ){
			var ratioFix = $('.three-d-slider').attr('data-height')/$('.three-d-slider').attr('data-width');
			var thisH = $('.three-d-slider').css('height'),
				main = $('.three-d-slider').css("height", $('.three-d-slider').width() * (ratioFix) ).addClass('slide-me');
				//$('.three-d-slider-content').css("height", $('.three-d-slider').width() * (ratioFix) );
			var fixW = $('.three-d-slider').width();
		}else if( $('#main-slideshow').hasClass('fixed-height') ){
			var ratioFix = $('.three-d-slider').attr('data-height')/$('.three-d-slider').attr('data-width');
			var thisH = $('.three-d-slider').css('height'),
				main = $('.three-d-slider').css("height", $('.three-d-slider').width() * (ratioFix) ).addClass('slide-me');
			var fixW = $('.three-d-slider').width();
		}else{
			if($('.boxed').length > 0){
				var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
			}else{
				var boxedM = 0;
			}
			var main = $('.three-d-slider').css({'height': $(window).height() - $('#header').height() + $('#header.overlap').height() - boxedM - $('#wpadminbar').height() - boxedM - $('#top-bar').height()}).addClass('slide-me');	
		}
		var loading = $('#loading'),	
			main_left = main.offset().left,
			main_top = main.offset().top,
			windowH = main.height(),
			windowW = main.width(),
			ratio = windowW/windowH,
			CellSize = 300,
			Plane1 = $('div#level1 img'),
			img_numb1 = Plane1.length,
			Plane2 = $('div#level2 img'),
			Plane3 = $('div#level3 img'),
			//closeX = $('.close'),
			scale = [0.14, 0.23, 0.35],
			IEsc = [1,1,1], //consider scale if browser is IE
			indexZ = [3, 6, 9],
			speedZ = 1000,
			$hovered,
			$corner_w = 3,
			$corner_l = 30,
			corner_color = "#ffffff",
			hover_color = "rgba(0, 0, 0, .35)",
			layer_time = 700,
			t0 = 850,
			tscr = 500,
			tdel = 100,
			n = [],
			m = [],
			Plane = [Plane1,Plane2,Plane3],
			length = Plane.length,
			Container =[],	 // array of canvas containers
			allowParallax = length,
			useNavig = 0,
			AnimDelay = 0,
			AntiStumble = 0,
			timer1,timer2,timer3,timer4,timer5,timer6,timer7,
			isLightbox = 0,
			loaded_imgs=0,
			total = $('.plane img').length; //parallax animation is initially allowed

			if( $('#main-slideshow').hasClass('fixed') ){
				
				var newWidth,
					newHeight;
				var fixedW = fixW;
							
				$(window).on('resize', function(){
					var asw = $('.three-d-slider').attr('data-width'),
						ash = $('.three-d-slider').attr('data-height');
						newWidth = $('.three-d-slider').width();
						
						if(newWidth != fixedW) {
							var main = $('.three-d-slider').css("height", newWidth * (ash / asw) ).addClass('slide-me');
							newWidth = $('.three-d-slider').width();
						}else{
							main = $('.three-d-slider').css("height", $('.three-d-slider').width() * (ratioFix) ).addClass('slide-me');
						}
					
				});
			}else if( $('#main-slideshow').hasClass('fixed-height') ){
				var newWidth,
					newHeight;
				var fixedW = fixW;
						
				$(window).on('resize', function(){
					var asw = $('.three-d-slider').attr('data-width'),
						ash = $('.three-d-slider').attr('data-height');

						newWidth = $('.three-d-slider').width();
						
						if(newWidth != fixedW) {
							var main = $('.three-d-slider').css("height", newWidth * (ash / asw) ).addClass('slide-me');
							newWidth = $('.three-d-slider').width();
						}else{
							main = $('.three-d-slider').css("height", $('.three-d-slider').width() * (ratioFix) ).addClass('slide-me');
						}
					
				});
			}else{
				$(window).on('resize', function(){	
					if($('.boxed').length > 0){
						var boxedM = parseInt($('#page.boxed').css('margin-bottom'));
					}else{
						var boxedM = 0;
					}		
					var main = $('.three-d-slider').css({'height': $(window).height() - $('#header').height() + $('#header.overlap').height() - boxedM - $('#wpadminbar').height() - boxedM - $('#top-bar').height()}).addClass('slide-me');	
				});
			}
			
		var main_left = main.offset().left,
			main_top = main.offset().top;
		// Image Loaded - the jQuery plugin, that checks if the image is loaded
		function imageLoaded(el, callback){
			var $_this = el;
			var timer  = setInterval(function(){
				if($_this.complete == true) {
					clearInterval(timer);
					callback.call($_this);
				}
			},200);
			return $_this;
		};
		
		//CSS3 transition depending on browser
			var vP = ""; // What browser is being used
			var transSupport =''; //To check whether CSS3 transitions are supported
		if ($.browser.webkit) { // Find the transition prefix depending on browser 
			vP = "-webkit-";
			transSupport = 'Webkit';
		} else if ($.browser.msie) {
			vP = "-ms-";
			transSupport = 'ms';
		} else if ($.browser.mozilla) {
			vP = "-moz-";
			transSupport = 'Moz';
		} else if ($.browser.opera) {
			vP = "-o-";
			transSupport = 'O';
		}

		//CSS3 transition detection
		function supportsTransforms() {
			var b = document.body || document.documentElement;
			var s = b.style;
			var pp = 'transform';
			if(typeof s[pp] == 'string') {return true; }
			
			pp = pp.charAt(0).toUpperCase() + pp.substr(1);
			  if(typeof s[transSupport + pp] == 'string') { return true; }
			return false;
		}
		
		function supportsTransitions() {
			var b = document.body || document.documentElement;
			var s = b.style;
			var pp = 'transition';
			if(typeof s[pp] == 'string') {return true; }
			
			pp = pp.charAt(0).toUpperCase() + pp.substr(1);
			  if(typeof s[transSupport + pp] == 'string') { return true; }
			return false;
		}
		
		var smart = supportsTransitions()*supportsTransforms(),
			TrasitDur = vP+"transition-duration",
			TrasitDel = vP+"transition-delay",
			Transform = vP+"transform"; 
		
		function EasyReposition(){
			windowH = main.height();
			windowW = main.width();
			ratio = windowW/windowH;
			AnimateLayersBunch (0.5*windowW, 0.5*windowH);
			
		}
		
		function TotalReposition(){
			windowH = main.height();
			windowW = main.width();
			ratio = windowW/windowH;
			ResizePlanes();
		}
		
		function AddPaddings (n_m, H_W) {
			if(CellSize*n_m*scale[length-1]<H_W) {
					var newH_W = Math.round((H_W+0.5*CellSize)/scale[length -1]),
					newPadding = Math.round(0.5*(newH_W-CellSize*n_m));
				} else {
					var newH_W = Math.round(CellSize*n_m+0.5*CellSize/scale[length -1]),
					newPadding = Math.round(0.25*CellSize/scale[length -1]);
				}
			return [newH_W, newPadding];
		}
		
		function ResizePlanes() { 
			for (var i=0;i<length;i++) {
				var ReadyImgs = ReadyCanavas(i);
				n[i] = PlaneSide(ReadyImgs,ratio).n;
				m[i] = PlaneSide(ReadyImgs,ratio).m;
				
				var newNM = PositionImage(ReadyImgs, CreateMatrix (0,m[i],0,n[i]), 0, 0, n[i], m[i]);
				m[i] = newNM[0];
				n[i] = newNM[1];
				
				Container[i].ind = i; // set initial order of layers
				
				var vertical = AddPaddings (n[i], windowH),
					horizontal = AddPaddings (m[i], windowW),
					ReadyImgsLng = ReadyImgs.length;
					Container[i].Wo = horizontal[0];
					Container[i].Ho = vertical[0];
				for (var index=0;index<ReadyImgsLng;index++) {
					var $img = $(ReadyImgs[index]), 
						top = parseFloat($img.css("top")),
						left = parseFloat($img.css("left"));
					$img.css({"top":top+vertical[1],"left":left+horizontal[1]});
				}
				Container[i].Scale = 1; 
				$(Container[i]).css({"width":Container[i].Wo, "height": Container[i].Ho});
				if (!smart) {
					IEsc[i] = scale[i]; //consider scale if browser is IE
					Container[i] = ScaleIE(scale[i], Container[i], 0);
				}
			}	
			AnimateLayersBunch (0.5*windowW, 0.5*windowH); 
			allowParallax = length;
			return Container;
		}
		
		function SwitchDarkLayers(){
			for (var i=0;i<DarkLayers.length;i++){	
				$(DarkLayers[i]).toggleClass('toBG');	
			}
			return DarkLayers;
		}
		
		function PlaneSide(realImages, proportion) {
			var	TotalImgArea = 0,
				img_numb = realImages.length;
			//Calculate the summ of images areas
			for (var i=0;i<img_numb;i++){
				TotalImgArea += realImages[i].width*realImages[i].height+2*CellSize*CellSize;
			}
			//approx container size when images are not scaled
			var W0 = GiveMoreSpace*Math.sqrt(proportion*TotalImgArea),
				H0 = W0/proportion,
			//split container width hand height into integer number of cells. Enlarge Wo and Ho if required
				m = Math.ceil(W0/CellSize),
				n = Math.ceil(H0/CellSize);
				
				return {"n":n,"m":m};
		}
		
		function createContainers(planes) {
			var CanvasArray ='<div class="close"></div><div class="dark-layer l2"></div><div class="dark-layer l1"></div><div class="img-caption"><p></p></div><div class="navig"><div class="act">1</div><div>2</div><div>3</div></div>',
				corner;
			if (smart) {
				corner = '<canvas class="corners"></canvas>';
			} else {
				corner = '<span class="top-l"></span><span class="top-r"></span><span class="bottom-l"></span><span class="bottom-r"></span>';
			} 
			for (var k=0; k<length; k++) {
				//dealing with a single plane
				CanvasArray += '<div class="container-'+(k+1)+' container" >';
				var plane_lngth = planes[k].length;
				for (var i=0; i<plane_lngth; i++) {
					if ($('<canvas></canvas>')[0].getContext) {	
						var newImg = '<canvas class="photo"></canvas>';
					} else {
						var newImg = '<img class="photo" />';
					}
					CanvasArray += newImg;
				}
				CanvasArray +='<div class="dark-layer"></div>'+corner+'</div>';	
			}
			main.append(CanvasArray); 
			closeX = $('.close');
			dark_layer1 = $('.l1');
			dark_layer2 = $('.l2');
			caption = $('.img-caption');
			caption_text = caption.children('p');
			navig = $('.navig');
			navig.css('top',Math.round(0.5*(windowH-navig.height())));
			return $('div.container'); 
		}
		
		function drawCanvas (planes, container) {
			for (var k=0; k<length; k++) {
				var ReadyImgs = ReadyCanavas(k); 
				//dealing with a single plane
				var ReadyImgsLngth = ReadyImgs.length;
				for (var i=0; i<ReadyImgsLngth; i++) {
					var real_img = planes[k][i],
						img_width = $(real_img).width(),
						img_height = $(real_img).height();
					ReadyImgs[i].width=img_width;
					ReadyImgs[i].height=img_height;
					if ($('<canvas></canvas>')[0].getContext) {
						var context = ReadyImgs[i].getContext("2d");
						context.drawImage(real_img,0,0,img_width,img_height);
					} else {
						$(ReadyImgs[i]).attr("src",$(real_img).attr("src"));
					}
					$(ReadyImgs[i]).attr("alt", real_img.alt);
					$(ReadyImgs[i]).getCanvasSize();
				}
			}
		}
		
		$.fn.getCanvasSize = function () {
				var $self=$(this),
				w = Math.ceil($self.width()/CellSize),
				h = Math.ceil($self.height()/CellSize);
				$self.data({
					"wCanvas" : w,
					"hCanvas" : h,
					"deviationX": Math.floor((w*CellSize-$self.width())*Math.random()), // devialtion of left position
					"deviationY": Math.floor((h*CellSize-$self.height())*Math.random()) // deviation of top position
				});
			}
		
		function Launch() {
			clearInterval(timer7);
			loading.css("display", "none");
	//		$('.layers-navig').css("display", "block");
			Container = createContainers(Plane);
			drawCanvas(Plane, Container);
			$('.plane').remove();
			//calculate size and scale for all planes 
			ResizePlanes();
			DarkLayers=$('.dark-layer');	
			if (!smart) {
				closeX.css("display","none"); //to apply fadeIn then
				caption.css("display","none")
			} else {
				$corner_w = Math.round($corner_w/scale[length-1]);
				$corner_l = Math.round($corner_l/scale[length-1]);
			}	
			
			//start animation only in case all containers are positioned
			if ($(Container[length-1]).width())
				{ 
					/*animate the top container and position the rest of layers according to its position*/
					main.on('click',function(ev){
						if (allowParallax == length) { 
							var targ = FindOnClickImage(Container, ev);
							if (targ) Container = $(targ).BringToTheFront();						
						}
					});
			}	
			
			main.on('mousemove',function(ex){ 
				AnimateLayersBunch(ex.pageX, ex.pageY);
			});
			
			$('.photo').on('click', function() {
				if($(this).parent(".container")[0] == Container[length-1]) // necessary for IE: it has all layers clickable
				ViewImg($(this));
			});
			
			$('.photo').not('.top-slice').on('mouseenter', function(evnt) {
				$hovered = $(evnt.target);
				if(($hovered.parent(".container")[0] == Container[length-1])&&(!$hovered.hasClass('top-slice'))) { // necessary for IE: it has all layers clickable
					if (smart) {	
						var $c_w = $hovered.width()+2*$corner_w,
							$c_h= $hovered.height()+2*$corner_w,
							$c_l = parseFloat($hovered.css("left"))-$corner_w,
							$c_t = parseFloat($hovered.css("top"))-$corner_w,
						
						corners = $hovered.siblings(".corners").css({
								"left": $c_l,
								"top": $c_t
						});
							
						
						corners[0].width=$c_w;
						corners[0].height=$c_h;
						var ctx=corners[0].getContext("2d");
						ctx.clearRect(0, 0, $c_w, $c_h);
						ctx.fillStyle = hover_color;
						ctx.fillRect($corner_w, $corner_w, $c_w-2*$corner_w, $c_h-2*$corner_w);
						ctx.beginPath();
						ctx.strokeStyle = corner_color;
						ctx.lineWidth = $corner_w;
						ctx.lineCap = "square";
						ctx.moveTo(0.5*$corner_w,$corner_l);
						ctx.lineTo(0.5*$corner_w,0.5*$corner_w);
						ctx.lineTo($corner_l,0.5*$corner_w);
						
						ctx.moveTo($c_w-$corner_l,0.5*$corner_w);
						ctx.lineTo($c_w-0.5*$corner_w,0.5*$corner_w);
						ctx.lineTo($c_w-0.5*$corner_w,$corner_l);
						
						ctx.moveTo($c_w-0.5*$corner_w,$c_h-$corner_l);
						ctx.lineTo($c_w-0.5*$corner_w,$c_h-0.5*$corner_w);
						ctx.lineTo($c_w-$corner_l,$c_h-0.5*$corner_w);
						ctx.stroke(); 
						
						ctx.moveTo($corner_l,$c_h-0.5*$corner_w);
						ctx.lineTo(0.5*$corner_w,$c_h-0.5*$corner_w);
						ctx.lineTo(0.5*$corner_w,$c_h-$corner_l);
						ctx.stroke(); 	
						return false;
					} else {
						var $span_t_l = $hovered.siblings('.top-l'),
						$span_b_l = $hovered.siblings('.bottom-l'),
						$span_t_r = $hovered.siblings('.top-r'),
						$span_b_r = $hovered.siblings('.bottom-r'),
						$l = parseFloat($hovered.css("left")),
						$t = parseFloat($hovered.css("top")),
						$w = $hovered.width(),
						$h = $hovered.height();				
						$span_side = $corner_l - $corner_w;
						$span_t_l.css({"opacity":0.7,"left":$l,"top":$t});
						$span_b_l.css({"opacity":0.7,"left":$l,"top":$t+$h-$span_side});
						$span_t_r.css({"opacity":0.7,"left":$l+$w-$span_side,"top":$t});
						$span_b_r.css({"opacity":0.7,"left":$l+$w-$span_side,"top":$t+$h-$span_side});
					
						$hovered.on('mouseleave', function() {
							$span_t_l.css("opacity",0);
							$span_b_l.css("opacity",0);
							$span_t_r.css("opacity",0);
							$span_b_r.css("opacity",0);
						});
					
					}
				}
				
			});
			
			$('.corners').on('click',function(){
				ViewImg($hovered);
			});
			
			navig.children('div').on('click',function(){
				LayersNavig($(this));
			});
					
			function LayersNavig($ths) {
				if ((allowParallax == length) && (!$ths.hasClass('act'))) { 
					useNavig = length;
					var actind = length - navig.children('.act').index(),
					curind = length- $ths.index(),
					difr = length-1-actind;
					navig.children('.act').removeClass('act');
					$ths.addClass('act');
					Container = $(Container[(curind+difr)%length]).BringToTheFront();
				}
			}
			
			$(window).resize(function() {
				navig.css('top',Math.round(0.5*(windowH-navig.height())));
				if(!isLightbox) {
					if (smart){
						TotalReposition();
						return true; 
					}
					EasyReposition();
				}
			});
			
		}
		
		function ReadyCanavas(i) {
			return $(Container[i]).children('.photo');
		}
		
		function ViewImg($IMG) { 
			if (!$IMG.hasClass('show') && ($('.top-slice').length == 0)) { //first click - to open lightbox
				isLightbox = 1;
				allowParallax = 0;
				inImW = $IMG.width();
				inImH = $IMG.height();
				inImT = parseFloat($IMG.css("top"));
				inImL = parseFloat($IMG.css("left"));
				$parent = $IMG.parent();
				sc = scale[length-1];
				inScale = scale[$parent[0].ind];
				$dark_bg = $IMG.siblings('.dark-layer').addClass('l3');	
							
				var parentT = parseFloat($parent.css("top")),	
					parentL = parseFloat($parent.css("left")),
					parentW = $parent[0].Wo,
					parentH = $parent[0].Ho,
					parentTrasitDur = $parent.css(TrasitDur);
					main.addClass('lightbox');
					
				$IMG.addClass('show top-slice');/*.css(TrasitDur,parentTrasitDur)*/;
				ImgFitScreen($IMG, inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg); //display the image in lightbox. If the image is too large, downscale 	
				if (smart) { 
					$dark_bg.css({"width":windowW, "height": windowH, 
								"left": Math.round((0.5*(parentW-windowW)*(inScale-1)-parentL)/inScale), 
								"top": Math.round((0.5*(parentH-windowH)*(inScale-1)-parentT)/inScale)
					});
				} else {
					$IMG.siblings('span').css("opacity",0);
					$dark_bg.css({"width":windowW, "height": windowH, 
						"left":	Math.round(-parentL-0.5*(1-sc/inScale)*parentW), 
						"top": Math.round(-parentT-0.5*(1-sc/inScale)*parentH),
						"display":"none"
					});
				}
				$(window).resize(function() {
					if (isLightbox && smart) {
						EasyReposition();
						parentT = parseFloat($parent.css("top"));	
						parentL = parseFloat($parent.css("left"));
						ImgFitScreen($('.show.top-slice'), inImW, inImH, sc, inScale, parentW, parentH, parentL, parentT, $dark_bg);	//otherwise, it caches all IMGs
					}
				});
				
				closeX.on('mouseover', function(){
					closeX.addClass('hovered'); //remove delay of opacity animation
				})
				closeX.on('click', function() { // 'close' button is pressed
					ViewImg($IMG)
				}); 
				$(document).keyup(function(e) {
					if (e.keyCode == 27) ViewImg($IMG);   // ESC is pressed
				});
				return true;
					
			} else if ($IMG.hasClass('show') && (Container.length == length)) { //second click - to close lightbox
				main.removeClass("lightbox");
				closeX.removeClass('hovered'); // add delay of opacity animation
				$IMG.siblings(".dark-layer").removeClass('l3'); 
				/*put the image back to its initial position*/
				if (smart) { 
					$IMG.removeClass('show').css({"left": Math.round(inImL), "top": Math.round(inImT), "maxWidth": "none", "maxHeight": "none"});
				} else { 
					$IMG.removeClass('show').animate({
						"left": Math.round(sc*inImL/inScale), "top": Math.round(sc*inImT/inScale), 
						"width":Math.round(sc*inImW/inScale), "height":Math.round(sc*inImH/inScale)}, 400)
						.css({"maxWidth": "none", "maxHeight": "none"});
					closeX.fadeOut();
					$dark_bg.fadeOut();
					caption.fadeOut();
				}
					timer1 = setTimeout(function() { 
						$IMG.removeClass('top-slice');
						allowParallax = length; // important. It is possible to unclick an image while container still are being reordered 
						isLightbox = 0;
						AntiStumble = 1;
						main.removeClass('scale-me').addClass('slide-me');
						
					}, 400);
				return true;	
			}
			
		}
		
		function ImgFitScreen($Img, InImW, InImH, sc, InScale, ParentW, ParentH, ParentL, ParentT, $darkbg) {
			var $w, $h,
			closeX_left = 30,
			ifsmart=smart+!smart*InScale;
			if ((InImW/ifsmart>windowW)||(InImH/ifsmart>(windowH-110))) { //if image does not fit in the window
				if ((InImW/InImH)>(windowW/windowH)) { // if image is wider than the window
					var maxW = windowW-2*closeX.width(),
						maxH = Math.round((windowW-2*closeX.width())*InImH/InImW);
					closeX_left = 0.5*closeX.width();
				} else {
					var maxW = Math.round((windowH-110)*InImW/InImH),
						maxH = windowH-110;
				}
				$Img.css({"maxHeight": maxH, "maxWidth": maxW});//do not use "auto" because of Opera
				$w = maxW*ifsmart;
			  	$h = maxH*ifsmart;
			} else {
			  	$w = InImW;
			  	$h = InImH;
			}
			
			if (smart) { 
				$Img.css({
				  "left": Math.round(0.5*(windowW-$w*sc-2*ParentL-ParentW*(1-sc))/sc), 
				  "top": Math.round(0.5*(windowH-$h*sc-2*ParentT-ParentH*(1-sc))/sc)
				});
			} else {
				$Img.animate({
					"left":	Math.round(-ParentL-0.5*(1-sc/InScale)*ParentW+0.5*(windowW-$w/InScale)), 
					"top": Math.round(-ParentT-0.5*(1-sc/InScale)*ParentH+0.5*(windowH-$h/InScale)),
					"width": Math.round(($w/InScale)),
					"height": Math.round(($h/InScale))
				}, 850,function(){closeX.delay(700).fadeIn(400);
					$darkbg.delay(700).fadeIn(400);
					caption.delay(700).fadeIn(400);
				});		 
			}	
			
			caption.css("top",Math.round(0.5*(windowH+$h/(smart+!smart*InScale))));	
			caption_text.text($Img.attr('alt'));	
			closeX.css({"top":Math.round(0.5*(windowH-$h/(smart+!smart*InScale))), 
						"left": Math.round(0.5*$w/(smart+!smart*InScale)+closeX_left)
			});
			return $Img;
		}
		
		function ScaleIE (scale, plane, time){
			var newscale = scale/plane.Scale;
			plane.Scale = scale;
			var inContW = plane.Wo,
				inContH = plane.Ho,
				inContT = parseFloat($(plane).css("top")),
				inContL = parseFloat($(plane).css("left")),
				images = $(plane).children('.photo'),
				ieW = Math.round(newscale*inContW),
				ieH = Math.round(newscale*inContH);
				
				//if ($(plane).index('.container') == 1) console.log('top-prev:',inContT ,/*', new-scale:', plane.Scale,' newscale:', newscale,*/' new width:',Math.round(inContT+0.5*(1-newscale)*inContH));
			$(plane).animate({
				"width": ieW,
				"height": ieH,
				"top": Math.round(inContT+0.5*(1-newscale)*inContH),
				"left": Math.round(inContL+0.5*(1-newscale)*inContW)
			}, time);
			
			//for correct AnimateLayersBunch functioning
			plane.Wo = ieW;
			plane.Ho = ieH;
			var images_length = images.length;
			for (var j=0;j<images_length;j++){
				
				var inImW = parseFloat($(images[j]).css("width")), //.css('width') instead of .width() - to satisfy both IE8 and IE9
					inImH = parseFloat($(images[j]).css("height")),
					inImT = parseFloat($(images[j]).css("top")),
					inImL = parseFloat($(images[j]).css("left"));
			
				if (!$(images[j]).hasClass('show')) {	
					$(images[j]).animate({
						"width": Math.round(newscale*inImW),
						"height": Math.round(newscale*inImH),
						"top": Math.round(newscale*inImT),
						"left": Math.round(newscale*inImL)
					}, time); 
				} 
			}
			return plane;
		}
		
		
		
		function AnimateLayersBunch (epageX, epageY) {	
			if (allowParallax != length)  return false;//do not animate layers parallax while BringToTheFront is working
			epageX -= main_left;
			epageY -= main_top;
			var  RatioX = epageX/windowW,
			RatioY = epageY/windowH,
			k = length-1,
			Left = (RatioX-0.5)*(1-scale[k]/IEsc[k])*Container[k].Wo-RatioX*(Container[k].Wo-windowW),
			Top = (RatioY-0.5)*(1-scale[k]/IEsc[k])*Container[k].Ho-RatioY*(Container[k].Ho-windowH);
			//main.removeClass('scale-me').addClass('slide-me'); 
			for (var s=0; s<k; s++) { 
				var L = scale[s]/IEsc[k]*(Left+0.5*(IEsc[s]*Container[s].Wo-windowW))-0.5*(IEsc[s]*Container[s].Wo-windowW)	,
					T = scale[s]/IEsc[k]*(Top+0.5*(IEsc[s]*Container[s].Ho-windowH))-0.5*(IEsc[s]*Container[s].Ho-windowH);
				if (!AntiStumble) {
					$(Container[s]).css({"left": Math.round(L), "top" : Math.round(T)});
				} else {
					allowParallax = 0;
					$(Container[s]).animate({"left": Math.round(L), "top" : Math.round(T)},120, 'linear');
				}
			}
				if (!AntiStumble) {
					$(Container[k]).css({"left": Math.floor(Left), "top" : Math.floor(Top)});
				} else { 					
					$(Container[k]).animate({"left": Math.floor(Left), "top" : Math.floor(Top)}, 120, 'linear', function() {AntiStumble = 0; allowParallax = length});
				}
				
		}
					
		$.fn.BringToTheFront = function() { 
			if (!useNavig) {
				var $this = $(this),
					$self = $this.parent('.container');
					ViewImg($this);
			} else {
				var $self = $(this);
				AnimateLayersBunch(0.5*windowW,0.5*windowH);
			}allowParallax = 0;
				var current = $self[0].ind,
				 	dif = length - 1 - current,
					reOrderCont = [];				
				//if (!useNavig)  
				if (smart) main.addClass('scale-me').removeClass('slide-me');
				
				for (var i=0;i<current+1;i++) {
					var ind = (i+dif)%length,
					duration = (ind - i)*layer_time;
					reOrderCont[ind] = OnlyToFront(Container[i], scale[ind], indexZ[ind], duration);	
					reOrderCont[ind].ind = ind;
					if (useNavig) {	
						timer2 = setTimeout(function() { 
							allowParallax++;
							useNavig--;
						}, 1.25*(duration-layer_time));
					}
				}
				
				for (var ii=current+1;ii<length;ii++) {
					var ind = (ii+dif)%length,
					durBefore = (length - 1 - ii)*layer_time,
					durAfter = (ind)*layer_time;
					reOrderCont[ind] = ToFrontAndBack(Container[ii], scale[ind], indexZ[ind], durBefore, durAfter);					
					reOrderCont[ind].ind = ind;
					if (useNavig) {	
						timer3 = setTimeout(function() { 
							allowParallax++;
							useNavig--;
							Math.floor(allowParallax/length)*main.removeClass('scale-me').addClass('slide-me');
						}, durBefore+tscr+tdel+300+durAfter+t0);
					}
				}
			return reOrderCont;
		} 	
		
		function OnlyToFront (el, scaling, Zindex, duration0){
			dark_layer1.removeClass('l1'); // disable dark layers when an image is coming to the front
			dark_layer2.removeClass('l2');										
			if (smart) {
				$(el).css(TrasitDur,layer_time+"ms").css(TrasitDel,"0ms")
					.css(Transform, "scale("+scaling+","+scaling+")");
				} else {
					el = ScaleIE(scaling, el, duration0);
				}					
				timer4 = setTimeout(function() { 
					$(el).css({"zIndex": Zindex});
					dark_layer1.addClass('l1');
					dark_layer2.addClass('l2');
				}, 1.25*(duration0-layer_time));
				
				return el;
		}
		
		function ToFrontAndBack (el, scaling, Zindex, duration1, duration2) {
			var ttt1=duration1+tscr; ttt2=0.5*duration1;
			$(el).css("zIndex", 90*scaling); //the bigger is scale, the more z-index should be
			if (smart) {
				$(el).css(TrasitDur,ttt1+"ms, "+tscr+"ms").css(TrasitDel," 0ms, "+ttt2+"ms")
					.css(Transform, "scale(1,1)").css({"opacity":0});
			} else {
				el = ScaleIE(1, el, ttt1);
			
							
			}
			
			timer5 = setTimeout(function() {
				$(el).css({"zIndex": Zindex});
				if (smart) {
					$(el).css(TrasitDur,"0ms").css(TrasitDel,"0ms").css(Transform, "scale(0.1,0.1)");
				} else {
					el = ScaleIE(0.1, el, 0);
					$(el).css('visibility','hidden');
				}
			}, duration1+tscr+tdel);
			var ttt3 = duration2+t0; ttt4 = 0.5*t0;
				
			timer6 = setTimeout(function() {
				if (smart) {
					$(el).css(TrasitDur,ttt3+"ms, "+ttt4+"ms").css(TrasitDel," 0ms")
					.css(Transform, "scale("+scaling+","+scaling+")").css({"opacity":1});
				} else {
					$(el).css('visibility','visible');
					el = ScaleIE(scaling, el, ttt3);
					
				}
			}, duration1+tscr+tdel+300);	
			return el;	
		}
			
		function CreateMatrix (Mo,M,No,N) {
			var Matrix = [];
			for (var j=No;j<N;j++){
				var row = [];
				for (var i=Mo;i<M;i++){
					row[i] = true; //the cell is ready for usage
				}
				Matrix[j] = row;
			}
			return Matrix;
		}
		
		/*canvas positioning... God bless you */
		
			// create matrix
		function PositionImage (ImagesArray, uMatrix, Jo, Io, matrixN, matrixM){
			/* ImagesArray - array of images to place 
			Jo, Io - where to start the search
			matrixN, matrixM - number of cells in vertical and horizontal directions
			*/
			var maxM = 0,
				maxN = 0,
				Ioo=Io;
			var ImgArrLngth = ImagesArray.length;
			for (var index=0;index<ImgArrLngth;index++){ 
				Io=Ioo;
				var $img = $(ImagesArray[index]);
					widthCanvas = $img.data("wCanvas"),
					heightCanvas = $img.data("hCanvas"); 
				
				IamDone:
				for (var j=Jo;j<(matrixN-heightCanvas);j++) {
					MoveToNextCellinRow: 
					for (var i=Io;i<(matrixM-widthCanvas);i++) {
							for (var r=j;r<(j+heightCanvas);r++) { 
								for (var s=i;s<(i+widthCanvas);s++) {
									if (uMatrix[r][s] == false) {
										if (j == (matrixN-heightCanvas-1) && i == (matrixM-widthCanvas-1)) { //the image is too large and does not fit the container
											for (var q=0;q<matrixN;q++) { //add new column to container and try to position image again
												uMatrix[q].push(true);
											}
											i = Io;
											matrixM++; //adding new column
											j=0;
											
										} 
										continue MoveToNextCellinRow; //move to the next cell in row
									}
								}
							} 
							
							for (var r=j;r<(j+heightCanvas+1);r++) { 
								for (var s=i;s<(i+widthCanvas+1);s++) {
									uMatrix[r][s] = false;
								}	
							}
							if ((i+widthCanvas)> maxM) maxM = i+widthCanvas; //cut empty space on the right and in the bottom
							if ((j+heightCanvas)> maxN) maxN = j+heightCanvas;
							$img.css({"top":Math.floor(j*CellSize+$img.data("deviationY")), "left":Math.floor(i*CellSize+$img.data("deviationX"))}); 
							break IamDone;
					}
				}
			}
			return [maxM, maxN];
			 
		}


		function FindOnClickImage (planes, ev) {
			var count = planes.length - 1,
			el_below = ev.target;
			SwitchDarkLayers();
			while (!$(el_below).hasClass("photo") && (count != 0)){
				var e = new jQuery.Event("click");
				e.pageX = ev.pageX;
				e.pageY = ev.pageY;
				$(planes[count]).addClass("toBG");
				el_below = document.elementFromPoint(e.pageX, e.pageY);
				count--;
			}	
			var planes_length = planes.length;
			for (var pp=0;pp<planes_length;pp++) {
				$(planes[pp]).removeClass("toBG");
			} 
			SwitchDarkLayers();	
			if (!$(el_below).hasClass("photo")) el_below = false 
			return el_below;
		}
		
		$('.destroy').on('click', function() {
				TotalDestroy();		
		});
			
			function TotalDestroy () {
				clearTimeout(timer1);
				clearTimeout(timer2);
				clearTimeout(timer3);
				clearTimeout(timer4);
				clearTimeout(timer5);
				clearTimeout(timer6);
				clearTimeout(timer7);
				$('.photo').off("click");
				closeX.off("click");
				main.off("click");
				main.off("mousemove");
				$('.photo').off('mouseenter');
				$('.photo').off('mouseleave');
				$('.corners').off('click');
				dark_layer1.remove();
				dark_layer2.remove();
				closeX.remove();
				caption.remove();
				Container.remove();
			}

		$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len	= this.length;
		if (len > 0) {
			return this.each(function() {
				var	el		= this,
					$el		= $(el),
					blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
				
				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};

	function LoadProgress (){
			timer7  = setTimeout(function(){
				if (loaded_imgs>total*0.5) {
					var fakeimgs = 0;
					timer8 = setInterval(function() {
						if (fakeimgs<total) {
							loading.html((++fakeimgs)+'/'+total);
						} else {
							loading.html((total)+'/'+total);
							if (loaded_imgs == total) {
								clearInterval(timer8);
								Launch();
							}
						}
					},50);
				} else {
					timer8 = setInterval(function() {
						loading.html((loaded_imgs)+'/'+total);
						if (loaded_imgs == total) {
							clearInterval(timer8);
							Launch();
						}
					},100);
				}
				clearTimeout(timer7);
			},150);
		}
			
		$('.plane img').loaded(function() {
			++loaded_imgs; 
		});
		LoadProgress();
			
	/*$('.plane img').loaded(function() {++loaded_imgs},function() { Launch()});
	timer7  = setInterval(function(){
		loading.html((loaded_imgs)+'/'+total);
	},200);*/
}

});
 /***************************************************************************************/
 
 
 
/* !Sandbox */
jQuery(document).ready(function($) {
	var $suspects = $("#content").find(".wf-usr-cell"),
		jail = [],
		i = 0;

	$suspects.each(function() {
		var $this = $(this);

		jail[i] = $this;

		if (!$this.next().hasClass("wf-usr-cell")) {
			if (!$this.parent().hasClass("wf-container")) {
				$(jail).map(function () {return this.toArray(); }).wrapAll('<div class="wf-container">');
			}
			jail = [];
			i = 0;
		} else {
			i++;
		};
	});
});

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */
(function($) {
    
    $.belowthefold = function(element, settings) {
        var fold = $(window).height() + $(window).scrollTop();
        return fold <= $(element).offset().top - settings.threshold;
    };

    $.abovethetop = function(element, settings) {
        var top = $(window).scrollTop();
        return top >= $(element).offset().top + $(element).height() - settings.threshold;
    };
    
    $.rightofscreen = function(element, settings) {
        var fold = $(window).width() + $(window).scrollLeft();
        return fold <= $(element).offset().left - settings.threshold;
    };
    
    $.leftofscreen = function(element, settings) {
        var left = $(window).scrollLeft();
        return left >= $(element).offset().left + $(element).width() - settings.threshold;
    };
    
    $.inviewport = function(element, settings) {
        return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
    
    };
    
    $.extend($.expr[':'], {
        "below-the-fold": function(a, i, m) {
            return $.belowthefold(a, {threshold : 0});
        },
        "above-the-top": function(a, i, m) {
            return $.abovethetop(a, {threshold : 0});
        },
        "left-of-screen": function(a, i, m) {
            return $.leftofscreen(a, {threshold : 0});
        },
        "right-of-screen": function(a, i, m) {
            return $.rightofscreen(a, {threshold : 0});
        },
        "in-viewport": function(a, i, m) {
            return $.inviewport(a, {threshold : 0});
        }
    });

    
})(jQuery);
/*
 * Swiper 1.9.4 - Mobile Touch Slider
 * http://www.idangero.us/sliders/swiper/
 *
 * Copyright 2012-2013, Vladimir Kharlampidi
 * The iDangero.us
 * http://www.idangero.us/
 *
 * Licensed under GPL & MIT
 *
 * Updated on: May 23, 2013
*/
var Swiper = function (selector, params, callback) {
    /*=========================
      A little bit dirty but required part for IE8 and old FF support
      ===========================*/
    if (!window.addEventListener) {
        if (!window.Element)
            Element = function () { };
    
        Element.prototype.addEventListener = HTMLDocument.prototype.addEventListener = addEventListener = function (type, listener, useCapture) { this.attachEvent('on' + type, listener); }
        Element.prototype.removeEventListener = HTMLDocument.prototype.removeEventListener = removeEventListener = function (type, listener, useCapture) { this.detachEvent('on' + type, listener); }
    }
    
    if (document.body.__defineGetter__) {
        if (HTMLElement) {
            var element = HTMLElement.prototype;
            if (element.__defineGetter__)
                element.__defineGetter__("outerHTML", function () { return new XMLSerializer().serializeToString(this); } );
        }
    }
    
    if (!window.getComputedStyle) {
        window.getComputedStyle = function (el, pseudo) {
            this.el = el;
            this.getPropertyValue = function (prop) {
                var re = /(\-([a-z]){1})/g;
                if (prop == 'float') prop = 'styleFloat';
                if (re.test(prop)) {
                    prop = prop.replace(re, function () {
                        return arguments[2].toUpperCase();
                    });
                }
                return el.currentStyle[prop] ? el.currentStyle[prop] : null;
            }
            return this;
        }
    }
        
    /* End Of Polyfills*/
    if(!(selector.nodeType))
        if (!document.querySelectorAll||document.querySelectorAll(selector).length==0) return;
    
    function dQ(s) {
        return document.querySelectorAll(s)
    }
    var _this = this
    _this.touches = {};
    _this.positions = {
        current : 0 
    };
    _this.id = (new Date()).getTime();
    _this.container = (selector.nodeType) ? selector : dQ(selector)[0];
    _this.times = {};
    _this.isTouched = false;
    _this.realIndex = 0;
    _this.activeSlide = 0;
    _this.activeIndex = 0;
    _this.previousSlide = null;
    _this.previousIndex = null;
    _this.langDirection = window.getComputedStyle(_this.container, null).getPropertyValue('direction')
    /*=========================
      New Support Object
      ===========================*/
    _this.support = {
        touch : _this.isSupportTouch(),
        threeD : _this.isSupport3D(),
        transitions : _this.isSupportTransitions()    
    }
    //For fallback with older versions
    _this.use3D = _this.support.threeD;
    
    
    /*=========================
      Default Parameters
      ===========================*/
    var defaults = {
        mode : 'horizontal',
        ratio : 1,
        speed : 300,
        freeMode : false,
        freeModeFluid : false,
        slidesPerSlide : 1,
        slidesPerGroup : 1,
        simulateTouch : true,
        followFinger : true,
        shortSwipes : true,
        moveStartThreshold:false,
        autoPlay:false,
        onlyExternal : false,
        createPagination : true,
        pagination : false,
        resistance : true,
        nopeek : false,
        scrollContainer : false,
        fluidContainerWidth: false,
        preventLinks : true,
        preventClassNoSwiping : true,
        initialSlide: 0,
        keyboardControl: false, 
        mousewheelControl : false,
        resizeEvent : 'auto', //or 'resize' or 'orientationchange'
        useCSS3Transforms : true,
        queueStartCallbacks : false,
        queueEndCallbacks : false,
        //Namespace
        slideElement : 'div',
        slideClass : 'swiper-slide',
        wrapperClass : 'swiper-wrapper',
        paginationClass: 'swiper-pagination-switch' ,
        paginationActiveClass : 'swiper-active-switch' 
    }
    params = params || {};  
    for (var prop in defaults) {
        if (! (prop in params)) {
            params[prop] = defaults[prop]   
        }
    }
    _this.params = params;
    if (params.scrollContainer) {
        params.freeMode = true;
        params.freeModeFluid = true;    
    }
    var _widthFromCSS = false
    if (params.slidesPerSlide=='auto') {
        _widthFromCSS = true;
        params.slidesPerSlide = 1;
    }
    
    //Default Vars
    var wrapper, isHorizontal,
     slideSize, numOfSlides, wrapperSize, direction, isScrolling, containerSize;
    
    //Define wrapper
    for (var i = _this.container.childNodes.length - 1; i >= 0; i--) {
        
        if (_this.container.childNodes[i].className) {

            var _wrapperClasses = _this.container.childNodes[i].className.split(' ')

            for (var j = 0; j < _wrapperClasses.length; j++) {
                if (_wrapperClasses[j]===params.wrapperClass) {
                    wrapper = _this.container.childNodes[i]
                }
            };  
        }
    };

    _this.wrapper = wrapper;
    //Mode
    isHorizontal = params.mode == 'horizontal';
        
    //Define Touch Events
    _this.touchEvents = {
        touchStart : _this.support.touch || !params.simulateTouch  ? 'touchstart' : (_this.ie10 ? 'MSPointerDown' : 'mousedown'),
        touchMove : _this.support.touch || !params.simulateTouch ? 'touchmove' : (_this.ie10 ? 'MSPointerMove' : 'mousemove'),
        touchEnd : _this.support.touch || !params.simulateTouch ? 'touchend' : (_this.ie10 ? 'MSPointerUp' : 'mouseup')
    };

    /*=========================
      Slide API
      ===========================*/
    _this._extendSwiperSlide = function  (el) {
        el.append = function () {
            _this.wrapper.appendChild(el);
            _this.reInit();
            return el;
        }
        el.prepend = function () {
            _this.wrapper.insertBefore(el, _this.wrapper.firstChild)
            _this.reInit();
            return el;
        }
        el.insertAfter = function (index) {
            if(typeof index === 'undefined') return false;
            var beforeSlide = _this.slides[index+1]
            _this.wrapper.insertBefore(el, beforeSlide)
            _this.reInit();
            return el;
        }
        el.clone = function () {
            return _this._extendSwiperSlide(el.cloneNode(true))
        }
        el.remove = function () {
            _this.wrapper.removeChild(el);
            _this.reInit()
        }
        el.html = function (html) {
            if (typeof html === 'undefined') {
                return el.innerHTML
            }
            else {
                el.innerHTML = html;
                return el;
            }
        }
        el.index = function () {
            var index
            for (var i = _this.slides.length - 1; i >= 0; i--) {
                if(el==_this.slides[i]) index = i
            };
            return index;
        }
        el.isActive = function () {
            if (el.index() == _this.activeIndex) return true;
            else return false;
        }
        if (!el.swiperSlideDataStorage) el.swiperSlideDataStorage={};
        el.getData = function (name) {
            return el.swiperSlideDataStorage[name]
        }
        el.setData = function (name, value) {
            el.swiperSlideDataStorage[name] = value;
            return el;
        }
        el.data = function (name, value) {
            if (!value) {
                return el.getAttribute('data-'+name);
            }
            else {
                el.setAttribute('data-'+name,value);
                return el;
            }
        }
        return el;
    }

    //Calculate information about slides
    _this._calcSlides = function () {
        var oldNumber = _this.slides ? _this.slides.length : false;
        _this.slides = []
        for (var i = 0; i < _this.wrapper.childNodes.length; i++) {
            if (_this.wrapper.childNodes[i].className) {
                var _slideClasses = _this.wrapper.childNodes[i].className.split(' ')
                for (var j = 0; j < _slideClasses.length; j++) {
                    if(_slideClasses[j]===params.slideClass) _this.slides.push(_this.wrapper.childNodes[i])
                };
            } 
        };
        for (var i = _this.slides.length - 1; i >= 0; i--) {
            _this._extendSwiperSlide(_this.slides[i]);
        };
        if (!oldNumber) return;
        if(oldNumber!=_this.slides.length && _this.createPagination) {
            // Number of slides has been changed
            _this.createPagination();
            _this.callPlugins('numberOfSlidesChanged')
        }
        /*
        if (_this.langDirection=='rtl') {
            for (var i = 0; i < _this.slides.length; i++) {
                _this.slides[i].style.float="right"
            };
        }
        */
    }
    _this._calcSlides();

    //Create Slide
    _this.createSlide = function (html, slideClassList, el) {
        var slideClassList = slideClassList || _this.params.slideClass;
        var el = el||params.slideElement;
        var newSlide = document.createElement(el)
        newSlide.innerHTML = html||'';
        newSlide.className = slideClassList;
        return _this._extendSwiperSlide(newSlide);
    }

    //Append Slide  
    _this.appendSlide = function (html, slideClassList, el) {
        if (!html) return;
        if (html.nodeType) {
            return _this._extendSwiperSlide(html).append()
        }
        else {
            return _this.createSlide(html, slideClassList, el).append()
        }
    }
    _this.prependSlide = function (html, slideClassList, el) {
        if (!html) return;
        if (html.nodeType) {
            return _this._extendSwiperSlide(html).prepend()
        }
        else {
            return _this.createSlide(html, slideClassList, el).prepend()
        }
    }
    _this.insertSlideAfter = function (index, html, slideClassList, el) {
        if (!index) return false;
        if (html.nodeType) {
            return _this._extendSwiperSlide(html).insertAfter(index)
        }
        else {
            return _this.createSlide(html, slideClassList, el).insertAfter(index)
        }
    }
    _this.removeSlide = function (index) {
        if (_this.slides[index]) {
            _this.slides[index].remove()
            return true;
        }
        else return false;
    }
    _this.removeLastSlide = function () {
        if (_this.slides.length>0) {
            _this.slides[ (_this.slides.length-1) ].remove();
            return true
        }
        else {
            return false
        }
    }
    _this.removeAllSlides = function () {
        for (var i = _this.slides.length - 1; i >= 0; i--) {
            _this.slides[i].remove()
        };
    }
    _this.getSlide = function (index) {
        return _this.slides[index]
    }
    _this.getLastSlide = function () {
        return _this.slides[ _this.slides.length-1 ]
    }
    _this.getFirstSlide = function () {
        return _this.slides[0]
    }

    //Currently Active Slide
    _this.currentSlide = function () {
        return _this.slides[_this.activeIndex]
    }
    
    /*=========================
      Find All Plugins
      !!! Plugins API is in beta !!!
      ===========================*/
    var _plugins = [];
    for (var plugin in _this.plugins) {
        if (params[plugin]) {
            var p = _this.plugins[plugin](_this, params[plugin])
            if (p)
                _plugins.push( p )  
        }
    }
    
    _this.callPlugins = function(method, args) {
        if (!args) args = {}
        for (var i=0; i<_plugins.length; i++) {
            if (method in _plugins[i]) {
                _plugins[i][method](args);
            }

        }
        
    }

    /*=========================
      WP8 Fix
      ===========================*/
    if (_this.ie10 && !params.onlyExternal) {
        if (isHorizontal) _this.wrapper.classList.add('swiper-wp8-horizontal')  
        else _this.wrapper.classList.add('swiper-wp8-vertical') 
    }
    
    /*=========================
      Loop
      ===========================*/
    if (params.loop) {
        (function(){
            numOfSlides = _this.slides.length;
            if (_this.slides.length==0) return;
            var slideFirstHTML = '';
            var slideLastHTML = '';
            //Grab First Slides
            for (var i=0; i<params.slidesPerSlide; i++) {
                slideFirstHTML+=_this.slides[i].outerHTML
            }
            //Grab Last Slides
            for (var i=numOfSlides-params.slidesPerSlide; i<numOfSlides; i++) {
                slideLastHTML+=_this.slides[i].outerHTML
            }
            wrapper.innerHTML = slideLastHTML + wrapper.innerHTML + slideFirstHTML;
            _this._calcSlides()
            _this.callPlugins('onCreateLoop');
        })();
    }
    
    //Init Function
    var firstInit = false;
    //ReInitizize function. Good to use after dynamically changes of Swiper, like after add/remove slides
    _this.reInit = function () {
        _this.init(true)
    }
    _this.init = function(reInit) {
        var _width = window.getComputedStyle(_this.container, null).getPropertyValue('width')
        var _height = window.getComputedStyle(_this.container, null).getPropertyValue('height')
        var newWidth = parseInt(_width,10);
        var newHeight  = parseInt(_height,10);
        
        //IE8 Fixes
        if(isNaN(newWidth) || _width.indexOf('%')>0) {
            newWidth = _this.container.offsetWidth - parseInt(window.getComputedStyle(_this.container, null).getPropertyValue('padding-left'),10) - parseInt(window.getComputedStyle(_this.container, null).getPropertyValue('padding-right'),10) 
        }
        if(isNaN(newHeight) || _height.indexOf('%')>0) {
            newHeight = _this.container.offsetHeight - parseInt(window.getComputedStyle(_this.container, null).getPropertyValue('padding-top'),10) - parseInt(window.getComputedStyle(_this.container, null).getPropertyValue('padding-bottom'),10)         
        }
        if (!reInit) {
            if (_this.width==newWidth && _this.height==newHeight) return            
        }
        if (reInit || firstInit) {
            _this._calcSlides();
            if (params.pagination) {
                _this.updatePagination()
            }
        }
        _this.width  = newWidth;
        _this.height  = newHeight;
        
        var dividerVertical = isHorizontal ? 1 : params.slidesPerSlide,
            dividerHorizontal = isHorizontal ? params.slidesPerSlide : 1,
            slideWidth, slideHeight, wrapperWidth, wrapperHeight;

        numOfSlides = _this.slides.length
        if (!params.scrollContainer) {
            if (!_widthFromCSS) {
                slideWidth = _this.width/dividerHorizontal;
                slideHeight = _this.height/dividerVertical; 
            }
            else {
                slideWidth = _this.slides[0].offsetWidth;
                slideHeight = _this.slides[0].offsetHeight;
            }
            containerSize = isHorizontal ? _this.width : _this.height;
            slideSize = isHorizontal ? slideWidth : slideHeight;
            wrapperWidth = isHorizontal ? numOfSlides * slideWidth : _this.width;
            wrapperHeight = isHorizontal ? _this.height : numOfSlides*slideHeight;
            if (_widthFromCSS) {
                //Re-Calc sps for pagination
                params.slidesPerSlide = Math.round(containerSize/slideSize)
            }
        }
        else {
            //Unset dimensions in vertical scroll container mode to recalculate slides
            if (!isHorizontal) {
                wrapper.style.width='';
                wrapper.style.height='';
                _this.slides[0].style.width='';
                _this.slides[0].style.height='';
            }

            if (params.fluidContainerWidth && isHorizontal) {
                slideWidth = 0;
                slideHeight = 0;
                for (var i=0; i<_this.slides[0].children.length; i++) {
                    slideWidth += _this.slides[0].children[i].offsetWidth;
                    if (_this.slides[0].children[i].offsetHeight > slideHeight) {
                        slideHeight = _this.slides[0].children[i].offsetHeight;
                    }
                }
            }
            else {
                slideWidth = _this.slides[0].offsetWidth;
                slideHeight = _this.slides[0].offsetHeight;
            }
            
            containerSize = isHorizontal ? _this.width : _this.height;
            
            slideSize = isHorizontal ? slideWidth : slideHeight;
            wrapperWidth = slideWidth;
            wrapperHeight = slideHeight;
        }

        wrapperSize = isHorizontal ? wrapperWidth : wrapperHeight;
    
        for (var i=0; i<_this.slides.length; i++ ) {
            var el = _this.slides[i];
            if (!_widthFromCSS) {
                el.style.width=slideWidth+"px"
                el.style.height=slideHeight+"px"
            }
            if (params.onSlideInitialize) {
                params.onSlideInitialize(_this, el);
            }
        }
        wrapper.style.width = wrapperWidth+"px";
        wrapper.style.height = wrapperHeight+"px";
        
        // Set Initial Slide Position   
        if(params.initialSlide > 0 && params.initialSlide < numOfSlides && !firstInit) {
            _this.realIndex = _this.activeIndex = params.initialSlide;
            
            if (params.loop) {
                _this.activeIndex = _this.realIndex-params.slidesPerSlide;
            }
            //Legacy
            _this.activeSlide = _this.activeIndex;
            //--          
            if (isHorizontal) {
                _this.positions.current = -params.initialSlide * slideWidth;
                _this.setTransform( _this.positions.current, 0, 0);
            }
            else {  
                _this.positions.current = -params.initialSlide * slideHeight;
                _this.setTransform( 0, _this.positions.current, 0);
            }
        }
        
        if (!firstInit) _this.callPlugins('onFirstInit');
        else _this.callPlugins('onInit');
        firstInit = true;
    }

    _this.init()

    
    
    //Get Max And Min Positions
    function maxPos() {
        var a = (wrapperSize - containerSize);
        if (params.loop) a = a - containerSize; 
        if (params.scrollContainer) {
            a = slideSize - containerSize;
            if (a<0) a = 0;
        }
        if (params.slidesPerSlide > _this.slides.length) a = 0;
        return a;
    }
    function minPos() {
        var a = 0;
        if (params.loop) a = containerSize;
        return a;   
    }
    
    /*=========================
      Pagination
      ===========================*/
    _this.updatePagination = function() {
        if (_this.slides.length<2) return;
        var activeSwitch = dQ(params.pagination+' .'+params.paginationActiveClass)
        if(!activeSwitch) return
        for (var i=0; i < activeSwitch.length; i++) {
            activeSwitch.item(i).className = params.paginationClass
        }
        var pagers = dQ(params.pagination+' .'+params.paginationClass).length;
        var minPagerIndex = params.loop ? _this.realIndex-params.slidesPerSlide : _this.realIndex;
        var maxPagerIndex = minPagerIndex + (params.slidesPerSlide-1);
        for (var i = minPagerIndex; i <= maxPagerIndex; i++ ) {
            var j = i;
            if (j>=pagers) j=j-pagers;
            if (j<0) j = pagers + j;
            if (j<numOfSlides) {
                dQ(params.pagination+' .'+params.paginationClass).item( j ).className = params.paginationClass+' '+params.paginationActiveClass
            }
            if (i==minPagerIndex) dQ(params.pagination+' .'+params.paginationClass).item( j ).className+=' swiper-activeslide-switch'
        }
    }
    _this.createPagination = function () {
        if (params.pagination && params.createPagination) {
            var paginationHTML = "";
            var numOfSlides = _this.slides.length;
            var numOfButtons = params.loop ? numOfSlides - params.slidesPerSlide*2 : numOfSlides;
            for (var i = 0; i < numOfButtons; i++) {
                paginationHTML += '<span class="'+params.paginationClass+'"></span>'
            }
            dQ(params.pagination)[0].innerHTML = paginationHTML
            _this.updatePagination()
            
            _this.callPlugins('onCreatePagination');
        }   
    }
    _this.createPagination();
    
    
    //Window Resize Re-init
    _this.resizeEvent = params.resizeEvent==='auto' 
        ? ('onorientationchange' in window) ? 'orientationchange' : 'resize'
        : params.resizeEvent

    _this.resizeFix = function(){
        _this.callPlugins('beforeResizeFix');
        _this.init()
        //To fix translate value
        if (!params.scrollContainer) 
            _this.swipeTo(_this.activeIndex, 0, false)
        else {
            var pos = isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y')
            if (pos < -maxPos()) {
                var x = isHorizontal ? -maxPos() : 0;
                var y = isHorizontal ? 0 : -maxPos();
                _this.setTransition(0)
                _this.setTransform(x,y,0)   
            }
        }
        _this.callPlugins('afterResizeFix');
    }
    if (!params.disableAutoResize) {
        //Check for resize event
        window.addEventListener(_this.resizeEvent, _this.resizeFix, false)
    }

    /*========================================== 
        Autoplay 
    ============================================*/

    var autoPlay
    _this.startAutoPlay = function() {
        if (params.autoPlay && !params.loop) {
            autoPlay = setInterval(function(){
                var newSlide = _this.realIndex + 1
                if ( newSlide == numOfSlides) newSlide = 0 
                if ( newSlide == numOfSlides - params.slidesPerSlide + 1) newSlide=0;
                _this.swipeTo(newSlide)
            }, params.autoPlay)
        }
        else if (params.autoPlay && params.loop) {
            autoPlay = setInterval(function(){
                _this.fixLoop();
                _this.swipeNext(true)
            }, params.autoPlay)
        }
        _this.callPlugins('onAutoPlayStart');
    }
    _this.stopAutoPlay = function() {
        if (autoPlay)
            clearInterval(autoPlay)
        _this.callPlugins('onAutoPlayStop');
    }
    if (params.autoPlay) {
        _this.startAutoPlay()
    }
    
    /*========================================== 
        Event Listeners 
    ============================================*/
    
    if (!_this.ie10) {
        if (_this.support.touch) {
            wrapper.addEventListener('touchstart', onTouchStart, false);
            wrapper.addEventListener('touchmove', onTouchMove, false);
            wrapper.addEventListener('touchend', onTouchEnd, false);    
        }
        if (params.simulateTouch) {
            wrapper.addEventListener('mousedown', onTouchStart, false);
            document.addEventListener('mousemove', onTouchMove, false);
            document.addEventListener('mouseup', onTouchEnd, false);
        }
    }
    else {
        /*wrapper.addEventListener(_this.touchEvents.touchStart, onTouchStart, false);
        document.addEventListener(_this.touchEvents.touchMove, onTouchMove, false);
        document.addEventListener(_this.touchEvents.touchEnd, onTouchEnd, false);*/

        if (_this.support.touch) {
            wrapper.addEventListener('touchstart', onTouchStart, false);
            wrapper.addEventListener('touchmove', onTouchMove, false);
            wrapper.addEventListener('touchend', onTouchEnd, false);    
        }
        if (params.simulateTouch) {
            wrapper.addEventListener('mousedown', onTouchStart, false);
            document.addEventListener('mousemove', onTouchMove, false);
            document.addEventListener('mouseup', onTouchEnd, false);
        }
    }
    
    //Remove Events
    _this.destroy = function(removeResizeFix){
        removeResizeFix = removeResizeFix===false ? removeResizeFix : removeResizeFix || true
        if (removeResizeFix) {
            window.removeEventListener(_this.resizeEvent, _this.resizeFix, false);
        }

        if (_this.ie10) {
            wrapper.removeEventListener(_this.touchEvents.touchStart, onTouchStart, false);
            document.removeEventListener(_this.touchEvents.touchMove, onTouchMove, false);
            document.removeEventListener(_this.touchEvents.touchEnd, onTouchEnd, false);
        }
        else {
            if (_this.support.touch) {
                wrapper.removeEventListener('touchstart', onTouchStart, false);
                wrapper.removeEventListener('touchmove', onTouchMove, false);
                wrapper.removeEventListener('touchend', onTouchEnd, false); 
            }
            wrapper.removeEventListener('mousedown', onTouchStart, false);
            document.removeEventListener('mousemove', onTouchMove, false);
            document.removeEventListener('mouseup', onTouchEnd, false);
        }

        if (params.keyboardControl) {
            document.removeEventListener('keydown', handleKeyboardKeys, false);
        }
        if (params.mousewheelControl && _this._wheelEvent) {
            _this.container.removeEventListener(_this._wheelEvent, handleMousewheel, false);
        }
        if (params.autoPlay) {
            _this.stopAutoPlay()
        }
        _this.callPlugins('onDestroy');
    }
    /*=========================
      Prevent Links
      ===========================*/

    _this.allowLinks = true;
    if (params.preventLinks) {
        var links = _this.container.querySelectorAll('a')
        for (var i=0; i<links.length; i++) {
            links[i].addEventListener('click', preventClick, false) 
        }
    }
    function preventClick(e) {
        if (!_this.allowLinks) (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    }

    /*========================================== 
        Keyboard Control 
    ============================================*/
    if (params.keyboardControl) {
        function handleKeyboardKeys (e) {
            var kc = e.keyCode || e.charCode;
            if (isHorizontal) {
                if (kc==37 || kc==39) e.preventDefault();
                if (kc == 39) _this.swipeNext()
                if (kc == 37) _this.swipePrev()
            }
            else {
                if (kc==38 || kc==40) e.preventDefault();
                if (kc == 40) _this.swipeNext()
                if (kc == 38) _this.swipePrev()
            }
        }
        document.addEventListener('keydown',handleKeyboardKeys, false);
    }

    /*========================================== 
        Mousewheel Control. Beta! 
    ============================================*/
    // detect available wheel event
    _this._wheelEvent = false;
    
    if (params.mousewheelControl) {
        if ( document.onmousewheel !== undefined ) {
            _this._wheelEvent = "mousewheel"
        }
            try {
                WheelEvent("wheel");
                _this._wheelEvent = "wheel";
            } catch (e) {}
            if ( !_this._wheelEvent ) {
                _this._wheelEvent = "DOMMouseScroll";
            }
        function handleMousewheel (e) {
            var we = _this._wheelEvent;
            var delta;
            //Opera & IE
            if (e.detail) delta = -e.detail;
            //WebKits   
            else if (we == 'mousewheel') delta = e.wheelDelta; 
            //Old FireFox
            else if (we == 'DOMMouseScroll') delta = -e.detail;
            //New FireFox
            else if (we == 'wheel') {
                delta = Math.abs(e.deltaX)>Math.abs(e.deltaY) ? - e.deltaX : - e.deltaY;
            }
            if (!params.freeMode) {
                if(delta<0) _this.swipeNext()
                else _this.swipePrev()
            }
            else {
                //Freemode or scrollContainer:
                var currentTransform =isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y')
                var x,y;
                if (isHorizontal) {
                    x = _this.getTranslate('x') + delta;
                    y = _this.getTranslate('y');
                    if (x>0) x = 0;
                    if (x<-maxPos()) x = -maxPos();
                }
                else {
                    x = _this.getTranslate('x');
                    y = _this.getTranslate('y')+delta;
                    if (y>0) y = 0;
                    if (y<-maxPos()) y = -maxPos();
                }
                _this.setTransition(0)
                _this.setTransform(x,y,0)
            }

            if(e.preventDefault) e.preventDefault();
            else e.returnValue = false;
            return false;
        }
        if (_this._wheelEvent) {
            _this.container.addEventListener(_this._wheelEvent, handleMousewheel, false);
        }
    }
    /*=========================
      Grab Cursor
      ===========================*/
    if (params.grabCursor) {
        _this.container.style.cursor = 'move';
        _this.container.style.cursor = 'grab';
        _this.container.style.cursor = '-moz-grab';
        _this.container.style.cursor = '-webkit-grab';
    }  
    /*=========================
      Handle Touches
      ===========================*/
    //Detect event type for devices with both touch and mouse support
    var isTouchEvent = false; 
    var allowThresholdMove; 
    function onTouchStart(event) {
        //Exit if slider is already was touched
        if (_this.isTouched || params.onlyExternal) {
            return false
        }
        if (params.preventClassNoSwiping && event.target && event.target.className.indexOf('NoSwiping') > -1) return false;
        
        //Check For Nested Swipers
        _this.isTouched = true;
        isTouchEvent = event.type=='touchstart';
        if (!isTouchEvent || event.targetTouches.length == 1 ) {
            _this.callPlugins('onTouchStartBegin');
            
            if (params.loop) _this.fixLoop();
            if(!isTouchEvent) {
                if(event.preventDefault) event.preventDefault();
                else event.returnValue = false;
            }
            var pageX = isTouchEvent ? event.targetTouches[0].pageX : (event.pageX || event.clientX)
            var pageY = isTouchEvent ? event.targetTouches[0].pageY : (event.pageY || event.clientY)
            
            //Start Touches to check the scrolling
            _this.touches.startX = _this.touches.currentX = pageX;
            _this.touches.startY = _this.touches.currentY = pageY;
            
            _this.touches.start = _this.touches.current = isHorizontal ? _this.touches.startX : _this.touches.startY ;
            
            //Set Transition Time to 0
            _this.setTransition(0)
            
            //Get Start Translate Position
            _this.positions.start = _this.positions.current = isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y');

            //Set Transform
            if (isHorizontal) {
                _this.setTransform( _this.positions.start, 0, 0)
            }
            else {
                _this.setTransform( 0, _this.positions.start, 0)
            }
            
            //TouchStartTime
            var tst = new Date()
            _this.times.start = tst.getTime()
            
            //Unset Scrolling
            isScrolling = undefined;
            
            //Define Clicked Slide without additional event listeners
            if (params.onSlideClick || params.onSlideTouch) {
                ;(function () {
                    var el = _this.container;
                    var box = el.getBoundingClientRect();
                    var body = document.body;
                    var clientTop  = el.clientTop  || body.clientTop  || 0;
                    var clientLeft = el.clientLeft || body.clientLeft || 0;
                    var scrollTop  = window.pageYOffset || el.scrollTop;
                    var scrollLeft = window.pageXOffset || el.scrollLeft;
                    var x = pageX - box.left + clientLeft - scrollLeft;
                    var y = pageY - box.top - clientTop - scrollTop;
                    var touchOffset = isHorizontal ? x : y; 
                    var beforeSlides = -Math.round(_this.positions.current/slideSize)
                    var realClickedIndex = Math.floor(touchOffset/slideSize) + beforeSlides
                    var clickedIndex = realClickedIndex;
                    if (params.loop) {
                        var clickedIndex = realClickedIndex - params.slidesPerSlide;
                        if (clickedIndex<0) {
                            clickedIndex = _this.slides.length+clickedIndex-(params.slidesPerSlide*2);
                        }

                    }
                    _this.clickedSlideIndex = clickedIndex
                    _this.clickedSlide = _this.getSlide(realClickedIndex);
                    if (params.onSlideTouch) {
                        params.onSlideTouch(_this);
                        _this.callPlugins('onSlideTouch');
                    }
                })();
            }
            //Set Treshold
            if (params.moveStartThreshold>0) allowThresholdMove = false;
            //CallBack
            if (params.onTouchStart) params.onTouchStart(_this)
            _this.callPlugins('onTouchStartEnd');
            
        }
    }
    function onTouchMove(event) {
        // If slider is not touched - exit
        if (!_this.isTouched || params.onlyExternal) return;
        if (isTouchEvent && event.type=='mousemove') return;
        var pageX = isTouchEvent ? event.targetTouches[0].pageX : (event.pageX || event.clientX)
        var pageY = isTouchEvent ? event.targetTouches[0].pageY : (event.pageY || event.clientY)
        //check for scrolling
        if ( typeof isScrolling === 'undefined' && isHorizontal) {
          isScrolling = !!( isScrolling || Math.abs(pageY - _this.touches.startY) > Math.abs( pageX - _this.touches.startX ) )
        }
        if ( typeof isScrolling === 'undefined' && !isHorizontal) {
          isScrolling = !!( isScrolling || Math.abs(pageY - _this.touches.startY) < Math.abs( pageX - _this.touches.startX ) )
        }

        if (isScrolling ) {
            _this.isTouched = false;
            return
        }
        
        //Check For Nested Swipers
        if (event.assignedToSwiper) {
            _this.isTouched = false;
            return
        }
        event.assignedToSwiper = true;  
        
        //Block inner links
        if (params.preventLinks) {
            _this.allowLinks = false;   
        }
        
        //Stop AutoPlay if exist
        if (params.autoPlay) {
            _this.stopAutoPlay()
        }
        if (!isTouchEvent || event.touches.length == 1) {
            
            _this.callPlugins('onTouchMoveStart');

            if(event.preventDefault) event.preventDefault();
            else event.returnValue = false;
            
            _this.touches.current = isHorizontal ? pageX : pageY ;
            
            _this.positions.current = (_this.touches.current - _this.touches.start)*params.ratio + _this.positions.start            
            
            if (params.resistance) {
                //Resistance for Negative-Back sliding
                if(_this.positions.current > 0 && !(params.freeMode&&!params.freeModeFluid)) {
                    
                    if (params.loop) {
                        var resistance = 1;
                        if (_this.positions.current>0) _this.positions.current = 0;
                    }
                    else {
                        var resistance = (containerSize*2-_this.positions.current)/containerSize/2;
                    }
                    if (resistance < 0.5) 
                        _this.positions.current = (containerSize/2)
                    else 
                        _this.positions.current = _this.positions.current * resistance
                        
                    if (params.nopeek)
                        _this.positions.current = 0;
                    
                }
                //Resistance for After-End Sliding
                if ( (_this.positions.current) < -maxPos() && !(params.freeMode&&!params.freeModeFluid)) {
                    
                    if (params.loop) {
                        var resistance = 1;
                        var newPos = _this.positions.current
                        var stopPos = -maxPos() - containerSize
                    }
                    else {
                        
                        var diff = (_this.touches.current - _this.touches.start)*params.ratio + (maxPos()+_this.positions.start)
                        var resistance = (containerSize+diff)/(containerSize);
                        var newPos = _this.positions.current-diff*(1-resistance)/2
                        var stopPos = -maxPos() - containerSize/2;
                    }
                    
                    if (params.nopeek) {
                        newPos = _this.positions.current-diff;
                        stopPos = -maxPos();
                    }
                    
                    if (newPos < stopPos || resistance<=0)
                        _this.positions.current = stopPos;
                    else 
                        _this.positions.current = newPos
                }
            }
            
            //Move Slides
            if (!params.followFinger) return

            if (!params.moveStartThreshold) {
                if (isHorizontal) _this.setTransform( _this.positions.current, 0, 0)
                else _this.setTransform( 0, _this.positions.current, 0)    
            }
            else {
                if ( Math.abs(_this.touches.current - _this.touches.start)>params.moveStartThreshold || allowThresholdMove) {
                    allowThresholdMove = true;
                    if (isHorizontal) _this.setTransform( _this.positions.current, 0, 0)
                    else _this.setTransform( 0, _this.positions.current, 0)  
                }
                else {
                    _this.positions.current = _this.positions.start
                }
            }    
            
            
            if (params.freeMode) {
                _this.updateActiveSlide(_this.positions.current)
            }

            //Prevent onSlideClick Fallback if slide is moved
            if (params.onSlideClick && _this.clickedSlide) {
                _this.clickedSlide = false
            }

            //Grab Cursor
            if (params.grabCursor) {
                _this.container.style.cursor = 'move';
                _this.container.style.cursor = 'grabbing';
                _this.container.style.cursor = '-moz-grabbin';
                _this.container.style.cursor = '-webkit-grabbing';
            }  

            //Callbacks
            _this.callPlugins('onTouchMoveEnd');
            if (params.onTouchMove) params.onTouchMove(_this)

            return false
        }
    }
    function onTouchEnd(event) {
        //Check For scrolling
        if (isScrolling) _this.swipeReset();
        // If slider is not touched exit
        if ( params.onlyExternal || !_this.isTouched ) return
        _this.isTouched = false

        //Return Grab Cursor
        if (params.grabCursor) {
            _this.container.style.cursor = 'move';
            _this.container.style.cursor = 'grab';
            _this.container.style.cursor = '-moz-grab';
            _this.container.style.cursor = '-webkit-grab';
        } 

        //onSlideClick
        if (params.onSlideClick && _this.clickedSlide) {
            params.onSlideClick(_this);
            _this.callPlugins('onSlideClick')
        }

        //Check for Current Position
        if (!_this.positions.current && _this.positions.current!==0) {
            _this.positions.current = _this.positions.start 
        }
        
        //For case if slider touched but not moved
        if (params.followFinger) {
            if (isHorizontal) _this.setTransform( _this.positions.current, 0, 0)
            else _this.setTransform( 0, _this.positions.current, 0)
        }
        //--
        
        // TouchEndTime
        var tet = new Date()
        _this.times.end = tet.getTime();
        
        //Difference
        _this.touches.diff = _this.touches.current - _this.touches.start        
        _this.touches.abs = Math.abs(_this.touches.diff)
        
        _this.positions.diff = _this.positions.current - _this.positions.start
        _this.positions.abs = Math.abs(_this.positions.diff)
        
        var diff = _this.positions.diff ;
        var diffAbs =_this.positions.abs ;

        if(diffAbs < 5 && (_this.times.end - _this.times.start) < 300 && _this.allowLinks == false) {
            _this.swipeReset()
            //Release inner links
            if (params.preventLinks) {
                _this.allowLinks = true;
            }
        }
        
        var maxPosition = wrapperSize - containerSize;
        if (params.scrollContainer) {
            maxPosition = slideSize - containerSize
        }
        
        //Prevent Negative Back Sliding
        if (_this.positions.current > 0) {
            _this.swipeReset()
            if (params.onTouchEnd) params.onTouchEnd(_this)
            _this.callPlugins('onTouchEnd');
            return
        }
        //Prevent After-End Sliding
        if (_this.positions.current < -maxPosition) {
            _this.swipeReset()
            if (params.onTouchEnd) params.onTouchEnd(_this)
            _this.callPlugins('onTouchEnd');
            return
        }
        
        //Free Mode
        if (params.freeMode) {
            if ( (_this.times.end - _this.times.start) < 300 && params.freeModeFluid ) {
                var newPosition = _this.positions.current + _this.touches.diff * 2 ;
                if (newPosition < maxPosition*(-1)) newPosition = -maxPosition;
                if (newPosition > 0) newPosition = 0;
                if (isHorizontal)
                    _this.setTransform( newPosition, 0, 0)
                else 
                    _this.setTransform( 0, newPosition, 0)
                    
                _this.setTransition( (_this.times.end - _this.times.start)*2 )
                _this.updateActiveSlide(newPosition)
            }
            if (!params.freeModeFluid || (_this.times.end - _this.times.start) >= 300) _this.updateActiveSlide(_this.positions.current)
            if (params.onTouchEnd) params.onTouchEnd(_this)
            _this.callPlugins('onTouchEnd');
            return
        }
        
        //Direction
        direction = diff < 0 ? "toNext" : "toPrev"
        
        //Short Touches
        if (direction=="toNext" && ( _this.times.end - _this.times.start <= 300 ) ) {
            if (diffAbs < 30 || !params.shortSwipes) _this.swipeReset()
            else _this.swipeNext(true);
        }
        
        if (direction=="toPrev" && ( _this.times.end - _this.times.start <= 300 ) ) {
        
            if (diffAbs < 30 || !params.shortSwipes) _this.swipeReset()
            else _this.swipePrev(true);
        }
        //Long Touches
        var groupSize = slideSize * params.slidesPerGroup
        if (direction=="toNext" && ( _this.times.end - _this.times.start > 300 ) ) {
            if (diffAbs >= groupSize*0.5) {
                _this.swipeNext(true)
            }
            else {
                _this.swipeReset()
            }
        }
        if (direction=="toPrev" && ( _this.times.end - _this.times.start > 300 ) ) {
            if (diffAbs >= groupSize*0.5) {
                _this.swipePrev(true);
            }
            else {
                _this.swipeReset()
            }
        }
        if (params.onTouchEnd) params.onTouchEnd(_this)
        _this.callPlugins('onTouchEnd');
    }
    
    /*=========================
      Swipe Functions
      ===========================*/
    _this.swipeNext = function(internal) {
        if (!internal && params.loop) _this.fixLoop();
        if (!internal && params.autoPlay) _this.stopAutoPlay();

        _this.callPlugins('onSwipeNext');

        var getTranslate = isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y');
        var groupSize = slideSize * params.slidesPerGroup;
        var newPosition = Math.floor(Math.abs(getTranslate)/Math.floor(groupSize))*groupSize + groupSize; 
        var curPos = Math.abs(getTranslate)
        if (newPosition==wrapperSize) return;
        if (curPos >= maxPos() && !params.loop) return;
        if (newPosition > maxPos() && !params.loop) {
            newPosition = maxPos()
        };
        if (params.loop) {
            if (newPosition >= (maxPos()+containerSize)) newPosition = maxPos()+containerSize
        }
        if (isHorizontal) {
            _this.setTransform(-newPosition,0,0)
        }
        else {
            _this.setTransform(0,-newPosition,0)
        }
        
        _this.setTransition( params.speed)
        
        //Update Active Slide
        _this.updateActiveSlide(-newPosition)
        
        //Run Callbacks
        slideChangeCallbacks()
        
        return true
    }
    
    _this.swipePrev = function(internal) {
        if (!internal&&params.loop) _this.fixLoop();
        if (!internal && params.autoPlay) _this.stopAutoPlay();

        _this.callPlugins('onSwipePrev');

        var getTranslate = Math.ceil( isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y') );
        
        var groupSize = slideSize * params.slidesPerGroup;
        var newPosition = (Math.ceil(-getTranslate/groupSize)-1)*groupSize;
        
        if (newPosition < 0) newPosition = 0;
        
        if (isHorizontal) {
            _this.setTransform(-newPosition,0,0)
        }
        else  {
            _this.setTransform(0,-newPosition,0)
        }       
        _this.setTransition(params.speed)
        
        //Update Active Slide
        _this.updateActiveSlide(-newPosition)
        
        //Run Callbacks
        slideChangeCallbacks()
        
        return true
    }
    
    _this.swipeReset = function(prevention) {
        _this.callPlugins('onSwipeReset');
        var getTranslate = isHorizontal ? _this.getTranslate('x') : _this.getTranslate('y');
        var groupSize = slideSize * params.slidesPerGroup
        var newPosition = getTranslate<0 ? Math.round(getTranslate/groupSize)*groupSize : 0
        var maxPosition = -maxPos()
        if (params.scrollContainer)  {
            newPosition = getTranslate<0 ? getTranslate : 0;
            maxPosition = containerSize - slideSize;
        }
        
        if (newPosition <= maxPosition) {
            newPosition = maxPosition
        }
        if (params.scrollContainer && (containerSize>slideSize)) {
            newPosition = 0;
        }
        
        if (params.mode=='horizontal') {
            _this.setTransform(newPosition,0,0)
        }
        else {
            _this.setTransform(0,newPosition,0)
        }
        
        _this.setTransition( params.speed)
        
        //Update Active Slide
        _this.updateActiveSlide(newPosition)
        
        //Reset Callback
        if (params.onSlideReset) {
            params.onSlideReset(_this)
        }
        
        return true
    }
    
    var firstTimeLoopPositioning = true;
    
    _this.swipeTo = function (index, speed, runCallbacks) { 
    
        index = parseInt(index, 10); //type cast to int
        _this.callPlugins('onSwipeTo', {index:index, speed:speed});
            
        if (index > (numOfSlides-1)) return;
        if (index<0 && !params.loop) return;
        runCallbacks = runCallbacks===false ? false : runCallbacks || true
        var speed = speed===0 ? speed : speed || params.speed;
        
        if (params.loop) index = index + params.slidesPerSlide;
        
        if (index > numOfSlides - params.slidesPerSlide) index = numOfSlides - params.slidesPerSlide;
        var newPosition =  -index*slideSize ;
        
        if(firstTimeLoopPositioning && params.loop && params.initialSlide > 0 && params.initialSlide < numOfSlides){
            newPosition = newPosition - params.initialSlide * slideSize;
            firstTimeLoopPositioning = false;
        }
        
        if (isHorizontal) {
            _this.setTransform(newPosition,0,0)
        }
        else {
            _this.setTransform(0,newPosition,0)
        }
        _this.setTransition( speed )    
        _this.updateActiveSlide(newPosition)

        //Run Callbacks
        if (runCallbacks) 
            slideChangeCallbacks()
            
        return true
    }
    
    //Prevent Multiple Callbacks 
    _this._queueStartCallbacks = false;
    _this._queueEndCallbacks = false;
    function slideChangeCallbacks() {
        //Transition Start Callback
        _this.callPlugins('onSlideChangeStart');
        if (params.onSlideChangeStart) {
            if (params.queueStartCallbacks && !_this._queueStartCallbacks) {
                _this._queueStartCallbacks = true;
                params.onSlideChangeStart(_this)
                _this.transitionEnd(function(){
                    _this._queueStartCallbacks = false;
                })    
            }
            else if (!params.queueStartCallbacks) {
                params.onSlideChangeStart(_this)
            }
        }        
        
        //Transition End Callback
        if (params.onSlideChangeEnd) {
            if (params.queueEndCallbacks && !_this.queueEndCallbacks) {
                if(_this.support.transitions) {
                    _this._queueEndCallbacks = true;
                    _this.transitionEnd(params.onSlideChangeEnd)
                }
                else {
                    setTimeout(function(){
                        params.onSlideChangeEnd(_this)
                    },10)
                }    
            }
            else if (!params.queueEndCallbacks) {
                if(_this.support.transitions) {
                    _this.transitionEnd(params.onSlideChangeEnd)
                }
                else {
                    setTimeout(function(){
                        params.onSlideChangeEnd(_this)
                    },10)
                }

            }
            
        }
    }
    
    _this.updateActiveSlide = function(position) {
        _this.previousIndex = _this.previousSlide = _this.realIndex
        _this.realIndex = Math.round(-position/slideSize)
        if (!params.loop) _this.activeIndex = _this.realIndex;
        else {
            _this.activeIndex = _this.realIndex-params.slidesPerSlide
            if (_this.activeIndex>=numOfSlides-params.slidesPerSlide*2) {
                _this.activeIndex = numOfSlides - params.slidesPerSlide*2 - _this.activeIndex
            }
            if (_this.activeIndex<0) {
                _this.activeIndex = numOfSlides - params.slidesPerSlide*2 + _this.activeIndex   
            }
        }
        if (_this.realIndex==numOfSlides) _this.realIndex = numOfSlides-1
        if (_this.realIndex<0) _this.realIndex = 0
        //Legacy
        _this.activeSlide = _this.activeIndex;
        //Update Pagination
        if (params.pagination) {
            _this.updatePagination()
        }
        
    }
    
    /*=========================
      Loop Fixes
      ===========================*/
    _this.fixLoop = function(){     
        //Fix For Negative Oversliding
        if (_this.realIndex < params.slidesPerSlide) {
            var newIndex = numOfSlides - params.slidesPerSlide*3 + _this.realIndex;
            _this.swipeTo(newIndex,0, false)
        }
        //Fix For Positive Oversliding
        if (_this.realIndex > numOfSlides - params.slidesPerSlide*2) {
            var newIndex = -numOfSlides + _this.realIndex + params.slidesPerSlide
            _this.swipeTo(newIndex,0, false)
        }
    }
    if (params.loop) {
        _this.swipeTo(0,0, false)
    }

    

}

Swiper.prototype = {
    plugins : {},
    //Transition End
    transitionEnd : function(callback, permanent) {
        var a = this
        var el = a.wrapper
        var events = ['webkitTransitionEnd','transitionend', 'oTransitionEnd', 'MSTransitionEnd', 'msTransitionEnd'];
        if (callback) {
            function fireCallBack() {
                callback(a)
                a._queueEndCallbacks = false
                if (!permanent) {
                    for (var i=0; i<events.length; i++) {
                        el.removeEventListener(events[i], fireCallBack, false)
                    }
                }
            }
            for (var i=0; i<events.length; i++) {
                el.addEventListener(events[i], fireCallBack, false)
            }
        }
    },
    
    //Touch Support
    isSupportTouch : function() {
        return ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch;
    },
    //Transition Support
    isSupportTransitions : function(){
        var div = document.createElement('div').style
        return ('transition' in div) || ('WebkitTransition' in div) || ('MozTransition' in div) || ('msTransition' in div) || ('MsTransition' in div) || ('OTransition' in div);
    },
    // 3D Transforms Test 
    isSupport3D : function() {
        var div = document.createElement('div');
        div.id = 'test3d';
            
        var s3d=false;  
        if("webkitPerspective" in div.style) s3d=true;
        if("MozPerspective" in div.style) s3d=true;
        if("OPerspective" in div.style) s3d=true;
        if("MsPerspective" in div.style) s3d=true;
        if("perspective" in div.style) s3d=true;

        /* Test with Media query for Webkit to prevent FALSE positive*/ 
        if(s3d && ("webkitPerspective" in div.style) ) {
            var st = document.createElement('style');
            st.textContent = '@media (-webkit-transform-3d), (transform-3d), (-moz-transform-3d), (-o-transform-3d), (-ms-transform-3d) {#test3d{height:5px}}'
            document.getElementsByTagName('head')[0].appendChild(st);
            document.body.appendChild(div);
            s3d = div.offsetHeight === 5;
            st.parentNode.removeChild(st);
            div.parentNode.removeChild(div);
        }
        
        return s3d;
    },
        
    //GetTranslate
    getTranslate : function(axis){
        var el = this.wrapper
        var matrix;
        var curTransform;
        if (window.WebKitCSSMatrix) {
            var transformMatrix = new WebKitCSSMatrix(window.getComputedStyle(el, null).webkitTransform)
            matrix = transformMatrix.toString().split(',');
        }
        else {
            var transformMatrix =   window.getComputedStyle(el, null).MozTransform || window.getComputedStyle(el, null).OTransform || window.getComputedStyle(el, null).MsTransform || window.getComputedStyle(el, null).msTransform  || window.getComputedStyle(el, null).transform|| window.getComputedStyle(el, null).getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,");
            matrix = transformMatrix.toString().split(',');
            
        }
        if (this.params.useCSS3Transforms) { 
            if (axis=='x') {
                //Crazy IE10 Matrix
                if (matrix.length==16) 
                    curTransform = parseFloat( matrix[12] )
                //Latest Chrome and webkits Fix
                else if (window.WebKitCSSMatrix)
                    curTransform = transformMatrix.m41
                //Normal Browsers
                else 
                    curTransform = parseFloat( matrix[4] )
            }
            if (axis=='y') {
                //Crazy IE10 Matrix
                if (matrix.length==16) 
                    curTransform = parseFloat( matrix[13] )
                //Latest Chrome and webkits Fix
                else if (window.WebKitCSSMatrix)
                    curTransform = transformMatrix.m42
                //Normal Browsers
                else 
                    curTransform = parseFloat( matrix[5] )
            }
        }
        else {
            if (axis=='x') curTransform = parseFloat(el.style.left,10) || 0
            if (axis=='y') curTransform = parseFloat(el.style.top,10) || 0
        }
        return curTransform;
    },
    
    //Set Transform
    setTransform : function(x,y,z) {
        
        var es = this.wrapper.style
        x=x||0;
        y=y||0;
        z=z||0;
        if (this.params.useCSS3Transforms) {
            if (this.support.threeD) {
                es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate3d('+x+'px, '+y+'px, '+z+'px)'
            }
            else {
                
                es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate('+x+'px, '+y+'px)'
                if (this.ie8) {
                    es.left = x+'px'
                    es.top = y+'px'
                }
            }
        }
        else {
            es.left = x+'px';
            es.top = y+'px';
        }
        this.callPlugins('onSetTransform', {x:x, y:y, z:z})
    },
    
    //Set Transition
    setTransition : function(duration) {
        var es = this.wrapper.style
        es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = duration/1000+'s';
        this.callPlugins('onSetTransition', {duration: duration})
    },
    
    //Check for IE8
    ie8: (function(){
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv != -1 && rv < 9;
    })(),
    
    ie10 : window.navigator.msPointerEnabled
}

/*=========================
  jQuery & Zepto Plugins
  ===========================*/   
if (window.jQuery||window.Zepto) {
    (function($){
        $.fn.swiper = function(params) {
            var s = new Swiper($(this)[0], params)
            $(this).data('swiper',s);
            return s
        }
    })(window.jQuery||window.Zepto)
}
// Generated by CoffeeScript 1.6.2
/*
jQuery Waypoints - v2.0.3
Copyright (c) 2011-2013 Caleb Troughton
Dual licensed under the MIT license and GPL license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function(){var t=[].indexOf||function(t){for(var e=0,n=this.length;e<n;e++){if(e in this&&this[e]===t)return e}return-1},e=[].slice;(function(t,e){if(typeof define==="function"&&define.amd){return define("waypoints",["jquery"],function(n){return e(n,t)})}else{return e(t.jQuery,t)}})(this,function(n,r){var i,o,l,s,f,u,a,c,h,d,p,y,v,w,g,m;i=n(r);c=t.call(r,"ontouchstart")>=0;s={horizontal:{},vertical:{}};f=1;a={};u="waypoints-context-id";p="resize.waypoints";y="scroll.waypoints";v=1;w="waypoints-waypoint-ids";g="waypoint";m="waypoints";o=function(){function t(t){var e=this;this.$element=t;this.element=t[0];this.didResize=false;this.didScroll=false;this.id="context"+f++;this.oldScroll={x:t.scrollLeft(),y:t.scrollTop()};this.waypoints={horizontal:{},vertical:{}};t.data(u,this.id);a[this.id]=this;t.bind(y,function(){var t;if(!(e.didScroll||c)){e.didScroll=true;t=function(){e.doScroll();return e.didScroll=false};return r.setTimeout(t,n[m].settings.scrollThrottle)}});t.bind(p,function(){var t;if(!e.didResize){e.didResize=true;t=function(){n[m]("refresh");return e.didResize=false};return r.setTimeout(t,n[m].settings.resizeThrottle)}})}t.prototype.doScroll=function(){var t,e=this;t={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};if(c&&(!t.vertical.oldScroll||!t.vertical.newScroll)){n[m]("refresh")}n.each(t,function(t,r){var i,o,l;l=[];o=r.newScroll>r.oldScroll;i=o?r.forward:r.backward;n.each(e.waypoints[t],function(t,e){var n,i;if(r.oldScroll<(n=e.offset)&&n<=r.newScroll){return l.push(e)}else if(r.newScroll<(i=e.offset)&&i<=r.oldScroll){return l.push(e)}});l.sort(function(t,e){return t.offset-e.offset});if(!o){l.reverse()}return n.each(l,function(t,e){if(e.options.continuous||t===l.length-1){return e.trigger([i])}})});return this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}};t.prototype.refresh=function(){var t,e,r,i=this;r=n.isWindow(this.element);e=this.$element.offset();this.doScroll();t={horizontal:{contextOffset:r?0:e.left,contextScroll:r?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:r?0:e.top,contextScroll:r?0:this.oldScroll.y,contextDimension:r?n[m]("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return n.each(t,function(t,e){return n.each(i.waypoints[t],function(t,r){var i,o,l,s,f;i=r.options.offset;l=r.offset;o=n.isWindow(r.element)?0:r.$element.offset()[e.offsetProp];if(n.isFunction(i)){i=i.apply(r.element)}else if(typeof i==="string"){i=parseFloat(i);if(r.options.offset.indexOf("%")>-1){i=Math.ceil(e.contextDimension*i/100)}}r.offset=o-e.contextOffset+e.contextScroll-i;if(r.options.onlyOnScroll&&l!=null||!r.enabled){return}if(l!==null&&l<(s=e.oldScroll)&&s<=r.offset){return r.trigger([e.backward])}else if(l!==null&&l>(f=e.oldScroll)&&f>=r.offset){return r.trigger([e.forward])}else if(l===null&&e.oldScroll>=r.offset){return r.trigger([e.forward])}})})};t.prototype.checkEmpty=function(){if(n.isEmptyObject(this.waypoints.horizontal)&&n.isEmptyObject(this.waypoints.vertical)){this.$element.unbind([p,y].join(" "));return delete a[this.id]}};return t}();l=function(){function t(t,e,r){var i,o;r=n.extend({},n.fn[g].defaults,r);if(r.offset==="bottom-in-view"){r.offset=function(){var t;t=n[m]("viewportHeight");if(!n.isWindow(e.element)){t=e.$element.height()}return t-n(this).outerHeight()}}this.$element=t;this.element=t[0];this.axis=r.horizontal?"horizontal":"vertical";this.callback=r.handler;this.context=e;this.enabled=r.enabled;this.id="waypoints"+v++;this.offset=null;this.options=r;e.waypoints[this.axis][this.id]=this;s[this.axis][this.id]=this;i=(o=t.data(w))!=null?o:[];i.push(this.id);t.data(w,i)}t.prototype.trigger=function(t){if(!this.enabled){return}if(this.callback!=null){this.callback.apply(this.element,t)}if(this.options.triggerOnce){return this.destroy()}};t.prototype.disable=function(){return this.enabled=false};t.prototype.enable=function(){this.context.refresh();return this.enabled=true};t.prototype.destroy=function(){delete s[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};t.getWaypointsByElement=function(t){var e,r;r=n(t).data(w);if(!r){return[]}e=n.extend({},s.horizontal,s.vertical);return n.map(r,function(t){return e[t]})};return t}();d={init:function(t,e){var r;if(e==null){e={}}if((r=e.handler)==null){e.handler=t}this.each(function(){var t,r,i,s;t=n(this);i=(s=e.context)!=null?s:n.fn[g].defaults.context;if(!n.isWindow(i)){i=t.closest(i)}i=n(i);r=a[i.data(u)];if(!r){r=new o(i)}return new l(t,r,e)});n[m]("refresh");return this},disable:function(){return d._invoke(this,"disable")},enable:function(){return d._invoke(this,"enable")},destroy:function(){return d._invoke(this,"destroy")},prev:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e>0){return t.push(n[e-1])}})},next:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e<n.length-1){return t.push(n[e+1])}})},_traverse:function(t,e,i){var o,l;if(t==null){t="vertical"}if(e==null){e=r}l=h.aggregate(e);o=[];this.each(function(){var e;e=n.inArray(this,l[t]);return i(o,e,l[t])});return this.pushStack(o)},_invoke:function(t,e){t.each(function(){var t;t=l.getWaypointsByElement(this);return n.each(t,function(t,n){n[e]();return true})});return this}};n.fn[g]=function(){var t,r;r=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(d[r]){return d[r].apply(this,t)}else if(n.isFunction(r)){return d.init.apply(this,arguments)}else if(n.isPlainObject(r)){return d.init.apply(this,[null,r])}else if(!r){return n.error("jQuery Waypoints needs a callback function or handler option.")}else{return n.error("The "+r+" method does not exist in jQuery Waypoints.")}};n.fn[g].defaults={context:r,continuous:true,enabled:true,horizontal:false,offset:0,triggerOnce:false};h={refresh:function(){return n.each(a,function(t,e){return e.refresh()})},viewportHeight:function(){var t;return(t=r.innerHeight)!=null?t:i.height()},aggregate:function(t){var e,r,i;e=s;if(t){e=(i=a[n(t).data(u)])!=null?i.waypoints:void 0}if(!e){return[]}r={horizontal:[],vertical:[]};n.each(r,function(t,i){n.each(e[t],function(t,e){return i.push(e)});i.sort(function(t,e){return t.offset-e.offset});r[t]=n.map(i,function(t){return t.element});return r[t]=n.unique(r[t])});return r},above:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset<=t.oldScroll.y})},below:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset>t.oldScroll.y})},left:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset<=t.oldScroll.x})},right:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset>t.oldScroll.x})},enable:function(){return h._invoke("enable")},disable:function(){return h._invoke("disable")},destroy:function(){return h._invoke("destroy")},extendFn:function(t,e){return d[t]=e},_invoke:function(t){var e;e=n.extend({},s.vertical,s.horizontal);return n.each(e,function(e,n){n[t]();return true})},_filter:function(t,e,r){var i,o;i=a[n(t).data(u)];if(!i){return[]}o=[];n.each(i.waypoints[e],function(t,e){if(r(i,e)){return o.push(e)}});o.sort(function(t,e){return t.offset-e.offset});return n.map(o,function(t){return t.element})}};n[m]=function(){var t,n;n=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(h[n]){return h[n].apply(null,t)}else{return h.aggregate.call(null,n)}};n[m].settings={resizeThrottle:100,scrollThrottle:30};return i.load(function(){return n[m]("refresh")})})}).call(this);
/* Sandbox: end */