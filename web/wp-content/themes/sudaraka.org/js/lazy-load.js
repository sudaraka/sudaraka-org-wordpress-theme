(function($){
	
	$.fn.swfLazyLoad=function(){
		
		var pluginParam=arguments;
		
		return this.each(function(){
			
			var object=$(this).data('swfLazyLoad');
			
			//Check if element already initialized
			if(object instanceof LazyLoad){
				if(object[pluginParam[0]]) object[pluginParam[0]].apply($(this), Array.prototype.slice.call( pluginParam, 1 ));
				else $.error('Method $.swfLazyLoad.'+pluginParam[0]+' not found');
			}
			else $(this).data('swfLazyLoad', LazyLoad($(this), pluginParam[0]));
			
		});
	};
	
	$.fn.swfLazyLoad.inView=function(object){
		var top = object._element.offset().top;
		var left = object._element.offset().left;
		var width = object._element.width();
		var height = object._element.height();
		
		var pageTop=0
		var pageLeft=0
		if( typeof(window.pageYOffset)=='number'){
			pageTop=window.pageYOffset;
			pageLeft=window.pageXOffset;
		}
		else if(document.body && (document.body.scrollLeft || document.body.scrollTop)){
			pageTop=document.body.scrollTop;
			pageLeft=document.body.scrollLeft;
		}
		else if(document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)){
			pageTop=document.documentElement.scrollTop;
			pageLeft=document.documentElement.scrollLeft;
		}
		
		var pageHeight=0;
		var pageWidth=0;		
		if(window.innerWidth){
			pageHeight=window.innerHeight;
			pageWidth=window.innerWidth;
		}
		else if(document.documentElement && document.documentElement.clientWidth){
			pageHeight=document.documentElement.clientHeight;
			pageWidth=document.documentElement.clientWidth;
		}
		else if(document.body){
			pageHeight=document.body.clientHeight;
			pageWidth=document.body.clientWidth;
		}
		
//		alert(
//			top+' < ('+pageTop+' + '+pageHeight+') :'+(top < (pageTop + pageHeight))+'\n'+
//			left+' < ('+pageLeft+' + '+pageWidth+') :'+(left < (pageLeft + pageWidth))+'\n'+
//			'('+top+' + '+height+') > '+pageTop+' :'+((top + height) > pageTop)+'\n'+
//			'('+left+' + '+width+') > '+pageLeft+' :'+((left + width) > pageLeft));
		
		return (
			    top < (pageTop + pageHeight) &&
			    left < (pageLeft + pageWidth) &&
			    (top + height) > pageTop &&
			    (left + width) > pageLeft
			  );
	};
	
	$.fn.swfLazyLoad.changeState=function(object, visible){
		if(visible && object._element[0].nodeName=='IMG' && object._element.attr('_lazy_src').length>0 && object._element.attr('_lazy_src')!=object._element.attr('src')){
			object._element.attr('src', object._element.attr('_lazy_src'));
			$(window).unbind('scroll.swfLazyLoad.'+object._id);
			$(window).unbind('resize.swfLazyLoad.'+object._id);
		}
	}
	
	LazyLoad=function(element, settings){
		
		if(this instanceof LazyLoad){
			this.init(element, settings);
			return this;
		}
		
		return new LazyLoad(element, settings);
	};
	
	$.fn.swfLazyLoad.defaults={
	};
	
	$.extend(LazyLoad.prototype, {
		_settings	:	null,
		_element	:	null,
		_id			:	null,
		
		init:function(element, settings){
			this._element=element;
			this._settings=$.extend({}, $.fn.swfLazyLoad.defaults, settings);
			this._id=this._IdSegment()+this._IdSegment()+'-'+this._IdSegment()+'-'+this._IdSegment()+'-'+this._IdSegment()+'-'+this._IdSegment()+this._IdSegment()+this._IdSegment();
//			alert(this._id);
			
			var obj=this;
			$(window).bind('scroll.swfLazyLoad.'+this._id, function(e){obj.eventScroll(e)});
			$(window).bind('resize.swfLazyLoad.'+this._id, function(e){obj.eventResize(e)});
			$.fn.swfLazyLoad.changeState(this, $.fn.swfLazyLoad.inView(this));
		},
		
		eventScroll:function(event){
			$.fn.swfLazyLoad.changeState(this, $.fn.swfLazyLoad.inView(this));
		},
		
		eventResize:function(event){
			$.fn.swfLazyLoad.changeState(this, $.fn.swfLazyLoad.inView(this));
		},
		
		_IdSegment:function(){
			return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
		}
	
	});
	
})(jQuery);
