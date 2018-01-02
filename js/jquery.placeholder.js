/*
* Placeholder plugin for jQuery
* ---
* Copyright 2010, Daniel Stocks (http://webcloud.se)
* Released under the MIT, BSD, and GPL Licenses.
*/
(function($) {
    function Placeholder(input) {
        this.input = input;
        if (input.attr('type') == 'password') {
            this.handlePassword();
        }
        // Prevent placeholder values from submitting
        $(input[0].form).submit(function() {
            if (input.hasClass('placeholder') && input[0].value == input.attr('placeholder')) {
                input[0].value = '';
            }
        });
    }
    Placeholder.prototype = {
        show : function(loading) {
            // FF and IE saves values when you refresh the page. If the user refreshes the page with
            // the placeholders showing they will be the default values and the input fields won't be empty.
            if (this.input[0].value === '' || (loading && this.valueIsPlaceholder())) {
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'text');
                    } catch (e) {
                        this.input.before(this.fakePassword.show()).hide();
                    }
                }
                this.input.addClass('placeholder');
                this.input[0].value = this.input.attr('placeholder');
            }
        },
        hide : function() {
            if (this.valueIsPlaceholder() && this.input.hasClass('placeholder')) {
                this.input.removeClass('placeholder');
                this.input[0].value = '';
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'password');
                    } catch (e) { }
                    // Restore focus for Opera and IE
                    this.input.show();
                    this.input[0].focus();
                }
            }
        },
        valueIsPlaceholder : function() {
            return this.input[0].value == this.input.attr('placeholder');
        },
        handlePassword: function() {
            var input = this.input;
            input.attr('realType', 'password');
            this.isPassword = true;
            // IE < 9 doesn't allow changing the type of password inputs
            if ($.browser.msie && input[0].outerHTML) {
                var fakeHTML = $(input[0].outerHTML.replace(/type=(['"])?password\1/gi, 'type=$1text$1'));
                this.fakePassword = fakeHTML.val(input.attr('placeholder')).addClass('placeholder').focus(function() {
                    input.trigger('focus');
                    $(this).hide();
                });
                $(input[0].form).submit(function() {
                    fakeHTML.remove();
                    input.show()
                });
            }
        }
    };
    var NATIVE_SUPPORT = !!("placeholder" in document.createElement( "input" ));
    $.fn.placeholder = function() {
        return NATIVE_SUPPORT ? this : this.each(function() {
            var input = $(this);
            var placeholder = new Placeholder(input);
            placeholder.show(true);
            input.focus(function() {
                placeholder.hide();
            });
            input.blur(function() {
                placeholder.show(false);
            });

            // On page refresh, IE doesn't re-populate user input
            // until the window.onload event is fired.
            if ($.browser.msie) {
                $(window).load(function() {
                    if(input.val()) {
                        input.removeClass("placeholder");
                    }
                    placeholder.show(true);
                });
                // What's even worse, the text cursor disappears
                // when tabbing between text inputs, here's a fix
                input.focus(function() {
                    if(this.value == "") {
                        var range = this.createTextRange();
                        range.collapse(true);
                        range.moveStart('character', 0);
                        range.select();
                    }
                });
            }
        });
    }
})(jQuery);


$.attrHooks.buttontype = { 
	set: function (elem, value) { 
		if(value == 'doing'){
			var _text = $(elem).html();
			$(elem).data('textLength',_text.length+4);
			$(elem).data('text',_text);
			clearInterval($(elem).data('interval'));
			var _interval = window.setInterval(function(){
				var text = $(elem).html();
				if (text.length < 13){
					$(elem).html(text + '.');
				} else {
					$(elem).html($(elem).data('text'));				
				}
			},200)
			$(elem).data('interval',_interval);
			//$(elem).attr("disabled","disabled")
		}
		else{
			clearInterval($(elem).data('interval'));
			$(elem).html($(elem).data('text'));
			$(elem).data('text','');
			$(elem).data('interval','') ;
			//$(elem).attr("disabled",false)
		}
	} 
}

$(function(){
	var _clientHeight = document.documentElement.clientHeight;;
	var _headerHeight = $(".head").height();
	var _footerHeight = $(".footer").outerHeight();
	var _wrapHeight = $('.wrap:has(#header)').outerHeight();
	if(_wrapHeight+_footerHeight < _clientHeight){
		//$('.wrap:has(#header)').height(_clientHeight - _footerHeight);
		$(".footer").css('margin-top',_clientHeight - _wrapHeight - _footerHeight);
	}
})

//var xhrs = [];
$.ajaxPrefilter(function(op,or,jqr){
	
	var localTimeZone = new Date().getTimezoneOffset() / 60;
	if(typeof(op.data)=='undefined'||op.data==''){
		op.data='localTimeZone='+localTimeZone;
	}else{
		op.data+='&localTimeZone='+localTimeZone;
	}
	
})

Number.prototype.num2format = function(arg1,arg2){
	if(typeof(arg1)=='undefined'){
		arg1 = 2;
	}
	var mix = Math.pow(10,(arg1-1));
	var result = '';
	if(this < mix){
		var thisStr = this.toString();
		var thisLength = thisStr.length;
		var _zeroLength = arg1 - thisLength;
		for(var i = 0;i < _zeroLength; i++){
			result += '0';
		}
		result += thisStr;
		return result;
	}
	return this;
}