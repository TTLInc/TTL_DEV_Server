$.editable.addInputType('names', {
    element : function(settings, original) {
		//console.info(settings,$(this).html());
        var input = $('<span><input class="first" value="First" onBlur="if (this.value == \'\') {this.value = \'First\';}" onFocus="if(this.value == \'First\') {this.value = \'\';}" /> <input style="margin-top:3px;" class="last" value="Last" onBlur="if(removeSpaces(this.value) == \'\') {this.value = \'Last\';}" onFocus="if(removeSpaces(this.value) == \'Last\'){this.value = \'\';}"  /></span>');
        if (settings.rows) {
            //input.attr('rows', settings.rows);
        } else {
            //input.height(settings.height);
        }
        if (input.cols) {
            //input.attr('cols', settings.cols);
        } else {
            //input.width(settings.width);
        }
        $(this).append(input);
		
        return(input);
    }/*,
    plugin : function(settings, original) {
        $('textarea', this).charCounter(settings.charcounter.characters, settings.charcounter);
    }*/
	,content : function(string, settings, original) {
		names = string.split(' ');
		
		if(names[0] =='')
		{
			names[0] = 'First';
		}
		if(names[1] =='')
		{
			names[1] = 'Last';
		}
		//alert(names[0])
		$(':input.first', this).val(names[0]);
		//$(':input.sec', this).val(names[1]);
		$(':input.last', this).val(names[1]);
	}
});


$.editable.addInputType('score', {
    element : function(settings, original) {
		var input = $('<span>Last TOIEC Score<input class="first"/>Last TOEFL Score<input class="sec"/>Last OPIc Score<input class="third"/>Current TOIEC Score<input class="fourth"/>Current TOEFL Score<input class="fifth"/>Current OPIc Score<input class="last"/></span>');
        if (settings.rows) {
            input.attr('rows', settings.rows);
        } else {
            input.height(settings.height);
        }
        if (input.cols) {
            input.attr('cols', settings.cols);
        } else {
            input.width(settings.width);
        }
        $(this).append(input);
        return(input);
    }/*,
    plugin : function(settings, original) {
        $('textarea', this).charCounter(settings.charcounter.characters, settings.charcounter);
    }*/
	,content : function(string, settings, original) {
		names = string.split(' ');
		$(':input.first', this).val(names[0]);
		$(':input.sec', this).val(names[1]);
		$(':input.third', this).val(names[2]);
		$(':input.fourth', this).val(names[3]);
		$(':input.fifth', this).val(names[4]);
		$(':input.last', this).val(names[5]);
	}
});

$.editable.addInputType('aboutMe', {
    element : function(settings, original) {
		//console.info(settings,$(this).html());
        var input = $('<span>Professional<input class="professional"/> Academic <input class="academic"/> Interests <input class="interests"/> Other <input class="other"/></span>');
        if (settings.rows) {
            input.attr('rows', settings.rows);
        } else {
            input.height(settings.height);
        }
        if (input.cols) {
            input.attr('cols', settings.cols);
        } else {
            input.width(settings.width);
        }
        $(this).append(input);
        return(input);
    }/*,
    plugin : function(settings, original) {
        $('textarea', this).charCounter(settings.charcounter.characters, settings.charcounter);
    }*/
	,content : function(string, settings, original) {
		var _obj = $(string);
		//console.info($('.professional',_obj).attr('title'));
		//console.info(string);
		names = string.split(' ');
		$(':input.professional', this).val($('.professional',_obj).attr('title'));
		$(':input.academic', this).val($('.academic',_obj).attr('title'));
		$(':input.interests', this).val($('.interests',_obj).attr('title'));
		$(':input.other', this).val($('.other',_obj).attr('title'));
	}
});


$.editable.addInputType('locations', {
    element : function(settings, original) {
		//console.info(settings,$(this).html());
		var role = settings.userRole;
		if(role == '0')
		{
			var input = $('<span><select class="country"></select> <input class="city" value="City" onBlur="if (removeSpaces(this.value) == \'\') {this.value = \'City\';}" onFocus="if(removeSpaces(this.value) == \'City\') {this.value = \'\';}"/></span>');
        }else 
		{
			var input = $('<span><select class="country"></select> <select class="provice"></select> <input style="margin-top:3px;" class="city" value="City" onBlur="if (this.value == \'\') {this.value = \'City\';}" onFocus="if(this.value == \'City\') {this.value = \'\';}"/></span>');
		}
        $(this).append(input);
		
        return(input);
    }/*,
    plugin : function(settings, original) {
        $('textarea', this).charCounter(settings.charcounter.characters, settings.charcounter);
    }*/
	,content : function(string, settings, original) {
		
		var _locations = string.split(',');
		data1 = settings.datasCountries;
		//alert(_locations[0])
		var role = settings.userRole;
		
		if(typeof( _locations[0] ) !='undefined')
		{
			
			if(trim(_locations[0]) =='')
			{
				_locations[0] = 'City';
				
			}
			$(':input.city',this).val(trim(_locations[0]));
		}
		
		if(_locations[2] != undefined)
		{
			var countryval =_locations[2];
			//alert('h1');
		}else{
			//alert('h2');
			var countryval =_locations[1];
		}
		
		//alert(countryval);
		
		mkOptions('country',this,data1,countryval,original);
		var self = this;
		
		if(role != '0')
		{
			$('select.country', this).change(function(){
				var countryEl = this;
				var cid = $(this).val();
				//var provice = settings.provices[cid];
				//provice = provices[cid];
				//}

				if( typeof( provice[cid] ) !='undefined' && provice[cid] != null) {
					mkOptions('provice',self,provice[cid],_locations[1],original);
				}
				else {
					$.get(settings.proviceUrl,{cid:$(this).val()},function(msg){
						//settings.provices[cid] = msg;
						if (String == msg.constructor) {      
							eval ('msg = ' + msg);
						} 
						provice[cid] = msg;
						$(self).data('provices',provice);
						mkOptions('provice',self,msg,_locations[1],original);
					});
				}
			});
		}
		$('select.country',this).trigger('change');
	}
});


mkOptions = function(sector,scop,data,selected,original){
	if (String == data.constructor) {      
		eval ('var json = ' + data);
	} else {
	/* Otherwise assume it is a hash already. */
		var json = data;
	}
	//alert(json['selected'])
	
	//if(!json['selected']){
		json['selected'] = $.trim(selected);
	//}
	
	//alert(json['selected'])
	
	$('select.'+sector).empty();
	for (var key in json) {
		if (!json.hasOwnProperty(key)) {
			continue;
		}
		if ('selected' == key) {
			continue;
		} 
		var option = $('<option />').val(key).append(json[key]);
		$('select.'+sector, scop).append(option);    
	}                    
	/* Loop option again to set selected. IE needed this... */ 
	$('select.'+sector, scop).children().each(function() {
		if ($(this).val() == json['selected'] ||  $(this).text() == json['selected'] ||  $(this).text() == $.trim(original.revert)) {
				$(this).attr('selected', 'selected');
		}
	});
}

function removeSpaces(string) {
 if(string == '')
 {
	return string;
 }else{
	return string.split(' ').join('');
 }
}
function trim(stringToTrim) {
	if(stringToTrim == '')
	{
		return stringToTrim;
	}else{
		return stringToTrim.split(' ').join('');
	}
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}