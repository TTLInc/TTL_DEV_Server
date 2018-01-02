<?php $this->layout->setLayoutData('content_for_layout_title','Group Session List');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/CreateSession').'">Create New</a>');?>

<table class="data_table">
    <thead>
        <tr>
            
            <th>Id</th> 
            <th>Start Time</th>
			<th>Topic</th>
            <th>Tutor1</th>
            <th>Tutor2</th>
			 
			<th>PRIMARY</th>
			 
            <th>Options</th>
        </tr>
    </thead>
<?php 

		?>
    <tbody>
    <?php foreach ($Sessions as $key => $val) :?>
         <tr id="id_<?php echo $val['gropsessionId'];?>">
             <td><?php echo $val['gropsessionId'];?></td>
			<td>
			<?php
			$actual= strtotime($val['Time']);
			$actual=$actual-(7*3600);
			echo date( 'h:i a, M d, Y' ,$actual); 
			
			//echo  ($val['Time']);?>
			
			</td>
			 <td><?php echo  $val['Topic'];?></td>
            <td><?php echo $val['tutor1'];?></td>
            <td><?php echo $val['tutor2'];?></td>
           <td> <?php echo $val['isprimary'];?></td>
			<td>
			 
            <a href="<?php echo base_url('admin/SessionEdit/id/'.$val['gropsessionId']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
			 
            <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['gropsessionId']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            <a class="button" href="<?php echo base_url('admin/ExportSession/id/'.$val['gropsessionId']);?>">Export </a>
			</td>
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
            <div class="bulk-actions align-left">
           <div class="pagination">
            <?php echo $page;?>
            </div>
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("Sessionmenu",1)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/DeleteSession")?>',{id:_id},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$.each(json.ids,function(k,v){
					$('#id_'+v).remove();
				})
				alert('Successfully deleted');
			}
			else{
				alert(json.msg);
			}
		})
	}
}
$('.delcat').click(function(){
		del([$(this).attr('mid')]);
	})
</script>
</body>
</html>
