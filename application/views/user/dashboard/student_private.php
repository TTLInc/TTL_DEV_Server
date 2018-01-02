<?php
$multi_lang = 'en';
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
$this->load->model(array('lookup_model'));
$this->layout->appendFile('javascript',"js/chat.js");
$arrVal = $this->lookup_model->getValue('321', $multi_lang);
$creditstext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1393', $multi_lang);
$confirmyourbooking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1394', $multi_lang);
$tutorwillbesent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1395', $multi_lang);
$whentutorarrives = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1406', $multi_lang);
$videos = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1407', $multi_lang);
$articles = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1432', $multi_lang);
$sessiongaurantee = $arrVal[$multi_lang];
?>
<link href="<?php echo base_url("css/dashboard.css");?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("css/ezmark.css");?>" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url("js/bjqs-1.3.min.js");?>"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url("css/bjqs.css");?>" />
<script src="<?php echo base_url("js/jquery.ezmark.min.js");?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>
<section class="dashboard-page cf">
    <div class="top-white-div">
        <div class="wrapper">
            <div class="top-profile-sec" style="padding:0px;">
                <h1>
                <?php
                $arrVal = $this->lookup_model->getValue('742', $multi_lang);
                echo $arrVal[$multi_lang]; //Dashboard
                ?>
                </h1>
                <div class="profile-row">
                    <div class="left-profile">
                        <div class="profile-pic">
							<?php
							$imgSrc = (!empty($profile['pic'])) ? base_url('uploads/images/thumb/'.$profile['pic']): base_url('images/header.jpg');?>
                            <img src="<?php echo $imgSrc;?>" alt="profile pic" id="profile_image_upload" width="100%" height="100%" />
							<input type="hidden" name="profilehpic" id="profilehpic" value="<?php echo @$profile['pic'] ?>" />
                        </div>
                        <div class="profile-dtl">
                            <p><?php echo $profile['firstName'];?></p>
                            <span>
							<?php
								if($profile['roleId'] == 0):
									$arrVal = $this->lookup_model->getValue('710', $multi_lang);
									echo $arrVal[$multi_lang];  // Bronze Talkist
								endif;?>
							</span>
                        </div>
                    </div>
					<div class="header-msg">
						<p>
							<?php
							if ($profile['money'] > 0) {
								//$arrVal = $this->lookup_model->getValue('1382', $multi_lang);
								//echo $arrVal[$multi_lang];
								// Practice leads to success!<span>Complete a conversation series</span>
								?><img style="width:230px; height:115px; margin-top:-32px;" src="<?php echo  $pic?Base_url('/uploads/images/'. $pic):Base_url('images/header.jpg');?>">
						<?php	} else if ($profile['is_eligible'] == 1) {
								//$arrVal = $this->lookup_model->getValue('1377', $multi_lang);
								//echo $arrVal[$multi_lang];
								
								?><img style="width:230px; height:115px; margin-top:-32px;" src="<?php echo  $pic?Base_url('/uploads/images/'. $pic):Base_url('images/header.jpg');?>">
								<?php
								// Choose your perfect tutor!<span>Take a FREE session</span>
							} else if ($profile['is_eligible'] == 0) {
								//$arrVal = $this->lookup_model->getValue('1378', $multi_lang);
								//echo $arrVal[$multi_lang];
								// Start your path to fluency! Purchase credits
								?>
								
						<?php 	}
							?>
						</p>
					</div>
                    <div class="top-right-div">
                        <p>
							<?php 
							$arrVal = $this->lookup_model->getValue('744', $multi_lang);
							$cbalance	= $arrVal[$multi_lang]; // Balance
							?>
							<a href="<?php echo Base_url('user/account');?>"><?php echo $cbalance.":";?></a>
							<?php
							if ($profile['money'] < 0) {
								echo "0.00 ".$creditstext;
							} else {
								//$profile['money'] = $profile['purchased_credits'] + $profile['earned_credits'] + $profile['coupon_credits'];
								echo $profile['money']." ".$creditstext;
							}?>
						</p>
                        <p>
                            <?php
							$arrVal = $this->lookup_model->getValue('743', $multi_lang);
							$message = $arrVal[$multi_lang]; //Messages
                            echo anchor($base.'user/inbox/',$message.":", 'title='.$message);
                            ?>
                            <span><?php echo $msgcnt; //if($classes != 0){echo $classes[0]['alerted']; }  else { echo "0"; } ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper cf">
        <div class="boxes-div">
            <div class="next-prv-div">
                <a href="#" class="prv-arrow">
                    <?php 
                    $arrVal = $this->lookup_model->getValue('1354', $multi_lang); 
                    echo $arrVal[$multi_lang]; //< Book Tutors ?>
                </a>
                <a href="#" class="next-arrow">
                    <?php 
                    $arrVal = $this->lookup_model->getValue('1353', $multi_lang); 
                    echo $arrVal[$multi_lang]; //chat, group, blog >?>
                </a>
            </div>
            <div class="boxes-row">
                <div class="first-screen">
                <div class="dc-box">
                    <h1>
                    <?php
                    $arrVal = $this->lookup_model->getValue('1324', $multi_lang);	
                    echo $arrVal[$multi_lang]; // 1. Pick a topic ?>
                    </h1>
                    <div class="topic-div">
						<select id="topic" name="topic">
							<option value="" href="javascript:void(0);">
							<?php
							$arrVal = $this->lookup_model->getValue('1105', $multi_lang); 
							echo $arrVal[$multi_lang]; //Select Topic 
							?>
							</option>
							<?php 
                            if ($categories) {
                                foreach ($categories as $cat) {?>
							<option value="<?php echo $cat['id'];?>" <?php echo (isset($selTopic[0]['topic']) and $selTopic[0]['topic']==$cat['id']) ? "selected" :"";?>  href="<?php echo (!empty($cat['pfile'])) ? base_url("uploads/categories/".$cat['pfile']) :"javascript:void(0)";?>"><?php echo $cat['category'];?></option>
								
                                <?php }
                            }?>
						</select>					
						<div class="topic-img">
							<a href="javascript:void(0);" id="preview_link" target="_blank"><img src="<?php echo base_url('images/preview_pdf.png'); ?>" width="" alt="" /></a>
						</div>
                    </div>
                    <div class="button-dv" style="margin-top:65px;">
						<a href="javascript:void(0);" class="save-btn" id="saveTopic">
						<?php
						$arrVal = $this->lookup_model->getValue('135', $multi_lang);
						echo $arrVal[$multi_lang]; //Save
						?>
						</a>
					</div>
                </div>
                <div class="dc-box middle">
                    <h1>
                        <?php 
                        $arrVal = $this->lookup_model->getValue('1181', $multi_lang); 
                        echo $arrVal[$multi_lang]; //2. Pick a tutor?>
                    </h1>
                    <div id="banner-slide">
                        <ul class="bjqs">
                            <?php
                            foreach($newtutors as $newtutor):
							if($newtutor['uid'] != ''){?>
                            <li>
                                <div class="tutor-div">
								
                                <h2>
                                    <a href="<?php echo base_url('/user/profile/uid/'.@$newtutor['uid']); ?>"><?php echo ucfirst(@$newtutor['firstName']); ?></a>
                                </h2>
                                <p>
                                    <?php
                                    $address = "";
                                    if (!empty($newtutor['city'])) {
                                        $address .= $newtutor['city'];
                                    } 
                                    if (!empty($newtutor['provice'])) {
                                        $address .= ', '.$newtutor['provice'];
                                    }															
                                    if (!empty($newtutor['country'])) {
                                        $address .= ', '.$newtutor['country'];
                                    }
                                    echo $address;
                                    ?>
                                </p>
                                <div class="pfodtl">
                                    <div class="left-propic">
                                        <?php 
                                        if($newtutor['ecp'] !=''){?>
                                            <span class="new-stud">New</span>
                                        <?php }
                                        if ($newtutor["pic"] != ''): ?>
                                            <a href="<?php echo base_url('/user/profile/uid/'.@$newtutor['uid']);?>">
                                                <img src="<?php echo base_url('uploads/images/thumb/'.$newtutor["pic"]); ?>" width="150" height="150" alt="" />
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo base_url('/user/profile/uid/'.@$newtutor['uid']);?>">
                                                <img src="<?php echo base_url('images/header.jpg');?>" width="150" height="150" alt="" />
                                            </a>
                                        <?php endif; ?>
                                        <?php
								if($newtutor['fbshare'] != '0'){
								?>
								<div class="fb-share-button forstudent" data-href="<?php echo base_url("user/profile/uid/".$newtutor['uid']);?>" data-layout="button"></div>
								<?php } ?>
                                    </div>
                                    <div class="right-dtl">
                                        <h3>
                                            <?php 
                                            $arrVal = $this->lookup_model->getValue('282', $multi_lang); 
                                            echo $arrVal[$multi_lang]; //Rate?>
                                        </h3>
                                        <p>
                                        <?php			
                                       /* if($profile['is_eligible'] != '1'){
											$q= "SELECT tutor_markup from profile where uid=".$newtutor['school_id'];
											$classquery = $this->db->query($q);
											$classresult = $classquery->row_array();
										}
										*/
                                        $newtutor['hRate'] = (@$newtutor['hRate'] + @$classresult['tutor_markup']) * (1-(-$configdefault['VEE_PRICE_PERCENT']['value']) );
                                        $newtutor['hRate'] = round(($newtutor['hRate'] *10000) /100)  /100;
                                        $newtutor['hRate'] = number_format($newtutor['hRate'],2);
                                        echo $newtutor['hRate'].' credits/class'; ?>
                                        </p>
                                            <div class="tutor-icon">
                                                <a class="msg-icon icon-popup" onclick="sendBeepBoxMessage(<?php echo $newtutor['uid'] ;?>)">
                                                    &nbsp;
                                                    <span class="classic">
                                                        <?php
														$arrVal = $this->lookup_model->getValue('740', $multi_lang);
														echo $arrVal[$multi_lang];?>
                                                    </span>
                                                </a>
                                                <a class="cln-icon icon-popup" href="<?php echo base_url('/user/calendar/uid/'.@$newtutor['uid']); ?>">
                                                    &nbsp;
                                                    <span class="classic">
														<?php
														$arrVal = $this->lookup_model->getValue('731', $multi_lang);
														echo $arrVal[$multi_lang];?>
													</span>
                                                </a>
                                                <?php
                                                if ($newtutor['readytotalk'] == 1) {?>
                                                    <a class="video-icon icon-popup" onclick="bookNow(<?php echo $newtutor['uid'] ;?>,'<?php echo $newtutor['firstName'];?>','<?php echo $newtutor['school_id'];?>','<?php echo $newtutor['hRate'];?>')">
                                                        &nbsp;
                                                        <span class="classic">
															<?php 
															$arrVal = $this->lookup_model->getValue('741', $multi_lang);
															echo $arrVal[$multi_lang]; //Talk Now Available?>
														</span>
                                                    </a>
                                                <?}else{?>
                                                    <a class="icon3 icon-popup icon3-gray">
                                                        &nbsp;
                                                        <span class="classic">
                                                            <?php 
                                                            $arrVal = $this->lookup_model->getValue('925', $multi_lang);
                                                            echo $arrVal[$multi_lang];//Talk Now Unavailable ?>
                                                        </span>
                                                    </a>
                                                <?}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<p style="font-size:10pt;">Book me for: 
								<?php echo $newtutor['nativeLanguage'];
								if($newtutor['nativeLanguage'] == ''){ echo "English"; }
								if($newtutor['otherLanguage'] != '' AND $newtutor['nativeLanguage'] != $newtutor['otherLanguage']){ echo ", "; }
								if($newtutor['nativeLanguage'] != $newtutor['otherLanguage']){ echo $newtutor['otherLanguage']; }
								?></p>
                            </li>
                            <?php }
							endforeach; ?>
                        </ul>
                    </div>
                    <div class="button-dv" style="margin-top:45px;">
                        <a href="<?php echo base_url('/search/search'); ?>" class="save-btn">
                            <?php 
                            $arrVal = $this->lookup_model->getValue('1323',$multi_lang);
                            echo $arrVal[$multi_lang]; //More Tutors ?>
                        </a>
                    </div>
                </div>
                <div class="dc-box">
					
                    <h1>
						<?php
						$arrVal = $this->lookup_model->getValue('1357', $multi_lang);
						echo $arrVal[$multi_lang]; //3. Start your session
						?>
					</h1>
					<h2 style='color:#3e75a8;font-weight:bold;text-align:center;'><?php echo $sessiongaurantee; ?></h2>
					<input type="hidden" value="<?php echo sizeof($classes);?>" id="noofschedulesession" />
                    <?php 
					if(($nextTOdISP=='class' or $nextTOdISP=='group') and (!empty($classes))){
						
						$Timer=strtotime($classes[0]['startTime']) - now(); ?>
							<div class="startsession" style="display:<?php echo ($Timer < 900  && $Timer > -1500 && $classes[0]['Is_early'] == 0) ? "block" : "none"; ?>">
								<div class="classprofile">
									<?php
									$groupprofile = $this->profile_model->getTutorProfile($classes[0]['tid']);
									?>
									<div class="profile_detail">
										<div class="heading" align="center"><?php 
										$arrVal = $this->lookup_model->getValue('1339', $multi_lang);
										$lngvideochatwith = $arrVal[$multi_lang];
										?>
										<p><?php echo $lngvideochatwith;?></p>
										<p><?php
										$time = explode(",",hiaOutTime($classes[0]['startTime']));
										echo $groupprofile["firstName"].", ".$time[0];?></p>
										</div>													
									</div>
									<div class="profile_thumb">
									<img src="<?php echo (!empty($groupprofile['pic'])) ? base_url('uploads/images/thumb/'.$groupprofile['pic']): base_url('images/header.jpg'); ?>" width="auto" alt="" />
									</div>
									<div class="button-dv"  style="margin-top:30px;">
										<a href="<?php echo base_url('classroom/index/cid/'.$classes[0]['id']) ?>" class="save-btn" id="redurl">
											<?php
											$arrVal = $this->lookup_model->getValue('1350', $multi_lang);
											$join	= $arrVal[$multi_lang];
											echo $join;
											?>
										</a>
									</div>
								</div>
							</div>
							<div class="session-div session-temp2 listsession" style="display:<?php echo ($Timer < 900  && $Timer > -1500 && $classes[0]['Is_early'] == 0) ? "none" : "block"; ?>"> 
								<?php
								$arrVal = $this->lookup_model->getValue('1362', $multi_lang);
								$lngJoinWithIn = $arrVal[$multi_lang]; // Join within 15min.
								?>
								<h2><?php echo $lngJoinWithIn;?></h2>
								<ul>
								<?php
								$i= 1;
								// List of Next Session Schedule
								foreach($classes as $k=>$class) {$i++;?>
									<li class="<?php echo ($i%2) ? "ligraybg" : "";?>">
										<a id="class_d_<?php echo $class['id'];?>" theClassId='<?php echo $class['id'];?>' href="javascript:void(0);" class="close-li delClass"></a>
										<?php
										$tutorDetails = $this->user_model->getnameByUid($class['tid']);
										$arrVal = $this->lookup_model->getValue('1361', $multi_lang);
										$yrTutor = $arrVal[$multi_lang]; // Your Tutor
										echo "<p>".$yrTutor.": ".$tutorDetails['firstName'].$class['tid']."</p>";
										echo "<p>".hiaOutTime($class['startTime'])."</p>";
										echo '<span class="classic">'.$lngJoinWithIn.'</span>';
										?>
									</li>
								<?php
								}?>
								</ul>
                                <div class="button-dv" style="margin-top:30px;"><span class="save-btn graybnt">
									<?php
									$arrVal = $this->lookup_model->getValue('746', $multi_lang);
									$joinv	= $arrVal[$multi_lang];
									echo $joinv;
									?>
								</span></div>
							</div>
							<?php
					}?>
					<div class="samplevid" style="display:<?php echo (!empty($classes)) ? "none" : "block";?>">
						<div class="session-div">
							<p>
								<?php
								$arrVal = $this->lookup_model->getValue('1359', $multi_lang);
								echo $arrVal[$multi_lang]; // None scheduled yet.
								?>
							</p>
							<div class="video-img">
								<img src="<?php echo base_url("images/sample-vee-session.jpg");?>" class="lnkSample" alt=""/>
							</div>
						</div>
						<div class="button-dv" style="margin-top:40px;">
							<?php 
							$arrVal = $this->lookup_model->getValue('1337', $multi_lang);
							$lngTestVideoSessionBTN = $arrVal[$multi_lang];
							?>
							<a href="<?php echo base_url('testveesession/testVeeSession');?>" class="save-btn" target="_blank"><?php echo $lngTestVideoSessionBTN;?></a>
						</div>
					</div>	
                </div>
                </div>
                <div class="second-screen">
                <div class="dc-box">
					<div id="currentlivechat">
						<h1>
							<?php 
							$arrVal = $this->lookup_model->getValue('749', $multi_lang);
							echo $arrVal[$multi_lang];//Live Chat ?>
						</h1>
						<div id="div_chat" class="div_chat chat-div"></div>
						<div class="chat-form">
							<form autocomplete="off" id="frmmain" name="frmmain" onSubmit="javascript:return false;" >
								<input type="text" onblur="this.value=!this.value?'Type message':this.value;" onfocus="this.select()" onclick="if (this.value=='Type message')this.value='';" value="Type message" id="txt_message" name="txt_message" style="width: 317px;height:35px;margin-top:5px;padding:3px;" autocomplete="off" onKeydown="Javascript: if (event.keyCode==13) sendChatTextForm();" />
								<?php
								$arrVal = $this->lookup_model->getValue('411', $multi_lang);
								$send = $arrVal[$multi_lang];
								?>						
								<input type="button" name="btn_send_chat" id="btn_send_chat" value='<?php echo $send;?>' onClick="javascript:sendChatText();" class="aqua_btn float-lt"/>
								<input type="hidden" name="chatstatus" id="chatstatus" value="1" />
								<a href="javascript:void(0);" id="createchatgroup" class="link btn_send_chat float-rt" >
									<?php
									$arrVal = $this->lookup_model->getValue('754', $multi_lang);
									$chat_inavite	= $arrVal[$multi_lang];
									echo $chat_inavite; // Chat invite
									?>
								</a>
								<a href="javascript:void(0);" style="display:none;" onclick="cancelprivatechat();" id="cancelchat" class="link btn_send_chat">End Private Chat</a>
								<input type="hidden" name="currentgroupid" id="currentgroupid" value="<?php echo $cgid; ?>" />
								<input type="hidden" name="lastmessage" id="lastmessage" value="" />
								<input type="hidden" name="lastmessage_user" id="lastmessage_user" value="" />
							</form>
						</div>
					</div>
					<div class="owngroup" id="owngroup" style="display:none;">
						<h1>
							<?php 
							$arrVal = $this->lookup_model->getValue('270', $multi_lang);
							echo $arrVal[$multi_lang];//Invite Chat ?>
						</h1>
						<div class="box-cont border-all div_chat-div">
							<div class="inbox_mod">
								<div id="suggest">
									<span style="float:left;">
										<?php 
										$arrVal = $this->lookup_model->getValue('293', $multi_lang);
										$linviteonlineuser = $arrVal[$multi_lang];
										echo $linviteonlineuser;?>:</span>
										<span class="daschatsug">
											<img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" />
										</span> <br />
									<input type="text" size="25" value="" autocomplete="off" id="country" onKeyUp="suggest(this.value);" onBlur="fill();fillId();" class="" />
									<input type="hidden" name="country_id" id="country_id" value="" />
									<div id="suggestions" style="display: none;">
										<div id="suggestionsList"> &nbsp; </div>
									</div>
								</div>
							</div>
							<div>
								<a href="javascript:void(0);" id="cancellivechat" class="btn_send_chat">
									<?php
									$arrVal = $this->lookup_model->getValue('298', $multi_lang);
									$lcancel = $arrVal[$multi_lang];
									echo $lcancel; ?>
								</a>
								<a href="javascript:void(0);" id="backlivechat" class="btn_send_chat">
									<?php 
									$arrVal = $this->lookup_model->getValue('283', $multi_lang);
									$lok = $arrVal[$multi_lang];
									echo $lok;?>
								</a>
							</div>
						</div>
					</div>
					<h2 class="invitations" id="invlbl" style="display:none;">Private Chat Invitations</h2>
					<div id="invitations" class="invitations"></div>
                </div>
                <div class="dc-box middle">
                    <h1>
					<?php
					$arrVal = $this->lookup_model->getValue('1338', $multi_lang);
					echo $lnghdFGSF = $arrVal[$multi_lang]; // Group Video session Fun
					
					
					?>
					</h1>
					<?php if(($nextTOdISP=='group' or $nextTOdISP=='class') and !empty($nextSession)) {
						$groupprofile = $this->profile_model->getTutorProfile($nextSession['Tutor1']);
						?>
                    <div class="tutor-div">
						<h2>
							<a href="<?php echo base_url('/user/profile/uid/'.@$newtutor['uid']); ?>"><?php echo ucfirst(@$groupprofile['firstName']); ?></a>

						</h2>
						<p>
							<?php
							$address = "";
							if (!empty($groupprofile['city'])) {
								$address .= $groupprofile['city'];
							} 
							if (!empty($groupprofile['provice'])) {
								$address .= ', '.$groupprofile['provice'];
							}															
							if (!empty($groupprofile['country'])) {
								$address .= ', '.$groupprofile['country'];
							}
							echo $address;
							?>
						</p>
						<div class="pfodtl">
                                    <div class="left-propic">
									<?php 
								if ($groupprofile["pic"]!="") {?>
								<a href="<?php echo Base_url('user/profile/uid/'.$groupprofile["uid"]);?>"><img src="<?php echo base_url('uploads/images/thumb/'.$groupprofile["pic"]); ?>" width="100%" height="130" alt="Tutor" /></a>	
								<?php }?>
                                    </div>
                                    <div class="right-dtl">
                                        <p>
                                       <?php 
										$arrVal = $this->lookup_model->getValue('1340', $multi_lang);
										$lnggrpSubject = $arrVal[$multi_lang];
										echo $lnggrpSubject." ".$nextSession["Topic"]; //Subject: Disneyland
										?>
                                        </p>
                                        </div>
                                    </div>
					</div>
                    <div class="group-video-div">
                       
                        <div class="session-dtl">
                                <p>
									<?php
									$arrVal = $this->lookup_model->getValue('745', $multi_lang);
									$lngnextsession = $arrVal[$multi_lang];
									echo $lngnextsession;//Next Session:
									?>
								</p>
                                <p>
									<?php
									if($nextSession != array()){ 
										echo hiaOutTimedash($nextSession['Time']);
									}?>
								</p>                               
                            </div>
							<div class="button-dv">
					<a href="#" class="learn-btn" id="joinMe">
					<?php
					/*$arrVal = $this->lookup_model->getValue('745', $multi_lang);
					echo $nextsession= $arrVal[$multi_lang];*/
					$arrVal = $this->lookup_model->getValue('1350', $multi_lang);
					$lngJoinSession  	= $arrVal[$multi_lang];
					echo $lngJoinSession;?>
					</a>
					</div>
                    </div>
					<?php }?>
                </div>
                <div class="dc-box">
                    <h1>
					<?php
						$lngNotifications = $this->lookup_model->getValue('1355', $multi_lang);
						echo $lngNotifications[$multi_lang]; // Language and Culture
					?>
					</h1>
					<?php if(!empty($lastvideo)) {?>
                    
					
					
<?php
$dc_vid_img_src = '';
$dc_vid_vid_src = '';

if(file_exists(FCPATH."uploads/video/".$lastvideo['source'])){
	$dc_vid_vid_src = base_url("uploads/video/".$lastvideo['source']);
}else{
	$dc_vid_vid_src = "http://52.8.248.161/uploads/video/".$lastvideo['source'];
}
if(file_exists(FCPATH."uploads/video/images/".$lastvideo['source'].".jpg")){
	$dc_vid_img_src = base_url("uploads/video/".$lastvideo['source'].".jpg");
}elseif(file_exists(FCPATH."uploads/video/".$lastvideo['source'].".jpg")){
	$dc_vid_img_src = base_url("uploads/video/".$lastvideo['source'].".jpg");
}else{
	$dc_vid_img_src = "http://52.8.248.161/uploads/video/".$lastvideo['source'].".jpg";
}
?>
					
					
					
					
					<div class="culture-div">
                        <h2 class="textaligncenter"><?php echo $lastvideo['name'];?></h2>
                        
                        <div class="culture-img" id="">
                            <a href="#video_popup190516" class="video_popup190516_open" id="increaseviews">
                            <div class="freevideolibrary_video_icon"><img src="<?php echo base_url("images/")?>/video_icon03062016.png" alt="video"></div>
                            <img src="<?php echo $dc_vid_img_src;?>" alt=""/></a>
                            <div class="video_main02062016 clearfix">
                            <div class="video_left02062016">
                            <div class="video_like01 cf">
								<img alt="" src="<?php echo base_url("images/thumb-up.png"); ?>">
								<span><?php echo $lastvideo['likes']; ?></span>
							</div>
							<div class="video_like01 cf">
								<img alt="" src="<?php echo base_url("images/filesq-viewer-icon.png"); ?>">
								<span><?php echo $lastvideo['views']; ?></span>
							</div>
                            </div>
                            
                            <div class="video_right02062016"><a href='<?php echo base_url("user/profile/uid/".$lastvideo['uid']);?>'><?php echo $lastvideo['firstName']." ".$lastvideo['lastName']; ?></a></div>
                            
                            </div>
                            
                            <div class="video_popup190516" id="video_popup190516">
                            <div class="popup_close_icon_190516"><a class="video_popup190516_close" href="#" id="pausevideo"></a></div>
								<video style="cursor:pointer;background-color:#FFF;" id="popupvideo" class="video-js vjs-default-skin vjs-big-play-centered" width="99.9%" height="" controls preload="auto"  poster="<?php echo $dc_vid_img_src; ?>" data-setup="{}"> 
								<source src="<?php echo $dc_vid_vid_src;?>" type="video/mp4"></source>
				<source src="<?php echo $dc_vid_vid_src;?>" type="video/ogg"></source>
							  Your browser does not support video player.
							</video>
                            </div>
                        </div>
                        
                        <div class="culture-txt">
                            <p>
								<?php 
								$content = explode(' ', $lastvideo['desc'], 20);
								if (count($content)>=15) {
									array_pop($content);
									$content = implode(" ",$content).'...';
								} else {
									$content = implode(" ",$content);
								}
								$content = preg_replace('/\[.+\]/','', $content);
								$content = str_replace(']]>', ']]&gt;', $content);
								echo $content;
								?>
							</p>
                        </div>
                        
                    </div>
					<?php
					$url = $languageandculture[0]['url'];
					if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
						$url = "https://" . $url;
					}
					?>
					
					
					<div class="button-dv-new02 cf">
					<a href="<?php echo base_url("search/videosearch"); ?>" class="learn-btn-new02">
					<?php echo $videos; // Learn More ?>
					</a>
					<a href="<?php echo base_url("blog"); ?>" class="learn-btn-new03">
					<?php echo $articles; // Learn More ?>
					</a>
					</div>
					
					<?php }?>
                </div>
                </div>
            </div>
        </div>
        <div class="notification-div">
            <h1>
            <?php
                $lngNotifications = $this->lookup_model->getValue('1352', $multi_lang);
                echo $lngNotifications[$multi_lang];
            ?>
            </h1>
            <?php
			if ($notifications) {
			foreach($notifications as $note) {
				echo $note['description'];
				}
			}?>
        </div>
    </div>
</section>
<script language="JavaScript" type="text/javascript">
<?php if(@$classes[0]['startTime']): ?>
var _currentTime = <?php echo strtotime($classes[0]['startTime']);?>;
<?php else: ?>
var _currentTime = 0;
<?php endif; ?>
var gslimit = 0;
var vslimit = 0;
var now = 0;
var _setintvalNextSession = setInterval(checkNextSession,1000);
function checkNextSession(){
			
	<?php if(@$classes[0]['id']): ?>
		var _cid = <?php echo @$classes[0]['id'];?>;
		var isEarly=<?php echo @$classes[0]['Is_early'];?>;
	<?php else: ?>
		var _cid ='';
	<?php endif; ?>
	$.ajax({
		url: "<?php echo base_url();?>user/gettime/cid/"+_cid,
        type: "post",
        success: function(val){
        var next="<?php echo $nextTOdISP ?>";
		var _test1 = val;
		if (_test1 <=15 && _test1 >0 && next=='group') {
			if (gslimit==0) {
				$('.next-arrow').trigger("click");
				gslimit = 1;
			}
			$("#myfreegroup").removeClass('myfreegroup');
			$("#joinMe").css({backgroundColor:"#84c022"});		
			//document.getElementById('myfreegroup').className = 'myres vsession';
			//$(".btnBlueGroup").addClass("vsession");
			//$(".nextsess").html("<?php echo $join;?>");
			<?php if($Participant >=20 ) {?>
				$("#joinMe").attr("onclick", "openfullDialog();",false);
			<?php } else {?>
				$("#joinMe").html("<?php 
				$arrVal = $this->lookup_model->getValue('1350', $multi_lang);
				$lngJoinSession  	= $arrVal[$multi_lang];
				echo $lngJoinSession;?>");
				$("#joinMe").attr("href", "<?php echo base_url('multi?id='.$nextSession['gropsessionId']); ?>");
			<?php }?>
		}
		else if (_test1 <=15 && _test1 >0 && next=='class')	{ 
			if (vslimit==0) {
				$('.prv-arrow').trigger("click");
				vslimit = 1;
			}
			$("#redurl").text("<?php echo $join;?>");
			$(".startsession").show();
			$(".listsession").hide();
			$(".samplevid").hide();
			// $("#redurl").attr("href", "javascript:void(0)");
		} else {
			$("#joinMe").css({backgroundColor:"#3399cc"});	
			if (val == 'deleted') {			
				_startTime='500';
			} else {
				var unixtime = val;
				var _startTime = _currentTime - unixtime;
		    }console.log(_startTime);
			if (_startTime < 900 && isEarly==0 && _startTime > -(1500*1)) {
				if(next=='class'){
					if (vslimit==0) {
						$('.prv-arrow').trigger("click");
						vslimit = 1;
					}
					//document.getElementById('Dynamicount').className = 'rcr-ses vsession';	
					$("#redurl").attr("href", "<?php echo base_url('classroom/index/cid/'.$classes[0]['id']); ?>");
					$(".startsession").show();
					$(".listsession").hide();
					$(".samplevid").hide();
					now = 1;
				}
			} else {
				if(next=='class'){
					//document.getElementById('Dynamicount').className = 'vsession-gray-btn';	
					$("#redurl").attr("href", "javascript:void(0)");
					$(".startsession").hide();
					if (now == 1) {
						if($(".listsession li a[theclassid=<?php echo $classes[0]['id'];?>]").length==1){
							$(".listsession li a[theclassid='<?php echo $classes[0]['id'];?>']").parent("li").remove();
							$("#noofschedulesession").val($("#noofschedulesession").val() - 1);
						}
					}
					if($("#noofschedulesession").val()>0){
						$(".listsession").show();
						$(".samplevid").hide();
					} else {
						$(".samplevid").show();
						$(".listsession").hide();
					}
				}
			}
			if (_startTime <= 1) {
				$('.classTimer').css('color','#333333');
				$('.classTimer').html('None');
			} else if(isNaN(_startTime)) {
				$('.classTimer').css('color','#333333');
				$('.classTimer').html('Cancelled');
			} else {
				$('.classTimer').css('color','red');
				$('.classTimer').html('  will start after '+formatMinute(_startTime)+' sec.');
			}
		}}
	});
}
function formatMinute(seconds){
	seconds = Math.abs(seconds);
	var _minutes = parseInt(seconds / 60);
	var _seconds = seconds % 60;
	return _minutes + 'Min ' + _seconds;
}
function openfullDialog()
{
	$('#fullDialog').dialog({
		modal:true,
		width:'300px'
	}); 
}
function closeFullpopup()
{
		$('#fullDialog').dialog('close');
}
</script>
<script>
$('#increaselike').click(function(){
		//alert('test');
	cupdate ='vid='+<?php echo $lastvideo['id'];?>;
	$.ajax({
		  type:'POST',
		  data:cupdate,
		  url:'<?php echo base_url('search/incVideoLike/');?>',
		  success:function(msg){

		  }
	});
});

$('#increaseviews').click(function(){

	cupdate ='vid='+<?php echo $lastvideo['id'];?>;
	$.ajax({
		  type:'POST',
		  data:cupdate,
		  url:'<?php echo base_url('search/incVideoView/');?>',
		  success:function(msg){

		  }
	});
});

$('#pausevideo').click(function(){
	var video = document.getElementById("popupvideo");
	video.pause();
});

$(function() {
	$('.defaultP input').ezMark();
	$('.customP input[type="radio"]').ezMark({checkboxCls: 'ez-checkbox-green', checkedCls: 'ez-checked-green'});
});
jQuery(document).ready(function($) {
	$('#banner-slide').bjqs({
		 animtype      : 'slide',
		'height' : 240,
		'width' :325,
		'responsive' : true,
		showmarkers : false,
		auto: true
	});
	
	
	$('.next-arrow').click(function() {
		$(".second-screen").fadeIn(600);
		document.getElementById('div_chat').scrollTop = document.getElementById('div_chat').scrollHeight;
		$(".prv-arrow").show();
		$(this).hide();
		$(".first-screen").fadeOut(600);
	});
	
	$('.prv-arrow').click(function() {
		$(".second-screen").fadeOut(600);
		$(".next-arrow").show();
		$(this).hide();
		$(".first-screen").fadeIn(600);
	});
	
});
</script>
<?php 
$cnt1 = count($result1);
if($cnt1 > 0){
	$cgid = $result1[0]['chatid'];
}else{
	$cgid = 1;
}
?>
<script language="JavaScript" type="text/javascript">
/**
* Script for livechat
* SKVIRJA - 25 June 2013
*/			var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';
			var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
			var profileImgNull = '<?php echo profile_image("");?>';
			
			function profileImgChatThumb(src){
				if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
					
					return profileImgNull;
				}
				return src;
			}
			function profileImgChatThumbInv(src){
				if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
					
					return profileImgNull;
				}
				return src;
			}
			
			$(document).ready(function() {
				h2();
				$("span.dasinvchat").hover(function () {
					$(this).append('<div class="dasinvchat-tooltip"><p><?php $arrVal = $this->lookup_model->getValue('524', $multi_lang);$linvitetxt = $arrVal[$multi_lang];echo $linvitetxt;?></p></div>');
				}, function () {
					$("div.dasinvchat-tooltip").remove();
				});
				$("span.daschatsug").hover(function () {
					$(this).append('<div class="tooltipusr"><p><?php $arrVal = $this->lookup_model->getValue('525', $multi_lang);$lenternametxt = $arrVal[$multi_lang];echo $lenternametxt; ?></p></div>');
				}, function () {
					$("div.tooltipusr").remove();
				});
				
				$("span.rcr-ses").hover(function () { 
				var a=$('#redurl').text();
			 
					$(this).append('<div class="tooltipusr"><p><?php $arrVal = $this->lookup_model->getValue('969', $multi_lang);$tooltip = $arrVal[$multi_lang];echo $tooltip; ?></p> </div>');
					}, function () {
					$("div.tooltipusr").remove();
				});
				
				
					
				$("span.myfreegroup").hover(function () { 
				
				 $(this).append('<div class="tooltipusr"><p><?php $arrVal = $this->lookup_model->getValue('1342', $multi_lang);	$lngTestVideoSessionTT = $arrVal[$multi_lang];echo $lngTestVideoSessionTT; ?></p> </div>');
				 }, function () {
					$("div.tooltipusr").remove();
				});
				
					$("span.myres").hover(function () { 
				 $(this).append('<div class="tooltipusr"><p><?php $arrVal = $this->lookup_model->getValue('1208', $multi_lang);	$Previewour = $arrVal[$multi_lang];echo $Previewour; ?></p> </div>');
				 }, function () {
					$("div.tooltipusr").remove();
				});
				
				$("span.vsession-gray-btn").hover(function () {
				 
					$(this).append('<div class="tooltipusr"><p><?php $arrVal = $this->lookup_model->getValue('1119', $multi_lang);$NoSesssion = $arrVal[$multi_lang];echo $NoSesssion; ?></p></div>');
				}, function () {
					$("div.tooltipusr").remove();
				});
			});
			function h2()
			{
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage  = 0;
				document.getElementById('lastmessage').value = 0;
				startChat();
			}
			
			var lastMessage = 0;
			var mTimer;
			
			function startChat() {
				getChatText();
			}		
			
			var newchat;
			function getChatText() {
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage = document.getElementById('lastmessage').value;
				var lastmessage_user = document.getElementById('lastmessage_user').value;
				if((newchat!=lastMessage) && (newchat>0) && (lastmessage_user!='<?php echo $this->session->userdata('uid');?>')){
					// Play Sound
					$('#chatAudio')[0].play();
				}
				newchat = lastMessage;
				//checks for exists group chat
				if(chatgroupid != 1)
				{
					$.get("<?php echo base_url();?>user/chat_check_exists_group",{
								chat: chatgroupid
							}, function(st) {
								if(st.status == 'no')
								{
									changegroup('1');
								}
					});
					document.getElementById('createchatgroup').style.display = 'none';
					
				}
				$.get("<?php echo base_url();?>user/chat_get_message",{
							chat: chatgroupid,
							last: lastMessage
						}, function(xml) {
							 
							addMessages(xml);
							
				});
				if(document.getElementById('invitations').innerHTML == '')
				{
					$.get("<?php echo base_url();?>user/chat_get_invitation",{
								chat: 1,
								last: lastMessage
							}, function(xml) {
								addInvitations(xml);
								
					});
				}
				// checks for accepted invitation 
				var chatstartedvalue = 0;
				$.get("<?php echo base_url();?>user/chat_check_to_start",{
							chatstarted: chatstartedvalue
						}, function(msg) {
							if(msg.gid)
							{
								$.get("<?php echo base_url();?>user/chat_check_to_start_update",{
											chatstarted: chatstartedvalue,
											chatid: msg.gid
										}, function(msg1) {
										document.getElementById('cancelchat').style.display = '';
										changegroup(msg.gid);	
											
								});
								
							}
							
				});
				
				
			}
			function addMessages(xml)
			{
				clearTimer();
				var chat_div = document.getElementById('div_chat');
				var xmldoc = xml;
				var message_nodes = xmldoc.getElementsByTagName("message"); 
				var n_messages = message_nodes.length
				for (i = 0; i < n_messages; i++) {
					var user_node = message_nodes[i].getElementsByTagName("user");
					var text_node = message_nodes[i].getElementsByTagName("text");
					var time_node = message_nodes[i].getElementsByTagName("time");
					//var msgid = message_nodes[i].getElementsByTagName("msgid");
					 
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					var user_id_role = message_nodes[i].getElementsByTagName("roleid");
					//alert(user_id_role[0].firstChild.nodeValue);
					var msgid = message_nodes[i].getAttribute( 'id' );
					/*if(user_id_role[0].firstChild.nodeValue != '')
					{
						var imgclass = "ttimg";
					}else{
						var imgclass = "stimg";
					}*/
					var imgclass = "stimg";
					// get readytotalk user status
					//var imgclass = "ttimg";
					var user_online = message_nodes[i].getElementsByTagName("readytotalk");
					var readytotalk = user_online[0].firstChild.nodeValue;
					console.log(readytotalk);
					
					if(readytotalk == 1)
					{
						var onlineclass = "stonline";
					}else{
						var onlineclass = "stoffline";
					}
					//alert(text_node);
					
					var imgsrc =  user_img[0].firstChild.nodeValue;
					var userprofilelink = '';
					
					var tmpmsgid = 'chatmsgitems_'+msgid;
					//alert(document.getElementById(tmpmsgid))
					var roleid=user_id_role[0].firstChild.nodeValue;
					var is_hidden = message_nodes[i].getElementsByTagName("hiddenRole");
					var hidden=is_hidden[0].firstChild.nodeValue;
					
					if((roleid==0) || (roleid > 3))
					{
						var link="javascript:void(0)";
					}
					else
					{							
						var link="<?php echo base_url('user/profile/uid');?>"+"/"+user_id[0].firstChild.nodeValue;		
					}
					var fnclick="sendBeepBoxMessage("+user_id[0].firstChild.nodeValue+")";
					var namelink = 	"javascript:void(0)";
					if(document.getElementById(tmpmsgid))
					{
						chat_div.innerHTML += '';
					}else{
						chat_div.innerHTML += '';
						chat_div.innerHTML += '<div class="chatitems" id="chatmsgitems_'+msgid+'">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg '+imgclass+'"><a class="'+onlineclass+'" href="'+namelink+'" onclick="'+fnclick+'"><span class="grn-dot"> </span><img src="'+profileImgChatThumb(imgsrc)+'" width="30" height="40"/></a></div>' + '<div class="chatuser">' + '<span><a href="'+namelink+'" onclick="'+fnclick+'">' + user_node[0].firstChild.nodeValue + '</a>:</span>' + text_node[0].firstChild.nodeValue + '</div></div>';
					
					}
					
					chat_div.scrollTop = chat_div.scrollHeight;
					lastMessage = (message_nodes[i].getAttribute('id'));
					
					document.getElementById('lastmessage').value = lastMessage;
					document.getElementById('lastmessage_user').value = user_id[0].firstChild.nodeValue;
				}
				mTimer = setTimeout('getChatText();',2000); 
			}
			
			function addInvitations(xml)
			{
				document.getElementById('invitations').innerHTML = '';
				var invitation_div = document.getElementById('invitations');
				var xmldoc = xml;
				var message_nodes = xmldoc.getElementsByTagName("message"); 
				var n_messages = message_nodes.length
				var invcheck = 0;
				for (i = 0; i < n_messages; i++) {
					var user_node = message_nodes[i].getElementsByTagName("user");
					var chatid = message_nodes[i].getElementsByTagName("chatid");
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					var invid = message_nodes[i].getElementsByTagName("invid");
					
					var imgsrc = user_img[0].firstChild.nodeValue;
					
					
					var tmpinvid = 'chatitems_'+invid;
					if(document.getElementById(tmpinvid))
					{
						invitation_div.innerHTML += '';
					}else{
						invitation_div.innerHTML += '';
						invitation_div.innerHTML += '<div class="chatitems" id="chatitems_'+invid[0].firstChild.nodeValue+'" >' + '<div class="chatimg"><a href="<?php echo base_url();?>user/send_message"><img src="'+profileImgChatThumbInv(imgsrc)+'"  /></a></div>' + '<div class="chatuser">' + user_node[0].firstChild.nodeValue + '</div>'  + '<div class="chattext"><div class="grp-btn"><a href="#" onclick="joingroup('+chatid[0].firstChild.nodeValue+');"><span class="red-btn">Join</span></a><a href="#" onclick="deleteinvitation('+chatid[0].firstChild.nodeValue+','+invid[0].firstChild.nodeValue+');" style="margin-left:10px;"><span class="blu-btn">Delete</span></a></div></div></div>';
					
					}
					
					invitation_div.scrollTop = invitation_div.scrollHeight;
					lastMessage = (message_nodes[i].getAttribute('id'));
					
					invcheck = 1;
				}
				if(invcheck == 1)
				{
					document.getElementById('invlbl').style.display = '';
					$('#invitations').show();
					$(".next-arrow").trigger("click");
				}
				
			}
			function joingroup(chatid)
			{
				$.get("<?php echo base_url();?>user/chat_update_invitation",{
							chat: chatid
													
						}, function(msg) {
							document.getElementById('invitations').innerHTML = '';
							$('.invitations').hide();
							//window.location.href="<?php echo base_url();?>user/invite/gid/"+chatid;
							document.getElementById('currentgroupid').value = chatid;
							document.getElementById('cancelchat').style.display = 'block';
							changegroup(chatid);
							/*var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += 'HAS ENTERED';*/
				});
			}
			//Add a message to the chat server.
			function sendChatText() {
				//clearTimeout(mTimer);
				
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage = document.getElementById('lastmessage').value;
				if(document.getElementById('txt_message').value == '' || document.getElementById('txt_message').value == 'Type message' || document.getElementById('txt_message').value == 'tipo de mensagem' || document.getElementById('txt_message').value == 'Tipo de mensaje') {
					alert("You have not entered a message");
					return;
				}
				// Play Sound
				$('#chatAudio')[0].play();				
				$.getJSON("<?php echo base_url();?>user/chat_update",{
							chat: chatgroupid,
							last: lastMessage,							
							message: document.getElementById('txt_message').value,							
							name: 'test name'						
						}, function(msg) {
							if(msg.blocked == 'blocked')
							{
								alert('You are blocked from chat please contact administrator');
								return false;
							}
							if(msg.banded == 'banded')
							{
								alert("You have typed an offensive word in your message. Please rephrase.");
								return false;
							}
							setTimeout('getChatText();',3000); 
							// Play Sound
							$('#chatAudio')[0].play();
				});		
				
				document.getElementById('txt_message').value = '';
				document.getElementById('txt_message').innerHTML = '';
			}
			function deletegroup()
			{
				var id = document.getElementById('grps').value;
				if(id)
				{
					$.getJSON("<?php echo base_url();?>user/chat_delete_group",{
								gid: id						
							}, function(msg) {
								
								if(msg.result == 'success')
								{
									window.location.reload();
								}
								
					});
				}
				
			}
			function deleteinvitation(gid,invid)
			{
				
				if(gid)
				{
					var ddataStringinvt = "gid="+gid;
					$.ajax({
						url: "<?php echo base_url();?>user/chat_delete_invitation",
						type: 'POST',
						data: ddataStringinvt,
						dataType: 'json',
						cache: false,
						success: function (msg){
							if(msg.result == 'success')
							{
								var tmpid = 'chatitems_'+invid;
								document.getElementById(tmpid).innerHTML = '';
								$('#invitations').hide();
								$('.invitations').hide();
								
							}
							
						}
					});
					
					
				}
				
			}
			function changegroup(gid)
			{
				document.getElementById('currentgroupid').value = gid;
				document.getElementById('lastmessage').value = 0;
				document.getElementById('div_chat').innerHTML = '';
				
				dataString = "gid="+gid;
				if(gid != 1)
				{
					if(document.getElementById('createchatgroup'))
					{
						document.getElementById('createchatgroup').style.display = 'none';
					}
				}else{
					if(document.getElementById('createchatgroup'))
					{
						document.getElementById('createchatgroup').style.display = '';
					}
					if(document.getElementById('cancelchat'))
					{
						document.getElementById('cancelchat').style.display = 'none';
					}
				}
				
				$.ajax({
					url: "<?php echo base_url("user/groupname");?>",
					type: 'POST',
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function (msg){
					userid = msg.results.uid;
					suserid = msg.sresults.uid;
					var profileid = <?php echo $profile['uid']; ?>;
						if(profileid == userid){
							var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += msg.sresults.firstName + ' has entered private chat room.';
						}else{
							var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += msg.results.firstName + ' has entered private chat room.';
						}
					}
				});
				
				getChatText();
			}

			function sendChatTextForm()
			{
				sendChatText();
				return false;
			}
			
			function cancelprivatechat()
			{
				
				var id = document.getElementById('currentgroupid').value;
				if(id)
				{
					var didataString = "gid="+id;
					$.ajax({
						url: "<?php echo base_url();?>user/chat_delete_invitation",
						type: 'POST',
						data: didataString,
						dataType: 'json',
						cache: false,
						success: function (msg){
							document.getElementById('currentgroupid').value = '0';
							if(document.getElementById('cancelchat'))
							{
								document.getElementById('cancelchat').style.display = 'none';
							}
							if(document.getElementById('privatechat'))
							{
								document.getElementById('privatechat').style.display = 'none';
							}
							if(document.getElementById('createchatgroup'))
							{
								document.getElementById('createchatgroup').style.display = '';
							}
							changegroup('1');
						}
					});
					
				}
			}
			function clearTimer()
			{
				clearTimeout(mTimer);
			}
/**
* End live chat script
* Script for livechat
*/	
</script>
<script>
// create your group javascript start
function sendMessage(){
	var _groupname = $('#chat_name').val();
	var _ownermessage = $('#owner_message').val();
	
	if(!_groupname){
		$('#dialog').html('The group name can not be empty!.');
		$('#dialog').dialog({modal:true});
		return;
	}
	if(!_ownermessage){
		$('#dialog').html('Please enter owner message!.');
		$('#dialog').dialog({modal:true});
		return;
	}
	$(this).attr('buttontype','doing');
	var _data = {groupname:_groupname,ownermessage:_ownermessage};
	
	$.getJSON('<?php echo base_url("user/chat_save_group");?>',_data,function(msg){
		if (String == msg.constructor) {      
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		
		if(json.status){
			$('#dialog').html('Send Success..');
			$('#dialog').dialog({modal:true});
			$('#chat_name').val('');
			$('#owner_message').val('');

			alert('group created');
			//document.location.href = '<?php echo base_url('user/chat_group/gid/');?>' + '/' + json.gid;
		}
		else{				
			$('#dialog').html(json.msg);
			$('#dialog').dialog({modal:true});
		}
		$('#send').attr('buttontype','done');
	})
}
$(function(){
	$('a@[href=#]').attr('href','javascript:void(0)');
	//username = false;
	$('#chat_name').blur(function(){
		//checkGroupname();
	});
	$('#send').click(function(){
		sendMessage();
	});
	
})
$('#crgroupid').click(function(){
	$('#createyourgroupcontainer').attr('style','display:block');
	$('#div_chat').attr('style','display:none;');
});
// create your group javascript end
</script>
<script>
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
		$.ajax({
			url: "<?php echo base_url('user/auto_chat_suggestion/');?>",
			data: 'act=autoSuggestUser&queryString='+inputString,
			success: function(msg){
				if(msg.length >0) {
					$('#suggestions').fadeIn();
					//alert(msg)
					$('#suggestionsList').html(msg);
					$('#country').removeClass('load');
				}
			}
		});
	}
}
</script>
<?php
$cnt = count($result1);
if($cnt > 0){
	?>
	<script type="text/javascript">
		if(document.getElementById('cancelchat')){
			document.getElementById('cancelchat').style.display = '';
		}
	</script>
	<?php
}
?>
<?php
if($this->session->userdata('roleId')=="0" and (isset($_GET['step']) and $_GET['step']=="final")) {?>
<script type="text/javascript">
/*$(document).ready(function(){
	$('#alertMsg').dialog({
		modal:true,
		//height:100,
		width:600,
		title:false,
		resizable:false
	});
$( ".blog-hight-light" ).addClass( "likepopup" );
});*/
</script>
<style>
 .ui-dialog .ui-dialog-titlebar-close{display:none;}
 .ui-button-text-only .ui-button-text{background-color: #0089D1 !important;color:white}
 .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{background-color: #3399CC !important; color: white;}
</style>
<?php 
$arrVal = $this->lookup_model->getValue('1322', $multi_lang); $lngWhat = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1319', $multi_lang); $lngChat = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1320', $multi_lang); $lngSrchTut = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1321', $multi_lang); $lngSetup = $arrVal[$multi_lang];
$this->session->set_userdata('firstTimeRegister','no');
?>
<div id="alertMsg" style="display:none;" class="like-popup">
	<div class="popup-step margin-top tutoe-step1">
		<h2><?php echo $lngWhat;?></h2>
		<ul>
			<li><a href="<?php echo base_url("user/dashboard?c=hang");?>" class="text-icon"><span><?php echo $lngChat;?></span></a></li>
			<li><a href="<?php echo base_url("search/search");?>" class="search-icon"><span><?php echo $lngSrchTut;?></span></a></li>
			<li><a href="<?php echo base_url("user/registerEdit");?>" class="setup-icon"><span><?php echo $lngSetup;?></span></a></li>
		</ul>
	</div>	
</div>
<?php }
if((isset($_GET['c'])) and $_GET['c']=="hang") {?>
<script type="text/javascript">
$(document).ready(function(){
//$("html, body").animate({ scrollTop: 620 }, 800);
$(".next-arrow").trigger("click");
});
</script>
<?php }?>
<div id="firstTour" title="" style="display:None;">
	<span class="popup-no">1</span>
	<div class="ratelist popup-row">
		<span class="title" style="float:left">
			<?php
			$arrVal = $this->lookup_model->getValue('1132', $multi_lang);
			$ChooseTutor = $arrVal[$multi_lang];
			echo $ChooseTutor;?>
		</span>  
	</div>
	<div class="ratelist popup-row">
		<p><span class="title" style="float:left;line-height:15px;">
			<?php
			$arrVal = $this->lookup_model->getValue('1133', $multi_lang);
			$SetCriteria = $arrVal[$multi_lang];
			echo $SetCriteria;?></span>
		</p>
		<p class="clearer"></p>
	</div>
	<div class="popup-step">
		<div class="step-div-bg">
			<div class="pop-pagin">
				<ul>
					<li class="active"><span>1</span></li>
					<li><span>2</span></li>
					<li><span>3</span></li>
					<li><span>4</span></li>
					<li><span>5</span></li>
					<li><span>6</span></li>
				</ul>
			</div>
			<a href="<?php echo base_url('search/search?step=1');?>"><?php //echo $STep;?>Next</a> 
		</div>
	</div>
</div>
<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
<script>
function sendBeepBoxMessage(uid)
{
	if(uid == '')
	{
		alert('Login First!');
		return false;
	}
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}
var dg =0;
function bookNow(tid,username,schoolId,hrate)
{
	if($(".video-icon").hasClass("loadingBk")){
		return;
	}
	$(".video-icon").addClass('loadingBk');
	bookNow1(tid,username,schoolId);
}
function bookNow1(tid,username,school_id)
{
	$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
	var mu_uid = $("#uid").val();
 
	if(mu_uid=='')
	{
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$('#dialog').attr('buttonType','done');
	$('#dialog').html('<?php echo $YouMust;?>');
	$( ".floating_form" ).show();
	}
	else
	{
	var lastClickedOnBook = false;
	//prevent multiple clicks
	if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	var refid ="<?php echo $Refid; ?>";
	
	var sessiontype=$('input[name=amex]:checked').val();
	if (school_id > 0 )
	{
		_data['schoolid']=school_id;
	}
	else
	{
		_data['schoolid']=0;
	}
	/* if(sessiontype==1 && refid != school_id)
	 {
		alert('You are not associated with this Tutor School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
		return false;
	 }*/
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		window.cost = json.cost;
		$('#bookingamount').val(window.cost);
		
		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(json.enough == false || json.enough == 'false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = true;
			
		}else if(json.availabletobook==false || json.availabletobook=='false'){
			window.returnvar = false;
			window.avl = false;
			window.profileComplete = true;
			
		}else if(json.profileCompletion==false || json.profileCompletion=='false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = false;
			
		}else{
			window.returnvar = true;
		}
		if(json.firstBookNow == false || json.firstBookNow == 'false'){
			window.firstBookNow = false;
		}else{
			window.firstBookNow = true;
			window.profileComplete = false;
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
		}
		
		if(json.enough)
		{
		window.enough=true;
		}
		else
		{
		window.enough=false;
		}
		setTimeout();
	})
	function setTimeout(){
		$(".video-icon").removeClass("loadingBk");
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				<?php
				$arrVal = $this->lookup_model->getValue('1127', $multi_lang);
				$YouAreTryingTo = $arrVal[$multi_lang];
				?>
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}else{
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,title:" ",resizable:false,  close: function( event, ui ) {self.location = self.location.href;}});
				return false;
			}else if(window.profileComplete == false){
				alert('<?php 
				$arrVal 	= $this->lookup_model->getValue('1057', $multi_lang);	$PleaseComplete 	= $arrVal[$multi_lang];
				echo $PleaseComplete;?>');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
			else if(window.enough==true){
				 var message ="<?php 
				 $arrVal 	= $this->lookup_model->getValue('1006', $multi_lang);	$tutotwillsendnoamount 	= $arrVal[$multi_lang];
				 echo $tutotwillsendnoamount;?>";
				  var conf = confirm(message);
				  var classcost = window.cost;
					if(conf == true)
					{
					// send message to tutor
						$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
							
							//redirect to student dashboard page
								//window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});return;
					callback(false);
					}else{
						return;
					}
					callback(false);
			}
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = '<?php $arrVal 	= $this->lookup_model->getValue('1084', $multi_lang);	$insuuffi	= $arrVal[$multi_lang];echo $insuuffi;?>';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,  buttons: [
         
        {
            text: "Ok",
            "class": 'saveButtonClass',
            click: function() {
                window.location.href = rechargeURL;
            }
        }
    ],
    close: function() {
       
    }});
				return false;
			}
		}else{
			$.unblockUI();
			
			var classcost = window.cost;
			$('#dialog1').dialog({
					modal:true,
					width:'430px',
					resizable:false,
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
							$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						/*alert(msg);
						return false;*/
						//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});
						return;callback(false);
						$(this).dialog("close");},
						"Cancel": function() { $(this).dialog("close");}
					}
			});
			/*
			var conf = confirm(message);
			var classcost = window.cost;
			if(conf == true)
			{	
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			return;callback(false);
			}else{
			  
				return false;
			}*/
			lastClickedOnBook = false;
		 
		}
		return false;
	}//,4000);return false;
}}
function Beforethetime()
{
	$('#preventdialog').dialog({
		modal:true,
		width:'300px'
	});
}
function closePrevent()
{
	$('#preventdialog').dialog('close');
}
</script>
<div id="fullDialog" style="display:None;">
	<div class="ratelist">
	<?php
	if ($AdvanceSession=='None') {
		$AdvanceSession='none';
	} else { 
		$AdvanceSession=hiaOutTime($AdvanceSession['Time']); 
	}?>
	<span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;">
		<?php
		$arrVal = $this->lookup_model->getValue('1217', $multi_lang);
		$sorrylate = $arrVal[$multi_lang];
		echo $sorrylate."   ".$AdvanceSession;?>
	</span>
	</div>
	<br><br><br>
	<p>
		<input type="button" value="Ok" onclick="closeFullpopup();" id="buttonOk" class="blu-btn"/>
	</p>
</div>
<div id="preventdialog" style="display:None;">
	<div class="ratelist">
		<span class="title" style="float:left;margin-top:10px;margin-bottom:15px !important;font-size:16px !important;">
			<?php
			$arrVal = $this->lookup_model->getValue('1209', $multi_lang);
			$MustBewithin = $arrVal[$multi_lang];
			echo $MustBewithin;
			?>
		</span>  
	</div>
	<br><br><br>
	<p>
		<?php 
		$arrVal = $this->lookup_model->getValue('283', $multi_lang);
		$Ohk = $arrVal[$multi_lang];?>
		<input type="button" value="<?php echo $Ohk;?>" onclick="closePrevent();" id="buttonOk" class="blu-btn"/>
	</p>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#topic").change(function(){
		$("#preview_link").attr("href","javascript:void(0);");
		if($("#topic").val()!="") {
			$("#preview_link").attr("href",$("#topic option:selected").attr("href"));
		}
	});
	$("#topic").trigger("change");
	$("#preview_link").on("click",function(){
		if($("#topic").val()=="") {
			<?php
			$arrVal = $this->lookup_model->getValue('1358', $multi_lang);
			$alertTopic = $arrVal[$multi_lang];			
			?>
			alert("<?php echo $alertTopic;?>");
			$("#topic").focus();
			return false;
		}
	});
	$("#saveTopic").click(function(){
		if($("#topic").val()!="") {
			var selTopic = $("#topic").val();
			$.post("<?php echo base_url("user/ajax_insTopic");?>",{"selTopic":selTopic},function(){
				<?php
				$arrVal = $this->lookup_model->getValue('1120', $multi_lang);?>
				alert("<?php echo $arrVal[$multi_lang];?>");
			});
		} else {
			<?php
			$arrVal = $this->lookup_model->getValue('1358', $multi_lang);
			$alertTopic = $arrVal[$multi_lang];			
			?>
			alert("<?php echo $alertTopic;?>");
			$("#topic").focus();
		}
		return false;
	});
	
	// Open Sample Video from Stat your session Block
	jQuery(".lnkSample").click(function(){
		jQuery("#vidDialog video").get(0).currentTime = 0;
		jQuery("#vidDialog").dialog({
			dialogClass: "helpvideo",
			resizable: false,
			width:'auto',
			modal: true,
			close:function(){
				//reLoad();
				jQuery("#vidDialog video").get(0).pause();
			}
		});
	});
	
	// Delete Next Session From Start Your Session Block
	$('.delClass').click(function(){
		if(!$(this).hasClass('disabled')){
			if(window.confirm('<?php $arrVal = $this->lookup_model->getValue('478', $multi_lang);$lDELETE_SESSION_MSG = $arrVal[$multi_lang];echo $lDELETE_SESSION_MSG;?>')){
				$(this).addClass('disabled');
				var _id = $(this).attr('theClassid');
				var _delObj = $(this);
				$.get('<?php echo base_url('user/studentdelClass');?>',{id:_id},function(msg){
					<?php
					$arrVal = $this->lookup_model->getValue('479', $multi_lang);
					$lDELETE_SUCCESS = $arrVal[$multi_lang];?>
					alert('<?php echo $lDELETE_SUCCESS;?>');
					self.location.reload();
					//_delObj.parents('li').remove();
				});
			} 
		}
	});
});
</script>
<div id="vidDialog" style="display:none;">
	<video width="600"  controls poster="<?php echo base_url("/images/sample-vee-session-video.jpg");?>">
	  <source src="<?php echo base_url("/video/sample-vee-session-video.mp4");?>"  type="video/mp4">
	Your browser does not support the video tag.
	</video> 
</div>
<?php $this->layout->appendFile('javascript',"js/fileuploader.js");?>
<?php $this->layout->appendFile('javascript',"js/ajaxupload.3.6.js");?>
<?php $this->layout->appendScript('var provice = {};');?>
<?php $basePath =  substr(BASEPATH,0,-7);  ?>	
<?php $this->layout->appendFile('javascript',"js/jquery.blockUI.js"); ?>
<?php $this->layout->appendFile('css',"css/fileuploader.css");?>
<script type="text/javascript" src="<?php echo base_url('js/highslide/highslide-with-html.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/highslide/highslide.css')?>" />
<script type="text/javascript">
$(document).ready(function(){	
	hs.graphicsDir = '<?php echo base_url(); ?>js/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'draggable-header';
	if (!String.prototype.trim) {
	 String.prototype.trim = function() {
	  return this.replace(/^\s+|\s+$/g,'');
	 }
	}		
	var button14 = $('#profile_image_upload'), interval;
	new AjaxUpload(button14,{
	   
			action: '<?php echo Base_url('user/profile_image');?>', 
			name: 'userfile',
			id: 'hupld',
			enable:true,
			onSubmit : function(file, ext){
			
				$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading26.gif" />' });
			
				this.disable();
													
				interval = window.setInterval(function(){
					var text = $("#dialog p").html();
					
					if (text.length < 13){
						$( "#dialog p").html(text + '.');
					} else {
						$( "#dialog p").html('Uploading');				
					}
				}, 200);
			},
			onComplete: function(file, response){
			 
			//alert('here1');return false;
				$.unblockUI();
				$('#dialog').attr('buttontype','done');
				$( "#dialog:ui-dialog" ).dialog( "destroy" );
				window.clearInterval(interval);
				this.enable();
				response = JSON.parse(response);
				 
				var url = "<?php echo base_url('user/browse_image_view/image/')?>";
				
				hs.htmlExpand(null, { objectType: 'iframe', width:'1200', height:'700' ,src:url } )
				var timer = setInterval(function() {   
					var cls = $('#hihid').val();
				
					if(cls == 1) {  
						clearInterval(timer); 
						//$('#profile_image_show').attr('src',response.address);
						$('#profile_image_upload').attr('src',response.address);
						var newthumburl = '<?php echo base_url()."timthumb.php?src=" ?>'+response.address+'&w=30&h=30&zc=0'
					
						$('.vAgn_m').attr('src',newthumburl);
						$('#hihid').val('0');
					}  
				}, 500); 
				
			}
		});
});	
$(document).keyup(function(e){
        
		if (e.keyCode == 27) {
		closewinhs();
		}
		});
		function closehs(){
			$('#hihid').val('1');
		}
		function closewinhs(){
			parent.window.hs.close();
			var ppic = $('#profilehpic').val();
			var nimg = '<?php echo base_url()."uploads/images/thumb"; ?>/'+ppic;
			var ddataStringinvt = "img="+ppic;
			 
			$.ajax({
				url: "<?php echo base_url();?>user/revert_profile_image",
				type: 'POST',
				data: ddataStringinvt,
				dataType: 'json',
				cache: false,
				success: function (msg){
				//alert(msg);
					if(msg.result == 'success'){
						$('#profile_image_show').attr('src',nimg);
						$('.vAgn_m').attr('src',nimg);
					}
				}
			});
		}
</script>
<input type="hidden" id="hihid" value="0" />
<!-- Add Sound to Body For Chat -->
<script type="text/javascript">
$(document).ready(function(){
	//Appending HTML5 Audio Tag in HTML Body
	/*$('<audio id="chatAudio"><source src="notify.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="notify.wav" type="audio/wav"></audio>').appendTo('body');*/
	$('<audio id="chatAudio"><source src="<?php echo base_url('css/audioPlayer/Blop.mp3');?>" type="audio/mpeg"></audio>').appendTo('body');
});
function closeFunc()
{
	$('#dialog1').dialog('destroy');
}
</script>
<div id="dialog1" title="" style="display:None;">
	<div class="ratelist">
		<span class="title" style="float:left"><?php echo $confirmyourbooking;?> <input type='text' align="center" name='bookingamount' id='bookingamount' value='0' style="color: #3399cc; font-size: 20px; font-weight: normal; margin-bottom: 3px; width:60px; border:0px;" readonly	> <?php echo $creditstext;?></span>
	</div>
	
	<div class="ratelist">
		<br><p><span class="title" style="float:left; color:black;"><?php echo $tutorwillbesent;?></span>  </p>
		<br>
		<p><span class="title" style="float:left; color:black;"><?php echo $whentutorarrives;?></span>  </p>
		<p class="clearer"></p>
	</div>
</div>
<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
    

<script src="<?php echo base_url("js/jquery.popupoverlay.js");?>" ></script>
<script>
$(document).ready(function (event) {
	$('#video_popup190516').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s'
    });
});
</script>
<style>
.video_popup190516{ background: #fff none repeat scroll 0 0;
    border-radius: 5px;
    margin: 0 auto;
    max-width: 816px;
    overflow:visible;
    padding: 10px; position:relative;}
.popup_close_icon_190516 {
    background: rgba(0, 0, 0, 0) url("../../../../images/main/video-close-btn.png") no-repeat scroll 0 0;
    display: block;
    height: 47px;
    position: absolute;
    right: -20px;
    top: -20px;
    width: 47px;
    z-index: 999;
}
.popup_close_icon_190516 a {
    display: block;
    height: 35px;
    width: 35px;
}

.video_like01 {padding-bottom: 5px;}
.video_like01 span {float: left; font-size: 12px; line-height: 15px; padding-right: 5px;}
.video_like01 img {float: left; padding-right: 5px; width: 27px; border:0px !important;}
</style>