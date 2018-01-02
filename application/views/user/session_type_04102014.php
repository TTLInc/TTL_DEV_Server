<div id="dialog1" title="" style="display:None;">
			<div class="ratelist">
				<span class="title" style="float:left">This tutor is affiliated with the Language School Program and offers two types of sessions.</span>  
			</div>
			<div class="ratelist">
				<br><br><br><p><span class="title" style="float:left">Select session type to confirm.</span>  </p>
				<br><br><br>
				<input type="radio" name="amex" value="0" checked> Conversation - informal speaking practice : <?php echo ($SessionCost['tutorcost']);?> Credits<br><br>
				<input type="radio" name="amex" value="1">  Curriculum    - structured learning program  : <?php echo ($SessionCost['schooltutorcost']);?>  Credits
 				<p class="clearer"></p>
			</div>
			<p><input type="button" value="OK"  id="rateButton12" class="blu-btn"/>
			<input type="button" value="Cancel" onclick="closeFunc();" class="blu-btn"/>
			</p>
		</div>