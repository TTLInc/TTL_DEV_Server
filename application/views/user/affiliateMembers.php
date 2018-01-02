 
<style>
.wrapper{
	width:1065px;
}
.header {
	border-bottom:0px !important;
}
.content h2{
	margin-top:0px;
	margin-bottom:0px;
	line-height:normal;
	font-weight:300 !important;
	
}
.show_hide {
    display:none;
}
.show_hide_tutor {
    display:none;
}
.show_hide_student {
    display:none;
}

.top_link2{
	height:85px !important;
}
p{
	margin-bottom:0px !important;
}
.speak_like_native{
	font-size:1.4em !important;
	font-weight:500 !important;
}
.footer .socialize span{
	font-size:14px !important;
}
.footer_links{
	font-size:12px !important;
}
#table-wrapper {
  position:relative;
}
#table-scroll {
  height:300px;
  overflow:auto;  
  margin-top:20px;
}
#table-wrapper table .text {
  position:absolute;   
  z-index:2;
  width:17%;
  background-color:#D3D3D3;
}
#table-wrapper table .text1 {
  position:absolute;   
  z-index:2;
  width:26%;
   background-color:#D3D3D3;
}
#table-wrapper table .text2 {
	 position:absolute;   
  text-align:center;   
  z-index:2;
  width:17%;
   background-color:#D3D3D3;
}

#table-wrapper_tutor {
  position:relative;
}
#table-scroll_tutor {
  height:200px;
  overflow:auto;  
  margin-top:20px;
}
#table-wrapper_tutor table .text {
  position:absolute;   
  z-index:2;
  width:17%;
  background-color:#D3D3D3;
}
#table-wrapper_tutor table .text1 {
  position:absolute;   
  z-index:2;
  width:26%;
   background-color:#D3D3D3;
}
#table-wrapper_tutor table .text2 {
	position:absolute;      
	z-index:2;
	width:17%;
    background-color:#D3D3D3;
}


#table-wrapper_student {
  position:relative;
}
#table-scroll_student {
  height:200px;
  overflow:auto;  
  margin-top:20px;
}
#table-wrapper_student table .text {
  position:absolute;   
  z-index:2;
  width:17%;
  background-color:#D3D3D3;
}
#table-wrapper_student table .text1 {
  position:absolute;   
  z-index:2;
  width:26%;
   background-color:#D3D3D3;
}
#table-wrapper_student table .text2 {
	position:absolute;      
	z-index:2;
	width:17%;
    background-color:#D3D3D3;
}
.header .top_navi .navi_col ul li ul{
	top:85px;
}
.header .inner-navi .navi_col2 a.top_link2{
	font-weight:normal;
}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

	<script>
$(document).ready(function () {

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"';

				// Deliberate 'false', see comment below
        if (false && window.navigator.msSaveBlob) {

						var blob = new Blob([decodeURIComponent(csv)], {
	              type: 'text/csv;charset=utf8'
            });
            
            // Crashes in IE 10, IE 11 and Microsoft Edge
            // See MS Edge Issue #10396033: https://goo.gl/AEiSjJ
            // Hence, the deliberate 'false'
            // This is here just for completeness
            // Remove the 'false' at your own risk
            window.navigator.msSaveBlob(blob, filename);
            
        } else if (window.Blob && window.URL) {
						// HTML5 Blob        
            var blob = new Blob([csv], { type: 'text/csv;charset=utf8' });
            var csvUrl = URL.createObjectURL(blob);

            $(this)
            		.attr({
                		'download': filename,
                		'href': csvUrl
		            });
				} else {
            // Data URI
            var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

						$(this)
                .attr({
               		  'download': filename,
                    'href': csvData,
                    'target': '_blank'
            		});
        }
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        var args = [$('#dvData>table'), 'affiliate.csv'];
        
        exportTableToCSV.apply(this, args);
        
        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
	    $(".export_tutor").on('click', function (event) {
        // CSV
        var args = [$('#dvData_tutor>table'), 'tutors.csv'];
        
        exportTableToCSV.apply(this, args);
        
        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
	    $(".export_student").on('click', function (event) {
        // CSV
        var args = [$('#dvData_student>table'), 'students.csv'];
        
        exportTableToCSV.apply(this, args);
        
        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
	
});
</script>
</head>


<body>
		
		<div style="width:1086px; margin:0 auto;" >
           <div style="width:100%" class="hd">
			   <div class="content"><h2 style="font-size:32px; padding-bottom:15px;">My Members</h2></div>
			</div>
			
		  
		
			 <div style="width:100%; float:left;  border-bottom: 3px dotted #D3D3D3;">
				<div style="width:85%; float:left" class="hd">
					<div class="content"><h2 style=" border-bottom: 0px dotted #D3D3D3; font-size:22px;"><span style="color:#E8B800">Tutor List</span> <a href="#" class="export_tutor">[Export]</a> </h2></div>

				</div>
					
				
				<div style="height:52px;">
					<a href="#" class="show_hide_tutor"  style="float:right; font-size:28px;"><span id="plus_tutor" style="padding-top: 15px; font-size:25px;" class="glyphicon glyphicon-triangle-bottom"></span></a>
				</div>
			</div>
			
			<div class="slidingDiv_tutor" style="width:100%; float:left; padding-bottom: 50px;">
				<div id="table-wrapper_tutor">
				<div id="table-scroll_tutor">
				<div id="" >
				<table style="width:100%; font-size:16px;">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%;"><span  style="width:11%; padding: 15px 10px;" class="text" >ID</span></td>
					<td style="width:15%;"><span style="width:15%; padding: 15px 10px;" class="text">Name</span></td>
					<td style="width:10%;"><span style="width:11%; padding: 15px 10px; " class="text">Country</span></td>
					<td style="width:25%;"><span style="width:25%; padding: 15px 10px;" class="text2">Email</span></td>
					<td style="width:15%;"><span style="width:16%; padding: 15px 10px;" class="text1">Affiliate Name</span></td>
					<td style="width:15%;"><span style="width:15%; padding: 15px 10px;" class="text1">Total Sessions</span></td>
					<td style="width:10%;"><span style="width:10%; padding: 15px 10px;" class="text1">Delete</span></td>
				</tr>
					<?php
					if(empty($tutors)){ ?>
						<tr style="width:100%; font-size:16px;">	
							<td colspan="8" style="width:100%; padding: 15px 10px; text-align:center;">No Tutor members registered yet.</td>
						</tr>
			<?php 	}else { ?>
				<?php foreach($tutors as $tutor){ ?>
			
				<tr style="padding:15px 10px;">	
						<td style="width:10%; padding: 15px 10px; "><?php echo $tutor->uid; ?></td>
						<td style="width:15%; padding: 15px 10px; "><?php echo $tutor->firstName; ?></td>
						<td style="width:10%; padding: 15px 10px; "><?php echo $tutor->country; ?></td>
						<td style="width:25%; padding: 15px 10px;"><?php echo $tutor->email; ?></td>
						<td style="width:15%; padding: 15px 10px; "><?php echo $affiliate_name; ?></td>
						<td style="width:15%; padding: 15px 10px; text-align:center" ><?php echo $tutor->total_session; ?></td>
						<td style="width:10%; padding: 15px 10px; text-align:center"><a href="<?php echo base_url() . "user/delete_tutor_affi/" . $tutor->uid; ?>">X</a></td>

				</tr>
				  <?php } }?>
				</table>
				</div>
				
				<div id="dvData_tutor" style="display:none">
				<table style="width:100%; font-size:16px;">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%;"><span  style="width:10%; padding: 15px 10px;" class="text" >ID</span></td>
					<td style="width:10%;" ><span style="width:10%; padding: 15px 10px;" class="text">Name</span></td>
					<td style="width:10%;"><span style="width:10%; padding: 15px 10px; " class="text">Country</span></td>
					<td style="width:20%;"><span style="width:20%; padding: 15px 10px;" class="text2">Email</span></td>
					<td style="width:15%;"><span style="width:15%; padding: 15px 10px;" class="text1">Affiliate Name</span></td>
					<td style="width:15%;"><span style="width:15%; padding: 15px 10px;" class="text1">Total Sessions</span></td>

				</tr>
				<?php foreach($tutors as $tutor){ ?>
			
				<tr style="padding:15px 10px;">	
						<td style="width:10%; padding: 15px 10px; "><?php echo $tutor->uid; ?></td>
						<td style="width:10%; padding: 15px 10px; "><?php echo $tutor->firstName; ?></td>
						<td style="width:10%; padding: 15px 10px; "><?php echo $tutor->country; ?></td>
						<td style="width:20%; padding: 15px 10px;"><?php echo $tutor->email; ?></td>
						<td style="width:15%; padding: 15px 10px; "><?php echo $affiliate_name; ?></td>
						<td style="width:15%; padding: 15px 10px; text-align:center" ><?php echo $tutor->total_session; ?></td>
				</tr>
				<?php } ?>
				</table>
				</div>
				</div>
				</div>
			</div>
			
			 <div style="width:100%; float:left;  border-bottom: 3px dotted #D3D3D3; ">
				<div style="width:85%; float:left" class="hd">
					<div class="content"><h2 style=" border-bottom: 0px dotted #D3D3D3; font-size:22px;"><span style="color:#E8B800">Student List</span> <a href="#" class="export_student">[Export]</a> </h2></div>

				</div>
					
				
				<div style="height:52px;">
					<a href="#" class="show_hide_student"  style="float:right; font-size:28px;"><span id="plus_student" style="padding-top: 15px; font-size:25px;" class="glyphicon glyphicon-triangle-bottom"></span></a>
				</div>
			</div>
			
			<div class="slidingDiv_student" style="width:100%; float:left; padding-bottom: 50px;">
				<div id="table-wrapper_student">
				<div id="table-scroll_student">
				<div id="dvData_student" >
				<table style="width:100%; font-size:16px;">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:7%;"><span style="width:7%; padding: 15px 10px;" class="text">ID</span></td>
					<td style="width:13%;"><span style="width:14%; padding: 15px 10px;" class="text">Name</span></td>
					<td style="width:10%;"><span style="width:11%; padding: 15px 10px;" class="text">Country</span></td>
					<td style="width:25%;"><span style="width:30%; padding: 15px 10px;" class="text2">Email</span></td>
					<td style="width:15%;"><span style="width:20%; padding: 15px 10px;" class="text2">Affiliate Name</span></td>					
					<td style="width:15%;"> <span style="width:15%; padding: 15px 10px; text-align:center" class="text1">Total Sessions</span></td>
					<td style="width:15%;"><span style="width:15%; padding: 15px 10px; text-align:center" class="text1">Credit Balance</span></td>
				</tr>
				<?php
					if(empty($students)){ ?>
						<tr style="width:100%; font-size:16px;">	
							<td colspan="7" style="width:100%; padding: 15px 10px; text-align:center;">No Student members registered yet.</td>
						</tr>
			<?php 	}else { ?>
				
				<?php foreach($students as $student){ ?>
				<tr style="padding:15px 10px;">					
						<td style="width:7%; padding: 15px 10px;"><?php echo $student->uid; ?></td>
						<td style="width:13%; padding: 15px 10px;"><?php echo $student->firstName; ?></td>
						<td style="width:10%; padding: 15px 10px;"><?php echo $student->country; ?></td>
						<td style="width:25%; padding: 15px 10px;"><?php echo $student->email; ?></td>
						<td style="width:15%; padding: 15px 10px;"><?php echo $affiliate_name; ?></td>
						<td style="width:15%; padding: 15px 10px; text-align:center"><?php echo $student->total_session; ?></td>
						<td style="width:15%; padding: 15px 10px; text-align:center"><?php echo $student->money; ?></td>

				</tr>
			<?php } }?>
				</table>
				</div>
				</div>
				</div>
			</div>
</div>
		
		

</body>
<script>
$(document).ready(function(){

   // $(".slidingDiv").hide();
   $(".show_hide").show();

   $('.show_hide').toggle(function(){
	   $("#plus").removeClass("glyphicon-triangle-bottom");
		$("#plus").addClass("glyphicon-triangle-top");
       $(".slidingDiv").slideUp();
	   
   },function(){
       //$("#plus").text("-");
	   $("#plus").removeClass("glyphicon-triangle-top");
		$("#plus").addClass("glyphicon-triangle-bottom");
       $(".slidingDiv").slideDown();
       
   });
    
});

$(document).ready(function(){

  // $(".slidingDiv_tutor").hide();
   $(".show_hide_tutor").show();

   $('.show_hide_tutor').toggle(function(){
       $("#plus_tutor").removeClass("glyphicon-triangle-bottom");
	   $("#plus_tutor").addClass("glyphicon-triangle-top");
       $(".slidingDiv_tutor").slideUp();
       
   },function(){
	   $("#plus_tutor").removeClass("glyphicon-triangle-top");
	   $("#plus_tutor").addClass("glyphicon-triangle-bottom");
      // $("#plus_tutor").text("+");
       $(".slidingDiv_tutor").slideDown();
   });
    
});

$(document).ready(function(){

  // $(".slidingDiv_student").hide();
   $(".show_hide_student").show();

   $('.show_hide_student').toggle(function(){
       $("#plus_student").removeClass("glyphicon-triangle-bottom");
	   $("#plus_student").addClass("glyphicon-triangle-top");   
       $(".slidingDiv_student").slideUp();
       
   },function(){
       $("#plus_student").removeClass("glyphicon-triangle-top");
	    $("#plus_student").addClass("glyphicon-triangle-bottom"); 
       $(".slidingDiv_student").slideDown();
   });
    
});

</script>

<script>
 $(document).ready(function(){
        $('.checked_box').click(function(){
            if($(this).prop("checked") == true){
                var id = $(this).attr('id');
					$.ajax({
						url: "<?php echo base_url('user/approve_tutor/'); ?>",
						data: { id: id},
						dataType: "html",
						type: "POST",
						success: function(data) {
	
							alert(data);
						}
				});
            }
            else if($(this).prop("checked") == false){
				var id = $(this).attr('id');
				var id = $(this).attr('id');
					$.ajax({
						url: "<?php echo base_url('user/decline_tutor/'); ?>",
						data: { id: id},
						dataType: "html",
						type: "POST",
						success: function(data) {
							alert(data);
						}
				});
            }
        });
    });

</script>