<?php
header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache'); 
//echo $result[0]['last_toiec_score'].'<br/>'.$result[0]['current_tolec_score'].'<br/>'.$result[0]['last_toefl_score'].'<br/>'.$result[0]['current_toefl_score'].'<br/>'.$result[0]['last_oplc_score'].'<br/>'.$result[0]['current_oplc_score'];
echo $result[0]['last_toiec_score'].'<br/>'.$result[0]['current_tolec_score'].'<br/>'.$result[0]['last_toefl_score'].'<br/>'.$result[0]['current_toefl_score'];
	
//echo $result[0]['last_toiec_score'].'<br/>'. $result[0]['last_toefl_score'].'<br/>'. $result[0]['current_tolec_score'].'<br/>'. $result[0]['current_toefl_score'];
?>