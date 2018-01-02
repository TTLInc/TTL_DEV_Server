<html>
<head>
<style>
.wrapper{
	width:1065px;
}
.header {
	border-bottom:0px !important;
}
.content p{
	margin-top:0px;
	margin-bottom:0px;
	line-height:normal;
	color: #3399cc;
    border-bottom: 3px solid #E8B800;
    font-weight: 300;
    padding: 0 0 8px;
	
}
.modal-dialog{
	top:23% !important;
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
.select2-container--default {
	font-size:14px !important;
}
.select2-results__option{
	font-size:14px !important;  
}
.pagination{
	font-size:14px;
}

.select2-results__message{
	display:none !important;
}
.header .top_navi .navi_col ul li ul{
	top:85px;
}
.header .inner-navi .navi_col2 a.top_link2{
	font-weight:normal;
}
</style>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">  -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script > 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

 <!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script > 
<!--
 <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
 <script src="http://autocompletejs.com/releases/0.3.0/autocomplete-0.3.0.min.js"></script>
<script src="http://demo.expertphp.in/js/jquery.js"></script>
<script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script> 

<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script> -->
 <style>
 

        .tt-hint,
        .city {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

        .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
    <script>
        $(document).ready(function() {
		
            $('input.city').typeahead({
                name: 'city',
                remote: '<?php echo base_url('user/autocomplete_affiliate/'); ?>'

            });

        })
    </script>
		
</head>
<!--

<body>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script>
$(document).ready(function() {
    $(function(){
        $( "#filter" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                url: "<?php echo base_url('user/autocomplete_affiliate/'); ?>",
                data: { term: $("#filter").val()},
                dataType: "json",
                type: "POST",
                success: function(data){
					alert(data);
					return false;
                    response(data);
                }
            });
        },
        minLength: 2
        });
    });
});
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="filter">
</div>
  
 
</body>
</html> -->
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
        var args = [$('#dvData>table'), 'links.csv'];
        
        exportTableToCSV.apply(this, args);
        
        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
	
});
</script>
		<div style="width:1086px; margin:0 auto;" >
			<div style="width:100%" class="hd">
			   <div class="content"><p style=" font-weight:300; font-size:32px; padding-bottom:15px;">Affiliate Promotion Links</p></div>
			</div>
			  
	
			<div style="width:100%; float:left;  border-bottom: 3px dotted #D3D3D3; margin-bottom:20px;">
				<div style="width:85%; float:left" class="hd">
					<div class="content"><p style=" border-bottom: 0px dotted #D3D3D3; font-size:22px;"><span style="color:#E8B800">Links</span> <a href="#" class="export">[Export]</a> </p></div>

				</div>
					
				<div style="height:52px;">
					<a href="#" style="float:right;"><button type="button" data-toggle="modal" data-target="#myModal" style="border:none; font-size:13px; margin-top:5px; padding:7px 12px; border-radius:5px; color: #fff; background-color:#ff9933 ;">Generate Links</button></a>
				</div>
			</div>

			<div style="width:100%; float:left; padding-bottom: 50px;">
				<table style="width:100%; ">
				<tr style="width:100%; background-color:#D3D3D3; font-size:15px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%; padding: 15px 10px;">Date</td>
					<td style="width:5%; padding: 15px 10px;">ID</td>
					<td style="width:22%; padding: 15px 10px;">URL Link</td>
					<td style="width:15%; padding: 15px 10px;">Affiliate Name</td>
					<td style="width:10%; padding: 15px 10px; text-align:center">Affiliate ID</td>
					<td style="width:15%; padding: 15px 10px; text-align:center">Credit Value</td>				
					<td style="width:10%; padding: 15px 10px; text-align:center">Redeemed</td>
					<td style="width:10%; padding: 15px 10px; text-align:center">Cancelled</td>
				</tr>
			<!--	<div style="width:100%; font-size:16px;"> -->
			
			 <?php
					if(empty($arr)){ ?>
						<tr style="width:100%; font-size:16px;">	
							<td colspan="8" style="width:100%; padding: 15px 10px; text-align:center;">No promotion links generated yet.</td>
						</tr>
			<?php 	}else { ?>
				<?php foreach($arr as $res){ ?>
					<tr style="padding:15px 10px; font-size:14px;" class="record">	
					
						<td style="width:10%; padding: 10px 10px;"><?php echo $res->date; ?></td>
						<td style="width:5%; padding: 10px 10px;"><?php echo $res->id;?></td>
						<td style="width:22%; padding: 10px 10px;"><?php echo  base_url()."sc/".$res->code; ?></td>
						<td style="width:15%; padding: 10px 10px;"><?php echo $res->affiliate_name; ?></td>
						<td style="width:10%; padding: 10px 10px; text-align:center"><?php echo $res->affiliate_id; ?></td>
						<td style="width:15%; padding: 10px 10px; text-align:center"><?php echo $res->credit_value; ?></td>
						<td style="width:10%; padding: 10px 10px; text-align:center;"><?php echo $res->redeemed; ?></td>
						<td  style="width:10%; padding: 10px 10px; text-align:center;"><a href="<?php echo base_url() . "user/delete_link/" . $res->id; ?>">X</td>
					
				 	</tr> 
			<?php } }  ?>
				
				</table>
				<div id="dvData" style="display:none"> 
				<table style="width:100%; ">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%; padding: 15px 10px;">Date</td>
					<td style="width:5%; padding: 15px 10px;">ID</td>
					<td style="width:15%; padding: 15px 10px;">URL Link</td>
					<td style="width:15%; padding: 15px 10px;">Affiliate Name</td>
					<td style="width:10%; padding: 15px 10px;">Affiliate ID</td>
					<td style="width:20%; padding: 15px 10px;">Credit Value</td>				
					<td style="width:10%; padding: 15px 10px;">Redeemed</td>
				
				</tr>
			<!--	<div style="width:100%; font-size:16px;"> -->
				<?php foreach($arr_export as $res){ ?>
					<tr style="padding:15px 10px;">	
					
						<td style="width:10%; padding:5px"><?php echo $res->date; ?></td>
						<td style="width:5%; padding:5px"><?php echo $res->id;?></td>
						<td style="width:15%; padding:5px"><?php echo base_url()."sc/".$res->code; ?></td>
						<td style="width:15%; padding:5px"><?php echo $res->affiliate_name; ?></td>
						<td style="width:10%; padding:5px"><?php echo $res->affiliate_id; ?></td>
						<td style="width:20%; padding:5px;"><?php echo $res->credit_value; ?></td>
						<td style="width:10%; padding:5px; text-align:center;"><?php echo $res->redeemed; ?></td>
				 	</tr> 
				<?php } ?>
				
				</table>
				</div>
			</div>
				<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $links; ?>
				</div>
    </div>
	</div>
		
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Generate Promotion Links</h4>
        </div>
        <div class="modal-body">
		<form method="post" action="promotion_links">
			<table>
				<tr>
					<td style="padding:10px;">Enter number of links :</td>
					<td style="padding:10px;"><input type="text" name="number_links" style="height: 30px; width: 250px;" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>			
				</tr>
				<tr>
					<td style="padding:10px;">Enter value of links :</td>
					<td style="padding:10px;"><input type="text" name="value_links" style="height: 30px; width: 250px;" id="text1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>			
				</tr>
				<tr>
					<td style="padding:10px;">Select Affiliate :</td>
					<td style="padding:10px;"><!-- <input type="text" name="affiliate" class="searching" id="search_id'>
					<!--	<select class = "itemName form-control" style="width:500px" name="itemName"></select> -->
				<select style="width:250px" class = "itemName" name="affiliate" >	</select > 
				<!-- <input id="autocomplete-cities" type="text" style="height: 30px; width: 250px;" name="affiliate" /> 
<input type="text" name="city" size="30" id="names" class="city" placeholder="Please Enter City or ZIP code">				 
	<!-- <div id="suggesstion-box"></div>  -->
				
					<!-- Dropdown List Option <input type="text" id="filter">-->
			
			</td>			
				</tr>
				 
			</div>
			
				 
			</table>
		
        </div>
		<div class="modal-footer">
			<button type="Submit" class="btn btn-default" style="background-color:#3399cc;  color:#fff">Generate</button>
            <button type="button" class="btn btn-default" style="background-color:#3399cc; color:#fff" data-dismiss="modal">Cancel</button>
		</div>
         </form>
      </div>
      
    </div>

  
</div>

	
	<script>
   $('.itemName').select2({
        placeholder: '--- Select Affiliate ---',
        ajax: {
          url: '<?php echo base_url('user/autocomplete_affiliate/'); ?>',
          dataType: 'json',
          delay: 250,
          processResults: function (data,page) {
			  var select2data = $.map(data, function(obj) {
				 
            obj.id = obj.uid;

           // obj.text = obj.text + '-' + obj.uid;
		   
		   if(obj.text != ''){
				obj.text = obj.firstName + '-' + obj.text + '-' + obj.uid;
			}else{
				obj.text = obj.firstName + '-' + obj.uid;
			}
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
<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
	
    </script>
	<script>
	$( "#autocomplete-cities" ).autocomplete({
		source: function(request, response) {
			//console.info(request, 'request');
			//console.info(response, 'response');

			$.ajax({
				//q: request.term,
				url: "<?php echo base_url('user/autocomplete_affiliate/'); ?>",
				data: { term: $("#autocomplete-cities").val()},
				dataType: "json",
				type: "POST",
				success: function(data) {
					alert(data);
					//console.info(data);
					response(data);
				}
			});
		},
		minLength: 2
	});


	
	</script>
	<?php 
	if($this->session->flashdata('msg')){
		?>
		<script>
		<?php if($this->session->flashdata('now') == ''){ ?>
		alert("<?php echo 'Your Credit Balance is 0. You do not have enough credits to issue these promotion links.'; ?>");
		<?php } else {?>
		alert("<?php echo 'Your Credit Balance is '. $this->session->flashdata('now').'. You do not have enough credits to issue these promotion links.'; ?>");
		<?php }?>
		</script>
	<?php }
	
	?>
<!-- <script>
  $( "#filter" ).autocomplete({
        source: function(request, response) {
            $.ajax({
            url: "<?php echo base_url('user/autocomplete_affiliate/'); ?>",
            data: { term: $("#filter").val()},
            dataType: "json",
            type: "POST",
            success: function(data){
				alert(data);
				return false;
               var resp = $.map(data,function(obj){
                    return obj.tag;
               }); 

               response(resp);
            }
        });
    },
    minLength: 2
});
</script>  -->

	<!-- <script>
$(function() {
    $( "#skills" ).autocomplete({
        source: '<?php echo base_url('user/autocomplete_affiliate/'); ?>'
    });
});
</script>  -->

<!-- <script>
 $(document).ready(function() {

    var pageLoaded = 1; //this basically says that we are on page 1 of the results

      $(window).scroll(function()
       {

        if($(window).scrollTop() == $(document).height() - $(window).height())
        {
         pageLoaded = pageLoaded+1; //when this condition has met, increase the pageLoaded so that I can tell php to load in data for page 2/3/4/5, etc, etc

/*// below I send the data to the controller named Home its function loadData gets a variable named id_load with value = to pageLoaded*/

         $.get('<?php echo base_url('user/loadData/'); ?>', 
		 {'id_load':pageLoaded}, 
            function(data)
			
            {
				alert(data);
                if (data != "")
                {
                 $('#submissions').append(data);
                }
             }
         );
         //alert(pageLoaded);
        }
       }
      );


    });

</script>  -->

</body>
</html>