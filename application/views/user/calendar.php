

<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>

<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>

<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>

<?php $this->layout->appendFile('javascript',"js/calendar.js");?>

<?php $this->layout->appendFile('css',"css/calendar.css");?>

 <div class="baseBox baseBoxBg clearfix">

    	

        <div class="content_main fr">

        	<div class="main_inner">

                <ul class="student_prof">
					<!-- added a new dashboard link BY TECHNO-SANJAY -->
					<li><a href="<?php echo Base_url('user/dashboard');?>" class="c_prof "><span>Dashboard</span></a></li>
                    
					<li><a href="<?php echo Base_url('user/calendar');?>" class="c_prof prof_on"><span>Calendar</span></a></li>

                    <li><a href="#" class="t_prof"><span>Teachers</span></a></li>
                    
                    <li><a href="#" class="i_prof"><span>Inbox</span></a></li>
                    

                    <li><a href="javascript:void(0)" class="h_prof" onclick="history.go(-1)"><span>History</span></a></li>

                    <li><a href="#" class="a_prof"><span>Archived Lessons</span></a></li>

                    <li><a href="#" class="pay_prof"><span>Payment Options</span></a></li>

                </ul>

                <!--/student_prof-->

                <div id="student_prof_Wp">

                	<div class="mod">

                        <div class="hd">

                            <div class="pro_tle tle"><h3>Calendar</h3></div>

                        </div>

                        <div class="bd">

                            <div id="calendar"></div>

                        </div>

                    </div>

					<div class="mod">

						<div class="hd">

							<div class="pro_tle tle"><h3>Scheduled Classes</h3></div>

						</div>

						<div class="bd">

						

							<ul class="ratings_list">

								<li>

									<div class="header_pic_L fl">

										<div class="header_pic">

											<a href="#"><img src="../images/base/teacher-pic-2.jpg" width="78" height="80" /></a>

										</div>

									</div>

									<div class="rating_ct">

										<div class="agnR c939393"><a href="#"><em class="ico_op ico_del2"></em>Cancel Class</a></div>

										<div class="classes_info clearfix f12 fb">

											Scheduled Class at 7:00 pm, June 16, 2012

											<span class="fr c06a0c1">John Smith - English</span>

										</div>

									</div>

								</li>

								

								<li>

									<div class="header_pic_L fl">

										<div class="header_pic">

											<a href="#"><img src="../images/base/teacher-pic-2.jpg" width="78" height="80" /></a>

										</div>

									</div>

									<div class="rating_ct">

										<div class="agnR c939393"><a href="#"><em class="ico_op ico_del2"></em>Cancel Class</a></div>

										<div class="classes_info clearfix f12 fb">

											Scheduled Class at 7:00 pm, June 16, 2012

											<span class="fr c06a0c1">John Smith - English</span>

										</div>

									</div>

								</li>

								

								<li>

									<div class="header_pic_L fl">

										<div class="header_pic">

											<a href="#"><img src="../images/base/teacher-pic-2.jpg" width="78" height="80" /></a>

										</div>

									</div>

									<div class="rating_ct">

										<div class="agnR c939393"><a href="#"><em class="ico_op ico_del2"></em>Cancel Class</a></div>

										<div class="classes_info clearfix f12 fb">

											Scheduled Class at 7:00 pm, June 16, 2012

											<span class="fr c06a0c1">John Smith - English</span>

										</div>

									</div>

								</li>

								

								<li>

									<div class="header_pic_L fl">

										<div class="header_pic">

											<a href="#"><img src="../images/base/teacher-pic-2.jpg" width="78" height="80" /></a>

										</div>

									</div>

									<div class="rating_ct">

										<div class="agnR c939393"><a href="#"><em class="ico_op ico_del2"></em>Cancel Class</a></div>

										<div class="classes_info clearfix f12 fb">

											Scheduled Class at 7:00 pm, June 16, 2012

											<span class="fr c06a0c1">John Smith - English</span>

										</div>

									</div>

								</li>

							</ul>

							

							<div class="set_up_alerts fr">

								<div class="alters_tle">Set up Alerts</div>

								<div class="addBtn_Wp">

									<select class="raduisSelect w160 noMg fb">

										<option>15 Minutes prior</option>

									</select>

									<a class="norBtn blackRadiusBtn w55" href="#">Set</a>

								</div>

								<input type="checkbox" name="send_type" class="vAgn_m" /> Email

								&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="checkbox" name="send_type" class="vAgn_m" /> Text

							</div>

							

							<div class="spc10c"></div>

						</div>

					</div>

                    <!--

                    <div class="mod">

                        <div class="hd">

                            <div class="pro_tle tle"><h3>Schedule Class</h3></div>

                        </div>

                        <div class="bd">

                          <div class="createSchedule">

                               <form action="" method="">

                                    <h4>Create Appointment for a Class</h4>

                                    

                                    <div class="cost_per fr c3d3d3d">Cost per Hour <br /> <span class="f24 c047d9e">$25/hr</span></div>

                                    

                                    <div class="label_row f14"> 

                                        <label class="blk_label">Start Time:</label>

                                        <select class="raduisSelect">

                                            <option>Monday, 07/01/12</option>

                                        </select>

                                        <select class="raduisSelect">

                                            <option>08:00:00 AM</option>

                                        </select>

                                    </div>

                                    

                                    <div class="label_row f14"> 

                                        <label class="blk_label">End Time:</label>

                                        <select class="raduisSelect">

                                            <option>Monday, 07/01/12</option>

                                        </select>

                                        <select class="raduisSelect">

                                            <option>08:00:00 AM</option>

                                        </select>

                                    </div>

                                    

                                    <h4>Pay with New Card</h4>

                                    <table class="pay_table">

                                    	<tr>

                                        	<td width="80" class="agnC"><a href="#"><img src="../images/base/pay_1.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                            <td rowspan="6">

                                            	<div class="payWp f14">

                                                    <p><label>Credit card number</label> <input type="text" class="ipt_text_bg" style="width:155px;" /></p>

                                                    <p><label>Security number</label>	<input type="text" class="ipt_text_bg" style="width:50px;" />

                                                       <label>Expiration date</label> 

                                                       <span class="ipt_text_bg">

                                                       		<input type="text" style="width:25px;" class="ipt_text"/> / 

                                                            <input type="text" style="width:25px;" class="ipt_text"/> / 

                                                            <input type="text" style="width:25px;" class="ipt_text"/>

                                                       </span>

                                                    </p>

                                                    <p><label>Name on card</label> <input type="text" class="ipt_text_bg" style="width:155px;" /></p>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>

                                        	<td class="agnC"><a href="#"><img src="../images/base/pay_2.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                        </tr>

                                        <tr>

                                        	<td class="agnC"><a href="#"><img src="../images/base/pay_3.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                        </tr>

                                        <tr>

                                        	<td class="agnC"><a href="#"><img src="../images/base/pay_4.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                        </tr>

                                        <tr>

                                        	<td class="agnC"><a href="#"><img src="../images/base/pay_5.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                        </tr>

                                        <tr>

                                        	<td class="agnC"><a href="#"><img src="../images/base/pay_6.png"  /></a></td>

                                            <td><input type="radio" /></td>

                                        </tr>

                                    </table>

                                    

                                    <h4>Pay with Saved Card</h4>

                                    <table class="cart_table" width="100%">

                                    	<tr class="card_odd">

                                        	<td><input type="radio" name="" /></td> <td>Mastercard</td> <td>***************00</td> <td>10/24/2012</td> <td>John T. White</td>

                                        </tr>

                                        <tr>

                                        	<td><input type="radio" name="" /></td> <td>Mastercard</td> <td>***************00</td> <td>10/24/2012</td> <td>John T. White</td>

                                        </tr>

                                        <tr class="card_odd">

                                        	<td><input type="radio" name="" /></td> <td>Mastercard</td> <td>***************00</td> <td>10/24/2012</td> <td>John T. White</td>

                                        </tr>

                                    </table>

                                    

                                    <div class="agnR">

                                        <div id="total_Wp">

                                            Total Cost<br />

                                            <span>(4 hours at $25/hr)</span>

                                            <div class="total_cost">$100</div>

                                        </div>

                                        <div><input type="submit"  value="Submit" class="submit_black" /></div>

                                    </div>

                                    

                               </form>

                          </div>

                        </div>

                    </div>

                    -->

                </div>

                <!--/student_prof_Wp-->

            </div>

        </div>

        <!--/content_main-->

		<?php include 'leftSide.php';?>

    </div>

<div class="rightSide">

	<?php //echo $calendar;?>

	<div id="calendar" class="fc"></div>

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

	<script>

	$(function(){

		Calendar.getInstance().setEventUrl('<?php echo Base_url("user/ajax_events");?>').render();

	})

	/*$(function(){

		$('#calendar').fullCalendar({

			editable: true,

			

			events: function(start, end, callback) {

				$.ajax({

					url: 'ajax_events',

					dataType: 'json',

					data: {

						// our hypothetical feed requires UNIX timestamps

						start: Math.round(start.getTime() / 1000),

						end: Math.round(end.getTime() / 1000)

					},

					success: function(events) {

						callback(events);

					}

				});

			},

			

			eventDrop: function(event, delta) {

				alert(event.title + ' was moved ' + delta + ' days\n' +

					'(should probably update your database)');

			},

			

			loading: function(bool) {

				if (bool) $('#loading').show();

				else $('#loading').hide();

			}

			

		});



	});*/

	</script>
</div>