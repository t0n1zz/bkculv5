!function(e){function t(t,a,r,n){var i=t.text().split(a),o="";i.length&&(e(i).each(function(e,t){o+='<span class="'+r+(e+1)+'">'+t+"</span>"+n}),t.empty().append(o))}var a={init:function(){return this.each(function(){t(e(this),"","char","")})},words:function(){return this.each(function(){t(e(this)," ","word"," ")})},lines:function(){return this.each(function(){var a="eefec303079ad17405c889e092e105b0";t(e(this).children("br").replaceWith(a).end(),a,"line","")})}};e.fn.lettering=function(t){return t&&a[t]?a[t].apply(this,[].slice.call(arguments,1)):"letters"!==t&&t?(e.error("Method "+t+" does not exist on jQuery.lettering"),this):a.init.apply(this,[].slice.call(arguments,0))}}(jQuery);