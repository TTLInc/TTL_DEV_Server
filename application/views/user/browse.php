<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('js/imagecrop/jquery.Jcrop.js'); ?>"></script>
<script src="<?php echo base_url('js/imagecrop/jquery.color.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('js/imagecrop/main.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('js/imagecrop/demos.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('js/imagecrop/jquery.Jcrop.css'); ?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('highslide/highslide-with-html.js')?>"></script>
	<?php
		if($success == 'true')
		{
			echo '<script type="text/javascript" >
					parent.window.closehs();
					parent.window.hs.close();
				  </script>';exit;
		}
	?>


<?php $basePath =  substr(BASEPATH,0,-7);  ?>
<?php
$filename = $basePath.'uploads/images/resized/'.$imgsrc;
if(file_exists($filename))
{
	
	@$size = getimagesize($filename);
	/*
	if($size[0]>1180)
	{
		$nwidth = 1180;
		echo '<style>.jcrop-holder img{max-width:1180px !important;} .jcrop-holder {max-width:1180px !important;}</style>';
	}else
	{
		$nwidth = $size[0];
	}
	if($size[1]>550)
	{
		$nheight = 550;
		echo '<style>.jcrop-holder img{max-height:550px !important;} .jcrop-holder {max-height:550px !important;}</style>';
	}else{
		$nheight = $size[1];
	}
	*/
}
?>	
<script type="text/javascript">

  $(document).ready(function() {
	var api;
    
	$('#cropbox').Jcrop({
      bgFade:     true,
      bgOpacity: .2,
	  //allowResize:0,
	  allowSelect: false,
	  //setSelect:   [ 275, 275, 15, 15 ],
            aspectRatio: 1,
	 onSelect: updateCoords
    },function(){
      api = this;
	  api.animateTo([15,15,260,260]);
  })

  $('#imgrect').Jcrop({
	
      bgFade:     true,
      bgOpacity: .3,
	  //allowResize:0,
	  allowSelect: false,
	  setSelect:   [ 0, 0, 150, 150 ],
      aspectRatio: 150/100,
	 onSelect: updateCoords
    },function(){
      api = this;
	  api.animateTo([10,20,260,270]);
  })
	
  function updateCoords(c)
  {
	//alert(val(c.w))
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
});
</script>
<style>
.jc-demo-box .page-header h1{ background:none !important; padding:0px !important; margin:0px !important; font-size:16px !important;}
.container:before, .container:after{ margin:0px 15px;}
.jcrop-holder div div img{ /*max-width:1180px !important;*/ overflow:hidden !important;}
.jcrop-holder{  overflow:hidden !important;}
.container{ margin:0px !important; padding:0px;}
/*.jc-demo-box{ width:1500px;}
.jc-demo-box img{ width:1500px;}*/
.jc-demo-box h2{ font-size:14px; margin:0px; padding:0px 0; line-height:30px;}
.span12{ width:auto !important}
.jcrop-holder{ margin:0 auto;}
</style>
</head>

<body>

<div class="container" style="margin:0 auto; text-align:center;">
<div class="row">
<div class="span12">
<div class="jc-demo-box">
		<h2>Drag and resize the thumbnail box over the desired area.</h2>
<form action="<?php echo base_url('user/crop_image'); ?>" method="post" style="margin:25px auto 0 auto; padding:0px; width:1180px; text-align:center;">
			<input type="hidden" id="x" name="x" value="15" />
			<input type="hidden" id="y" name="y" value="15" />
			<input type="hidden" id="w" name="w" value="275"/>
			<input type="hidden" id="h" name="h" value="275" />
			<input type="submit" value="Upload" class="btn btn-large btn-inverse"  />
		</form>
		
		<?php if($this->session->userdata['roleId'] == 4 ){ ?>
		<img src="<?php echo base_url('uploads/images/resized/'.$imgsrc); ?>" id="imgrect"  />
		<?php } else {?>
		<img src="<?php echo base_url('uploads/images/resized/'.$imgsrc); ?>" id="cropbox"  />
		<?php }?>
	</div>
	</div>
	</div>
	</div>
	</body>

</html>
