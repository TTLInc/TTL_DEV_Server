<?php $this->layout->setLayoutData('content_for_layout_title','School Credits');?>
<!-- fixed success msg style BY TECHNO-SANJAY -->

 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script >
<style>
.select2-results__message{
	display:none !important;
}
</style>

	<form method="post" action="enter_credit">
			<table>
				<tr>
					<td style="padding:10px;">Select School :</td>
					<td style="padding:10px;">
						<select name="school" style="width: 253px; height: 35px;">
							<option value="">Select School</option>
							<?php 
								foreach($data as $school => $value) 
								{
								   //$school = htmlspecialchars($school); 
								   echo '<option value="'. $value->id .'">'. $value->firstName . '-' . $value->id .'</option>';
								}
							?>
							</select>
					<!--	<select style="width:250px" class = "itemName" name="school" >	</select >  -->
					</td>			
				</tr>
				<tr>
					<td style="padding:10px;">Credit Purchase :</td>
					<td style="padding:10px;"><input type="text" name="credit" style="height: 30px; width: 250px;" ></td>			
				</tr>
				<tr>
					<td style="padding:10px;">Platform Fee :</td>
					<td style="padding:10px;"><input type="text" name="platform" style="height: 30px; width: 250px;" ></td>			
				</tr>
				
				
				<tr>
					<td></td>
					<td ><button type="Submit" style="background-color:#3399cc; margin-top:5px; margin-left:10px; padding: 8px; cursor:pointer; border-radius: 5px; border: none; color:#fff">Add Record</button></td>
				</tr>
				 			 
			</table>
			<?php if($this->session->flashdata('msg')): ?>
			<script>
			alert('Credits have been added successfully to the selected school.');
			</script>
			<?php endif; ?>
	
    </form>

			<button style="background-color:#3399cc; float: right; margin-top: -31px; padding: 8px; cursor:pointer; border-radius: 5px; border: none; color:#fff;"><a style="color:#fff" href="<?php echo base_url() . "admin/list_schools"; ?>">List Of School</a></button>

<script>
   $('.itemName').select2({
        placeholder: '--- Select School ---',
        ajax: {
          url: '<?php echo base_url('admin/autocomplete_school/'); ?>',
          dataType: 'json',
          delay: 250,
          processResults: function (data,page) {
			  var select2data = $.map(data, function(obj) {
				 
            obj.id = obj.uid;

            obj.text = obj.text + '-' + obj.uid;
            return obj;
          });
			return {
				
				results: select2data
            // results: data
            };
          },
		   cache: true,
		   disable:false,
        }
      }); 
</script>  