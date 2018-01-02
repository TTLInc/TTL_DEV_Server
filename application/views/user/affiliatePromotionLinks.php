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
.pagination{
	font-size:14px;
}
.header .inner-navi .navi_col2 a.top_link2{
	font-weight:normal;
}
</style>

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
			
			</div>

			<div style="width:100%; float:left; padding-bottom: 50px;">
				<table style="width:100%; ">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%; padding: 15px 10px;">Date</td>
					<td style="width:10%; padding: 15px 10px;">ID</td>
					<td style="width:30%; padding: 15px 10px;">URL Link</td>
					<td style="width:20%; padding: 15px 10px; text-align:center">Credit Value</td>				
					<td style="width:10%; padding: 15px 10px; text-align:center">Redeemed</td>
				</tr>
			<!--	<div style="width:100%; font-size:16px;"> -->
			
			<?php
					if(empty($arr_export)){ ?>
						<tr style="width:100%; font-size:16px;">	
							<td colspan="5" style="width:100%; padding: 15px 10px; text-align:center;">No promotion links generated yet.</td>
						</tr>
			<?php 	}else { ?>
					<?php foreach($arr_export as $k=>$res){ ?>
					<tr style="padding:15px 10px; font-size:16px;">	
					
						<td style="width:10%; padding: 15px 10px;"><?php echo $res->date; ?></td>
						<td style="width:10%; padding: 15px 10px;"><?php echo $res->id;?></td>
						<td style="width:30%; padding: 15px 10px;"><?php echo  base_url()."sc/".$res->code; ?></td>
						<td style="width:20%; padding: 15px 10px;; text-align:center;"><?php echo $res->credit_value; ?></td>
						<td style="width:10%; padding: 15px 10px;; text-align:center;"><?php echo $res->redeemed; ?></td>
				 	</tr> 
			<?php } }?>
		
				
				</table>
				<div id="dvData" style="display:none"> 
				<table style="width:100%; ">
				<tr style="width:100%; background-color:#D3D3D3; font-size:18px; color: #fff; height:52px; padding:15px 5px;">
					<td style="width:10%; padding: 15px 10px;">Date</td>
					<td style="width:10%; padding: 15px 10px;">ID</td>
					<td style="width:10%; padding: 15px 10px;">URL Link</td>
					<td style="width:20%; padding: 15px 10px;">Credit Value</td>				
					<td style="width:10%; padding: 15px 10px;">Redeemed</td>
				
				</tr>
			<!--	<div style="width:100%; font-size:16px;"> -->
				<?php foreach($arr_export as $k=>$res){ ?>
					<tr style="padding:15px 10px; font-size:18px;">	
					
						<td style="width:10%; padding: 15px 10px;"><?php echo $res->date; ?></td>
						<td style="width:10%; padding: 15px 10px;"><?php echo $res->id;?></td>
						<td style="width:30%; padding: 15px 10px;"><?php echo base_url()."sc/".$res->code; ?></td>
						<td style="width:20%; padding: 15px 10px;; text-align:center;"><?php echo $res->credit_value; ?></td>
						<td style="width:10%; padding: 15px 10px;; text-align:center;"><?php echo $res->redeemed; ?></td>
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