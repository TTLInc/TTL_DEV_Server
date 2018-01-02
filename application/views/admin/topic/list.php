<!-- [Content] start -->

<?php $this->layout->setLayoutData('content_for_layout_title','Forum');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/topic/add').'">Add new Topic</a>');?>

<?php if (isset($notice) || $notice = $this->session->flashdata('notification')):?>
<p class="notice"><?php echo $notice;?></p>
<?php endif;?>

<table class="data_table">
	<thead>
		<tr>
			<!--<th><input type="checkbox" class="check-all" /></th>-->
<th width="1%" class="center">#</th>
<th width="18%"><?php echo "Title";?></th>
<th width="50%"><?php echo "Description";?></th>
<th width="3%"><?php echo "Messages";?></th>
<th width="7%" colspan="3"><?php echo "Action";?></th>
		</tr>
	</thead>

	<tbody>
	<?php if ($rows) : ?>
	<?php $i = 1; foreach ($rows as $row): ?>
	<?php if ($i % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>
	<tr class="<?php echo $rowClass?>">
	<td valign="top">
	</td>

	
	
	<td valign="top">
	<?php echo anchor('forum/topic/' . $row['tid'], strip_tags($row['title']), array('target' => '_blank')) ?>
	</td>
	<td valign="top">
	<?php echo $row['description'] ?>
	</td>
	<td valign="top">
	<?php echo $row['messages'] ?>
	</td>
	<!--<td><a href="<?php echo site_url('forum/topic/'. $row['tid'])?>" target="_blank"><?php echo "View";?></a></td>-->
	<td>
	<div class="rw9">
	<a href="<?php echo site_url('admin/topic/edit/'.$row['tid'])?>"><img src="<?php echo base_url('/images/cm_pencil.png');?>" alt="Edit"></a>
	<a href="<?php echo site_url('admin/topic/delete/'.$row['tid'])?>"><img src="<?php echo base_url('/images/cm_cross.png');?>" alt="Delete"></a></td>
	</div>
	</tr>
	<?php $i++; endforeach; ?> 
	</tbody>
	<?php endif ?>
</table>
<script type="text/javascript">
setTimeout('showmenu("psettings",9)',1000);
</script>
