<?php $this->layout->setLayoutData('content_for_layout_title','User Statement');?>
<table class="data_table">
	<thead>
		<tr>
			<th align="left">Date</th>
			<th align="left">Type</th>
			<th align="right" style="text-align:right;">Amount</th>
			<th align="right" style="text-align:right;">Balance</th>
		</tr>
   </thead>
   <?php 
	if($transactions){?>
	<tbody>
		<?php
		$i			= 0; 
		$total 		= isset($profile['money']) ? $profile['money'] : 0;
		foreach($transactions as $trans):
			if ($i==0) {
				 $total;
			} else {
				 $total += $amount*(-1);
			}?>
		<tr>
			<td align="left"><?php echo date("m/d/Y H:i:s",outTime($trans['payment_date']));?></td>
			<td align="left">
				<?php
				if ($trans['type']=="Cashout" and $trans['payment_status'] == "Refund") {
					echo $trans['type']." Refund";
				} else {
					echo $trans['type'];
				}
				?>
			</td>
			<td align="right" style="text-align:right;">
				<?php
				$amount = ($trans['amount_status']=="debit" and ($trans['payment_status'] != "Refund")) ? ($trans['amount']*(-1)) : $trans['amount'];
				echo "$".$amount;
				?>
			</td>
			<td align="right" style="text-align:right;"><?php echo "$".sprintf("%0.2f",$total);?></td>
		</tr>
		<?php
		$i++;
		endforeach;?>
	</tbody>
   <?php } else {?>
	<tbody>
		<tr><td colspan='4' align="center">No Transaction Found</td></tr>
	</tbody>	
   <?php }?>
</table>
<script type="text/javascript">
setTimeout('showmenu("usermenu",2)',1000);
</script>