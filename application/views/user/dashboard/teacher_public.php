<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal = $this->lookup_model->getValue('65', $multi_lang);
$lcalendar = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
 <div class="baseBox baseBoxBg clearfix">
    	
		<?php include dirname(__FILE__).'/../leftSide.php';?>
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo profile_menu('t_public','c_prof',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                <div id="teacher_prof_Wp">
                	<div class="mod">
                        <div class="hd">
                            <div class="pro_tle tle"><h3><?php echo $lcalendar;?></h3></div>
                        </div>
						<!--<div class="bd">
							<input type="text" id="fromTime" class="raduisSelect w105 timezoneCal"/>
							<?php echo timezone_menu('UTC',  "raduisSelect w140 timezoneCal timezoneFrom",'timezoneFrom');?>
							To
							<?php echo timezone_menu('UTC',  "raduisSelect w140 timezoneCal timezoneTo",'timezoneTo');?>
							Is<input type="text" id="toTime"  class="raduisSelect w105 timezoneCal"/>
						
                        </div>-->
                        <div class="bd">
                            <div id="calendar"  class="fc" uid="<?php echo $profile['uid'];?>"></div>
                        </div>
                    </div>                  
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
    </div>
	<textarea id="calendarTemp" style="display:none"  rows="0" cols="0">
		<!--
		<table width="720px" height="500px" cellpadding="2" cellspacing="2" border="1">
			<thead>
				<th class="prev"> <a href="javascript:Calendar.getInstance().move(-1);"> < </a></th>
				<th colspan="5" class="month"> {$T.month} </th>
				<th class="next"> <a href="javascript:Calendar.getInstance().move(1);"> > </a> </th>
			</thead>
			{#foreach $T.rows as row}
			<tr>
				{#foreach $T.row as day}
				<td class="col {$T.day.thisMonth} {$T.day.today}">
					<div class="title day_{$T.day.month}_{$T.day.day}">
						<span class="weekday">{$T.day.weekDay}</span>
						<span class="event"></span>
					</div>
					<div class="day">{$T.day.day}</div>  
				</td>
				{#/for}
			</tr>
			{#/for}
		</table>
		-->
	</textarea>
	<div id="calendarEventDialog" class="er_arr" style="display:none">
		<div>
			<span class="fl createTs " >Availability Time Slots</span>
			<span class="statusBar" style="margin-left:10px;display:none">Loading...</span>
			<span class="fr myList" style="display:none" >My Sessions</span>
		</div>
		<div class="clear"></div>
		<div class="dayStr">Tuesday 19 2012</div>
		<div style="height: 240px; overflow-y: auto;display:none" class="slotList">
			<table width="100%" cellpadding="10" border="0">
				<thead>
					<th width="30%"></th>
					<th width="40%" style="text-align:right">Time Slot</th>
					<th width="30%" style="text-align:right">Minutes</th>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		<div class="myEvent" style="height: 240px; overflow-y: auto;">
			<table width="100%" border="0">
				<thead>
					<th width="25%"></th>
					<th width="20%" style="text-align:left">Time Slot</th>
					<th width="25%" style="text-align:left">Minutes</th>
					<th width="30%" style="text-align:left">Status</th>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		<div class="fr"><a href="javascript:void(0)" class="norBtn blackRadiusBtn w96 none">Submit</a></div>
		<div class="event_arr"></div>
	</div>
	<table id="timeSlotListTemp" style="display:none"  rows="0" cols="0">
		<tbody>
		<tr>
			<td valign="top">__TIME__:00 __AP__</td>
				<td>
					<div class="timeSlot" key="__TIME__:00 __AP__" eregKey="__EREGKEY__">1</div>
					<div class="break">break</div>
					<div class="timeSlot" key="__TIME__:30 __AP__" eregKey="__EREGKEY1__">2</div>
					<div class="break">break</div>
				</td>
				<td>
					<div class="minuts">25</div>
					<div class="minuts">5</div>
					<div class="minuts">25</div>
					<div class="minuts">5</div>
				</td>
		</tr>
		</tbody>
	</table>
	<table id="MyEventListTemp" style="display:none"  rows="0" cols="0">
		<tbody>
		<tr key="__KEY__" class="__STATUS__">
			<td valign="top">__TIME__</td>
			<td class="minuts">
				__INDEX__
			</td>
			<td class="minuts">
				25
			</td>
			<td  class="tl">
				__STATUSSTR__
			</td>
		</tr>
		</tbody>
	</table>
	<script>
	var _hRate = parseFloat('<?php echo $profile['hRate'];?>');
	function createTimeSlotList(day){
		var _day = day.replace('-','/').replace('-','/').replace('-','/');
		var _date = new Date(_day);
		_date = _date.toString();
		var _dateArray = _date.split(' ');
		_dateArray = _dateArray.slice(0,4);
		_dateStr = _dateArray.join(' ');
		$('.dayStr','#calendarEventDialog').html(_dateStr);
		$('.dayStr','#calendarEventDialog').data('day',_day);
		var i = 0;
		var _str = '';
		var _strTemp = $('#timeSlotListTemp tbody').html();
		for(i;i<24;i++){
			if(i==0){
				_ap = 'am';
				_hour = 12;
			}
			else if(i==12){
				_ap = 'pm';
				_hour = 12;
			}
			else if(i>12){
				_ap = 'pm';
				_hour = i%12;
			}
			else{
				_ap = 'am';
				_hour = i;
			}
			var _eregkey = _hour+'00'+_ap;
			var _eregkey1 = _hour+'30'+_ap;
			_str += _strTemp.replace('__TIME__',_hour).replace('__TIME__',_hour).replace('__TIME__',_hour).replace('__AP__',_ap).replace('__AP__',_ap).replace('__AP__',_ap).replace('__EREGKEY__',_eregkey).replace('__EREGKEY1__',_eregkey1);
			
		}
		$('.slotList tbody').html(_str);
	}
	$(function(){
		$('.blackRadiusBtn','#calendarEventDialog').click(function(){
			var _day = $('.dayStr','#calendarEventDialog').data('day');
			var _seletedSlot = [];
			//console.info($('.timeSlot.setted','#calendarEventDialog'));
			$('.myEvent tr.setted','#calendarEventDialog').each(function(){
				_seletedSlot.push($(this).attr('key'));
			})
			//console.info(_seletedSlot.length);
			var _data = {};
			_data['day'] = _day;
			_data['seletedSlot'] = _seletedSlot;
			var _price = parseInt((_seletedSlot.length)*_hRate*100)/100;
			if(_seletedSlot.length == 0 ){
				alert('No session selected.');
				return;
			}
			//if(!window.confirm('Class rate is $' + _price + '.  Click OK to confirm this booking.')){
			//
			//	return;
			//}
			
			$.post('<?php echo Base_url('user/checkClass/uid/'.$profile["uid"]);?>',_data,function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				//console.info(json.success);
				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				else if(!json.enough){
					alert('You do not have enough money to create this class.Please recharge first!');
					return;
				}
				else {
					var _showstr = 'Your booking summary111 at \r\n';
					$.each(json.classTimes,function(k,v){
						_showstr += v + "\r\n";
					})
					
					_showstr += 'Your total charge is $'+parseFloat(json.cost).toFixed(2)+'. \r\nClick OK to confirm.\r\n';
					if(!window.confirm(_showstr)){
						return;
					}
					//Calendar.getInstance().getEvent();
					$.post('<?php echo Base_url('user/buyClasses/uid/'.$profile["uid"]);?>',{seletedSlot:json.classTimes},function(msg){
						if (String == msg.constructor) {      
							eval ('var json = ' + msg);
						} else {
						/* Otherwise assume it is a hash already. */
							var json = msg;
						}
						//console.info(json.success);
						if(json.success == 'false' || json.success == false){
							alert(json.msg);
						}
						else {
							Calendar.getInstance().getEvent();
							alert('Successfully booked.');
							document.location.href="<?php echo base_url('user/calendar');?>";
						}
					})
				}
			})
			
			//console.info(_data);
		})
		$('.myEvent tr.Opened').live('click',
			function(){
				if($(this).hasClass('Booked') || $(this).hasClass('Ended')){
					return;
				}
				if(!$(this).hasClass('setted')){
					$(this).addClass('setted');
				}
				else{
					$(this).removeClass('setted');
				}
			}
		)	
		$('#calendarEventDialog').hover(function(){
				$(this).data('in',1)
			},
			function(){
				$(this).data('in',0);
				$(this).hide();
			}
		)
		Calendar.getInstance().eventCallback = function(){
			
			$('.event a').toggle(function(){
				var day = $(this).attr('day');
				createTimeSlotList(day);
				$('#calendarEventDialog').show();
				$('.statusBar').show();
				$.getJSON('<?php echo Base_url("user/ajax_eventDetail");?>',{start:day,uid:<?php echo $profile['uid'];?>,rand:Math.random()},function(msg){
					//console.info(s);
					$('.statusBar').hide();
					if (String == msg.constructor) {      
						eval ('var s = ' + msg);
					} else {
						var s = msg;
					}
					if(typeof(s.status)!='undefined' &&!s.status){
						alert(s.msg);
						return;
					}
					var str = '';
					var strTemp = $('#MyEventListTemp tbody').html();
					$.each(s.rows,function(k,v){
						var _k = v.start;
						_k = _k.replace(' ','');
						_k = _k.replace(':','');
						if(_k.substr(0,1) == '0'){
							_k = _k.substr(1);
						}
						var status = '';
						var statusStr = '';
						if(typeof(v.sid)!='undefined'){
							status = 'Booked';
							statusStr = 'Booked';
						}
						else{
							status = 'Opened';
							statusStr = 'Book now';
						}
						str += strTemp.replace('__TIME__',v.start).replace('__KEY__',v.start).replace('__INDEX__',(k+1)).replace('__STATUSSTR__',statusStr).replace('__STATUS__',status);
						//console.info('.timeSlot[eregkey='+_k+']');
						//$('.timeSlot[eregkey='+_k+']').addClass('setted');
						
						//$('.timeSlot[eregkey='+_k+']').addClass(status);
						
					})
					
					$('.myEvent tbody').html(str);
					_dayStr = $('.dayStr').html();
					$('.myEvent tr').each(function(){
					
						if(new Date( _dayStr + ' ' + $(this).attr('key') )  < new Date()){
						$(this).addClass('Ended');
						$(this).children('.tl').html('Ended');
						//$(this).html('Ended');
						}
					})
				})
				$('#calendarEventDialog').data('in',1);
				//console.info($(this).offset().left + $('#calendarEventDialog').width())
				if($(this).offset().left + $('#calendarEventDialog').width() >document.documentElement.clientWidth){
					_pos = 'right';
					$('#calendarEventDialog').css('left' ,'');
					$('#calendarEventDialog').css('right' ,document.documentElement.clientWidth-$(this).offset().left-50);
				}
				else{
					$('#calendarEventDialog').css('right' ,'');
					$('#calendarEventDialog').css('left' ,$(this).offset().left);
				}
				var _bottomHeight = $('#calendarEventDialog').height() + $(this).offset().top;
				
				var _height = _bottomHeight - ( document.documentElement.clientHeight + $(window).scrollTop() );
				if(_height > 0 ) {
					$('#calendarEventDialog').css('top',$(this).offset().top - _height - 30);
				}
				else{
					$('#calendarEventDialog').css('top',$(this).offset().top);
				}
			},function(){
				$(this).trigger('click');
				if($('#calendarEventDialog').data('in')){
					return;
				}
				else{
					$('#calendarEventDialog').hide();
				}
			})
			
			getNowDateAndShow();
		}
		Calendar.getInstance().setEventUrl('<?php echo Base_url("user/ajax_events");?>').render();
		$('#addClassTime').click(function(){
			var _start = $('#startDay').val() + ' ' + $('#startTime').val();
			var _end = $('#endDay').val() + ' ' + $('#endTime').val();
			if ( new Date(_start) == 'Invalid Date'){
				alert('Invalid start Date!Please check it!');
				return;
			}
			if(new Date(_end) == 'Invalid Date'){
				alert('Invalid end Date!Please check it!');
				return;
			}
			start = new Date(_start);
			end = new Date(_end);
			$.post('<?php echo Base_url('user/addClass/uid/'.$profile['uid']);?>',{start:start.toString(),end:end.toString()},function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				else {
					Calendar.getInstance().getEvent();
					alert('Add success!');
				}
			})
		})
		
	})
	</script>