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
$arrVal = $this->lookup_model->getValue('104', $multi_lang);
$lhistory = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('105', $multi_lang);
$lmonthly = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('106', $multi_lang);
$lannually = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('107', $multi_lang);
$ltotal = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('78', $multi_lang);
$ldate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);
$ltutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('111', $multi_lang);
$lstudent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('244', $multi_lang);
$ltalkmap = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('245', $multi_lang);
$lmytalklist = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('246', $multi_lang);
$lshareonfb = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('247', $multi_lang);
$llocationoftutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('248', $multi_lang);
$llocationofstudent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('249', $multi_lang);
$lzoomin = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('250', $multi_lang);
$lapproxlocation = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('251', $multi_lang);
$llocationshow = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('108', $multi_lang);
$lmin = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('159', $multi_lang);
$lview = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('445', $multi_lang);	$lSTUDENT_ATTENDANCE   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('530', $multi_lang);	$lABSENT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('531', $multi_lang);	$lPRESENT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('532', $multi_lang);	$lSHARE_ON_FACEBOOK   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('652', $multi_lang);	$lSHARE_ON_FACEBOOK_tip   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('894', $multi_lang);	$types   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('702', $multi_lang);	$personals   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('895', $multi_lang);	$orgs   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('321', $multi_lang);	$lcredits  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('902', $multi_lang);	$statement = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1271', $multi_lang);	$lngbalance = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('418', $multi_lang);	$lngNoRecord = $arrVal[$multi_lang];
?>
<div class="bd">
	<div class="historyWp">
		<table align="center" border='10' width="90%" cellpadding="2">
			<thead>
				<tr>
					<td align="center" colspan="3" style="padding:0px;margin:0px;">
						<img src='<?php echo base_url('images/affiliate.png');?>' />
					</td>
				</tr>
				<tr>
					<td align="left" colspan="3">
						<?php echo $rptTitle;?>
					</td>
				</tr>
				<tr bgcolor='#3399CC' style="color:#ffffff;">
					<th style="color:#ffffff;" align="left"><?php echo $ldate;?></th>
					<th style="color:#ffffff;" align="left"><?php echo $types;?></th>
					<th style="color:#ffffff;" align="right"><?php echo $lcredits;?></th>
				</tr>
		   </thead>
		   <?php 
			if($transactions){?>
			<tbody>
				<?php
				$i			= 0; 
				$total 		= 0;
				foreach($transactions as $trans):?>
				<tr>
					<td align="left"><?php echo date("y/m/d",outTime($trans['endTime']));?></td>
					<td align="left"><?php echo $trans['type'];?></td>
					<td align="right">
						<?php 
							//echo $amount = ($trans['amount_status']=="debit"  and ($trans['payment_status'] != "Refund")) ? ($trans['amount']*(-1)) : $trans['amount'];
							//$total += ($amount*1);
							echo $trans['t_hrate'];
						?>
					</td>
				</tr>
				<?php
				$i++;
				endforeach;?>
			</tbody>
			<tfoot>
				<tr><td colspan='3'><hr color='#d7bc4d' /></td></tr>
				<tr>
					<td align="left" colspan="2"><?php echo "Monthly Transaction Total";?></td>
					<td align="right"><?php //echo $total += ($trans['t_hrate']*1);;
					echo $Totaltransactions[0]['totalhrate'];
					?></td>
				</tr>
		   </tfoot>
		   <?php } else {?>
			<tbody>
				<tr><td colspan='3' align="center"><?php echo $lngNoRecord;?></td></tr>
			</tbody>	
		   <?php }?>
		</table>
	</div>
</div>