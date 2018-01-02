
var Calendar = function(){
	var instance = null;
	function CalendarFunction(){
		this.templateId = 'calendarTemp';
		this.renderTo = 'calendar';
		this.year = 0;
		this.mounth = 0;
		this.date = 0;
		this.eventUrl = '';
		this.todayDay = new Date().getDate();
		this.todayMonth = new Date().getMonth()+1;
		this.todayYear = new Date().getFullYear();
		this.inMonth = 'inMonth';
		this.outMonth = 'outMonth';
		this.setEventUrl = function(url){
			this.eventUrl = url;
			return this;
		};
		this.setDate = function (date){
			var _date = '';
			if( typeof(date) != 'undefined' && date) {
				_date = new Date(date);
				if(_date == 'Invalid Date') {
					_date = new Date();
				}
			}
			else {
				_date = new Date();
			}
			this.date = _date;
			this.month = _date.getMonth() + 1;
			this.year = _date.getFullYear();
			return this;
		};
		this.setDate();
		this.daysTemp = [];
		this.days = [];
		this.firstWeekDay = 0;
		this.monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		this.monthNamesShort = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		this.dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		this.dayNamesShort = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
		this.eventCallback = function(){};
		this.getDay = function(){
			this.daysTemp = [];
			var _monthFirstDay = new Date(this.year +'/'+this.month+'/01');
			var _monthFirstDayWeekDay = _monthFirstDay.getDay();
			if(_monthFirstDayWeekDay == this.firstWeekDay){
				//this.daysTemp.push({month:this.month,day:1})
			}
			else {
				var _preMonthDay = new Date(_monthFirstDay - 3600*24*1000);
				var _preMonthDayWeekDay = _preMonthDay.getDay();
				
				while(_preMonthDayWeekDay != this.firstWeekDay){
					this.daysTemp.unshift( {year:_preMonthDay.getFullYear(),month:_preMonthDay.getMonth()+1,day:_preMonthDay.getDate(),thisMonth:this.outMonth} );
					_preMonthDay = new Date(_preMonthDay - 3600*24*1000);
					_preMonthDayWeekDay = _preMonthDay.getDay();
				}
				this.daysTemp.unshift( {year:_preMonthDay.getFullYear(),month:_preMonthDay.getMonth()+1,day:_preMonthDay.getDate(),thisMonth:this.outMonth} );
			}
			var i=1;
			for(i;i<=27;i++){
				if(this.todayDay == i && this.month == this.todayMonth && this.year == this.todayYear) {
					this.daysTemp.push({year:this.year,month:this.month,day:i,thisMonth:this.inMonth,today:'today'});
				}
				else {
					this.daysTemp.push( {year:this.year,month:this.month,day:i,thisMonth:this.inMonth} );
				}
			}
			var _monthEndDay = '';
			var _monthEndDayMonth = '';
			var ifEnd = false;
			var _weekDay = 0;
			for(i;i<=32;i++){
				_monthEndDay = new Date(this.year + '/' + this.month + '/' + i);
				_monthEndDayMonth  = _monthEndDay.getMonth()+1;
				if(isNaN(_monthEndDayMonth)){
					_monthEndDay = new Date(this.year + '/' + this.month + '/' + (i -1) ) -  (-3600*24*1000);
				}
				if(_monthEndDayMonth == this.month && i!=32) {
					if(this.todayDay == i){
						this.daysTemp.push({year:this.year,month:this.month,day:i,thisMonth:this.inMonth,today:'today'});
					}
					else {
						this.daysTemp.push({year:this.year,month:this.month,day:i,thisMonth:this.inMonth});
					}
					
					_weekDay = _monthEndDay.getDay();
				}
				else {
					if((_weekDay + 1 )%7 == this.firstWeekDay ){
						ifEnd = true;
					}
					break;
				}
			}
			var j=0;
			if(ifEnd == false) {
				var _nextMonthDay,_nextMonthDayWeekDay;
				for(j;j<=7;j++){
					_nextMonthDay = new Date(_monthEndDay - (0-3600*24*1000*j) );
					
					_nextMonthDayWeekDay = _nextMonthDay.getDay();
					if(_nextMonthDayWeekDay != this.firstWeekDay ){
						this.daysTemp.push({year:_nextMonthDay.getFullYear(),month:_nextMonthDay.getMonth()+1,day:_nextMonthDay.getDate(),thisMonth:this.outMonth});
					}
					else {
						break;
					}
				}
				//this.daysTemp.push({month:_nextMonthDay.getMonth()+1,day:_nextMonthDay.getDate()});
			}
			var k = 0;
			var count = this.daysTemp.length;
			this.days = [];
			for(k;k<count;k++) {
				var _row = Math.floor(k/7);
				if(typeof(this.days[_row]) == 'undefined'){
					this.days[_row] = [];
				}
				this.daysTemp[k].weekDay = this.dayNamesShort[(this.firstWeekDay+k)%7];
				this.days[_row].push(this.daysTemp[k]);
			}
			return this.days;
		};
		this.move = function(month) {
			var _date = new Date(new Date(this.year +'/'+this.month+'/15') - ( 0- month *24 *3600*1000*17) ); //day 15 + - 17days always prev or next month
			this.setDate(_date);
			this.render();
			//alert('move'+_date);
		};
		this.render = function(){
			$("#"+this.renderTo).empty();
			this.getDay();
			var _data = {};
			_data['month'] = this.monthNames[this.month - 1] + ', '+ this.year;
			_data['rows'] = this.days;
			$("#"+this.renderTo).setTemplateElement(this.templateId).processTemplate(_data);
			if(this.eventUrl){
				this.getEvent();
			}
			
			var _crmonthName = this.monthNames[this.month - 1];
			$('#current_month_name').val(_crmonthName);
			var _crmonthNo = this.month;
			$('#current_month_no').val(_crmonthNo);
			var _cryearhNo = this.year;
			$('#current_year_no').val(_cryearhNo);
			
		};

		this.getEvent = function(){
			var _self = this;
			var _start = this.daysTemp.shift();
			this.daysTemp.unshift(_start);
			var _end = this.daysTemp.pop();
			this.daysTemp.push(_end);
			var _startDate = _start.year + '-' + _start.month + '-' + _start.day;
			var _endDate = _end.year + '-' + _end.month + '-' + _end.day;
			var _uid = $('#calendar').attr('uid');
			var getData = {start:_startDate,end:_endDate};
			if(typeof(_uid) != 'undefined' &&_uid != ''){
				getData['uid'] = _uid;
			}
			$.getJSON(this.eventUrl+'?'+Math.random(),getData,function(json){
				if (String == json.constructor) {
					eval ('var json = ' + json);
				} else {
					var json = json;
				}
				if(typeof(json.status)!='undefined' && !json.status){
					alert(json.msg);
					return;
				}

				$.each(json,function(k,v){
					var _countClass = 'count0';
					if(v.count > 0 && v.count < 5){
						_countClass = 'count1'
					}
					else if(v.count >= 5 && v.count < 10){
						_countClass = 'count1';
					}
					else if(v.count >=  10){
						_countClass = 'count3'
					}
					$('.col .day_'+ parseInt(v.month,10) + '_'+ parseInt(v.day,10) +' .event').html('<a href="javascript:void(0)" day="'+v.date+'"><span class="'+_countClass+'">'+v.count+'</span> Sessions</a>');
					
					//--R&D@Sept-18-2013 : Highlight Booked date
					if(_countClass == "count1"  || _countClass =="count3"){
						if(v.booked != 0){
							var bookingString = parseInt(v.month,10) + '_'+ parseInt(v.day,10); 
							if($("#"+bookingString).length != 0){ 
							}else{
								$('.col .day_'+ parseInt(v.month,10) + '_'+ parseInt(v.day,10) +' .event').before('<h2 id="'+bookingString+'" style="background-color:#CCCCCC;color:red;width:5px;float:left;margin-top:30px;padding-left:5px;"><img src="../../../images/orange-dot.png"></h2>');
							}
						}
						//console.log(json);

					}
					//--R&D@Sept-18-2013 : Highlight Booked date
					
					//console.info($('.col .day_'+ parseInt(v.month) + '_'+ parseInt(v.day) +' .event'), parseInt(v.month), parseInt(v.day),v.day)
				})
				_self.eventCallback();
			})
			if($("#bNote").length != 0){ 
		
			}else {
				$('#calendar').after('<h3 id="bNote" style="color:red;"><img src="../../../images/orange-dot.png"> = booking</h3>');
			}
			
		};

	}
	return {
        getInstance: function(code) {
            if (typeof(instance) == 'undefined' || !instance) {
                instance = new CalendarFunction();
            }
            return instance;
        }
		
    }
}();

var cv_sqs_histogramRow = function() {
    var instances = [];
    function histogramRow(code) {
        this.histogramRowTemplate = 'histogramRowTemplate';
        this.histogramTemplate = 'histogramTemplate';
        this.sector = '.id-criteria_rows_tbody';
        this.histogramRow = $("#row_" + code);
        this.histogramContanler = '';
        this.code = code;
        this.showName = '';
        this.minInput = '';
        this.leftHandle = '';
        this.histogram = '';
        this.rightHandle = '';
        this.maxInput = '';
        this.delIcon = '';
        this.sqrtMaxCount = '';
        var selfObj = this;
        this.getHistogramRow = function() {
            if (!this.histogramRow || !this.histogramRow.get(0)) {
                this.histogramRow = $("#row_" + this.code)
            }
            return this.histogramRow
        };
        this.getHistogramContanler = function() {
            if (!this.histogramContanler || this.getHistogramRow()) {
                this.histogramContanler = this.histogramRow.children('td.range')
            }
            return this.histogramContanler
        };
        this.getShowNameNode = function() {
            if (!this.showName || this.getHistogramRow()) {
                this.showName = this.histogramRow.children('td.field_name')
            }
            return this.showName
        };
        this.getMinInputNode = function() {
            if (!this.minInput || this.getHistogramRow()) {
                this.minInput = this.histogramRow.find('td.align_left .field_input_default_left')
            }
            return this.minInput
        };
        this.getLeftHandleNode = function() {
            if (!this.leftHandle || this.getHistogramRow()) {
                this.leftHandle = this.histogramRow.find('.sliderimage_left')
            }
            return this.leftHandle
        };
        this.getHistogramNode = function() {
            if (!this.histogram || this.getHistogramRow()) {
                this.histogram = this.histogramRow.find(".histogramNode")
            }
            return this.histogram
        };
        this.getRightHandleNode = function() {
            if (!this.rightHandle || this.getHistogramRow()) {
                this.rightHandle = this.histogramRow.find('.sliderimage_right')
            }
            return this.rightHandle
        };
        this.getDelIconNode = function() {
            if (!this.delIcon || this.getHistogramRow()) {
                this.delIcon = this.histogramRow.find('.delete')
            }
            return this.delIcon
        };
        this.getMaxInputNode = function() {
            if (!this.maxInput || this.getHistogramRow()) {
                this.maxInput = this.histogramRow.find('td.align_right .field_input_default_right')
            }
            return this.maxInput
        };
        this.addRow = function(data) {
            if (typeof(this.histogramRow.get(0)) != 'undefined') {
                this.histogramRow.empty()
            }
            var temp = $("<div></div>");
            temp.setTemplateElement(this.histogramRowTemplate);
            temp.processTemplate(data);
            this.histogramRow = temp.children();
            $(this.sector).append(this.histogramRow);
            if (typeof(data.values) != 'undefined') {
                this.drawHistGram(data)
            }
            this.bindEvents()
        };
        this.drawHistGram = function(data) {
            var histogramNode = this.getHistogramNode();
            histogramNode.empty();
            histogramNode.setTemplateElement(this.histogramTemplate);
            histogramNode.processTemplate(data);
            this.bindDroppable(histogramNode.find('td'), this.code);
            this.getRightHandleNode().parent().attr('valCount', data.end_value);
            this.getLeftHandleNode().parent().attr('valCount', data.start_value)
        };
        this.bindDroppable = function(obj, field, type) {
            if (typeof(type) == 'undefined') {
                type = 'fit1'
            }
            obj.droppable({
                activeClass: "active",
                hoverClass: "hover",
                accept: '#sliderimage_' + field + '_left,#sliderimage_' + field + '_right',
                greedy: false,
                tolerance: type,
                drop: function(event, ui) {
                    selfObj.setInputboxValue(event, ui, field, $(this));
                    clearTimeout(cv_sqs.timeout);
                    cv_sqs.timeout = setTimeout(function() {
                        cv_sqs.getData()
                    },
                    300)
                },
                over: function(event, ui) {
                    selfObj.setInputboxValue(event, ui, field, $(this))
                },
                out: function() {}
            })
        };
        this.setInputboxValue = function(event, ui, field, _thisObj) {
            var _leftSector = '';
            var _rightSector = '';
            if (ui.helper[0].id.substr( - 5) == '_left') {
                _oppositeSector = 'right'
            } else {
                _oppositeSector = 'left'
            }
            var _oppositeHandle = $('#sliderimage_' + field + '_' + _oppositeSector);
            if (_oppositeHandle.offset().left < ui.offset.left) {
                selfObj.setMaxInputValue(_thisObj.attr('valCount'))
            } else {
                selfObj.setMinInputValue(_thisObj.attr('valCount'))
            }
        };
        this.bindEvents = function() {
            this.bindLeftHandleEvent();
            this.bindRightHandleEvent();
            this.bindDeleteEvent()
        };
        this.delRow = function() {
            hasCheckedCriteria = $.grep(hasCheckedCriteria, 
            function(n, i) {
                return n == selfObj.code
            },
            true);
            this.histogramRow.remove();
            cv_sqs.reBuildGrid();
            clearTimeout(cv_sqs.timeout);
            cv_sqs.timeout = setTimeout(function() {
                cv_sqs.getData()
            },
            300);
            cv_sqs_histogramRow.removeInstance(this.code)
        };
        this.bindDeleteEvent = function() {
            this.getDelIconNode().click(function() {
                selfObj.delRow()
            })
        };
        this.bindLeftHandleEvent = function() {
            this.getLeftHandleNode().draggable({
                axis: 'x',
                containment: this.getHistogramContanler()
            });
            this.bindDroppable(this.getLeftHandleNode().parent(), this.code, 'fit2')
        };
        this.bindRightHandleEvent = function() {
            this.getRightHandleNode().draggable({
                axis: 'x',
                containment: this.getHistogramContanler()
            });
            this.bindDroppable(this.getRightHandleNode().parent(), this.code, 'fit2')
        };
        this.setMinInputValue = function(val) {
            this.getMinInputNode().val(val)
        };
        this.setMaxInputValue = function(val) {
            this.getMaxInputNode().val(val)
        };
        this.setSqrtMaxCount = function(maxCount) {
            this.sqrtMaxCount = Math.pow(maxCount, 1 / 4)
        };
        this.getHeight = function(_count) {
            var height = (Math.pow(_count, 1 / 4) / this.sqrtMaxCount) * 25;
            if (height < 1) {
                height = 1
            } else if (height > 25) {
                height = 25
            }
            return height
        }
    };
    return {
        getInstance: function(code) {
            if (typeof(instances[code]) == 'undefined' || !instances[code]) {
                instances[code] = new histogramRow(code)
            }
            return instances[code]
        },
        removeInstance: function(code) {
            delete instances[code]
        }
    }
} ();

function getTimeZone(zone){
	_zone = zone.substr(0,4)+'.'+zone.substr(4);
	_zone = _zone.substr(2);
	if(_zone > 14){
		_zone = _zone /10;
	}
	if(zone.indexOf('UM') > -1){
		_zone = -_zone;
	}
	if(isNaN(_zone)){
		_zone = 0;
	}
	//console.info(_zone);
	return _zone;
}

function getNowDateAndShow(){
    
	var localTimeZone = new Date().getTimezoneOffset() / 60;
	var sLocalTimeZone = Math.abs(localTimeZone).toString();
	var _dotIndex = sLocalTimeZone.indexOf('.');
	if(_dotIndex > -1){
		sLocalTimeZone = sLocalTimeZone.subStr(0,(_dotIndex+1))+''+sLocalTimeZone.subStr((_dotIndex+1));
	}
	var _sector = 'UTC'; 
	if(localTimeZone > 0){
		_sector = 'UM'+sLocalTimeZone;
	}
	else if(localTimeZone < 0){
		_sector = 'UP'+sLocalTimeZone;
	}
	
	var _date = new Date();
	var _dateStr =  _date.getFullYear() +'/'+(_date.getMonth()+1).num2format(2)+'/'+_date.getDate().num2format(2)+' '+_date.getHours().num2format(2)+':'+_date.getMinutes().num2format(2)
	$('.timezoneCal.timezoneFrom').val(_sector)
	$('#fromTime').val(_dateStr);
	
	
	
	setTimeout(function(){
		$('#fromTime').trigger('change');
	},200)
}

$(function(){
	
	$('.timezoneCal').change(function(){
		//alert('hi+'+_toTimeDate.getMonth());
		var _fromTime = $('#fromTime').val();
		var _timeZoneFrom = $('.timezoneFrom').val();
		var _timeZoneTo = $('.timezoneTo').val();
		_timeZoneFrom =getTimeZone(_timeZoneFrom);
		_timeZoneTo =getTimeZone(_timeZoneTo);
		
		var _zone = _timeZoneFrom - _timeZoneTo;
		var _fromTimeDate = new Date(_fromTime);
		if(typeof(_fromTimeDate)=='Invalid Date' || _fromTimeDate == 'Invalid Date'){
			$('#toTime').val('Invalid Date')
		}
		var _toTimeDate = _fromTimeDate - _zone*3600*1000;
		_toTimeDate = new Date(_toTimeDate);
		var _toTimeDateStr = _toTimeDate.getFullYear() +'/'+(_toTimeDate.getMonth()+1).num2format(2)+'/'+_toTimeDate.getDate().num2format(2)+' '+_toTimeDate.getHours().num2format(2)+':'+_toTimeDate.getMinutes().num2format(2);
		$('#toTime').val(_toTimeDateStr);
		//console.info('[day='+_toTimeDate.getFullYear() +'-'+(_toTimeDate.getMonth()+1).num2format(2)+'-'+_toTimeDate.getDate().num2format(2)+']');
		$('[day='+_toTimeDate.getFullYear() +'-'+(_toTimeDate.getMonth()+1).num2format(2)+'-'+_toTimeDate.getDate().num2format(2)+']','.event').trigger('mouseover');
		//console.info(_fromTimeDate);
		//console.info(_zone);
	})
	/*$('#timepicker').datetimepicker({
		altField: "#fromTime",
		altFieldTimeOnly: false,
		stepMinute:30,
		minDate: new Date(),
		onSelect:function(m,n){
			console.info(this,m,n);
			$('#fromTime').trigger('change');
		}
	});
	$('#timepicker').datetimepicker('setDate', (new Date()) );*/
	var _date = new Date();
	var _crmonth = (_date.getMonth()+1).num2format(2);
	//alert('hi-'+_crmonth);
	if($('#current_month'))
	{
		//$('#current_month').val(_crmonth);
	}else{
		//alert('no element found');
	}
})
