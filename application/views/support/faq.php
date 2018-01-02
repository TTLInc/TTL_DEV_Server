<?php $this->layout->appendFile('css',"css/terms.css");?>
<div class="terms">
	<div class="terms_top">FAQs</div>
	<div class="terms_top" style="float:right;">
	<form name="faqSearch" method="POST" action="search">
	<input type="text" name="search">
	<input type="submit" name="submit" value="Search">
	</form>
	</div>
	<br />
	<div class="terms_mid">
	<?php
	if($faqs){
		foreach($faqs as $faq){   ?>
		<h1><?php echo $faq['question']; ?></h1>
		<p><?php echo $faq['answer']; ?></p>
		<hr/>
		<?php } 
	
	}else{
		echo '<h1>No Records Found. </h1>';
	}

	?>
	</div>
</div>