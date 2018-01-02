<?php $this->layout->setLayoutData('content_for_layout_title','List Of Schools');?>

<table class="data_table">
	<tr>
		<th>ID</th>
		<th>School Name</th>
		<th>Credit Balance</th>
	</tr>
	<?php foreach($data as $school){
		
			if($school->credit_balance == ""){
			}else{
		?>
	<tr>
		<td><?php echo $school->id;?></td>
		<td><?php echo $school->firstName;?></td>
		<td><?php echo $school->credit_balance;?></td>
	</tr>
			<?php } } ?>
</table>

		
		
			<!--		<div class="row">
				<div class="col-md-12 text-center">
					<?php // echo $links; ?>
				</div>  
    </div> -->
			 