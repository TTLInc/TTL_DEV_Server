<?php include 'leftSide.php';?>
<div class="rightSide">
	<p>Edit Profile</p>
	<div>
		<form method="post" action="" id="regForm">
		<div class="formbox">
			<div>
				<label for="firstName" class="title">FirstName:</label>
				<input type="text" name="firstName" value="<?php echo $firstName ;?>" id="firstName" class=":required "/>
				<span class="message"></span>
			</div>
			<div>
				<label for="midName" class="title">Middle Name:</label>
				<input type="text" name="midName" value="<?php echo $midName ;?>" id="midName"  class=""/>
				<span class="message"></span>
			</div>
			<div>
				<label for="lastName" class="title">last Name:</label>
				<input type="text" name="lastName" value="<?php echo $lastName ;?>" id="lastName"  class=""/>
				<span class="message"></span>
			</div>
			<div>
				<label for="dateOfBirth" class="title">Date Of Birth Day:</label>
				<input type="text" name="dateOfBirth" value="<?php echo $dateOfBirth ;?>" id="dateOfBirth"  class=""/>
				<span class="message"></span>
			</div>
			<div>
				<label for="gender" class="title">Gender:</label>
				<select  name="gender"  id="gender" >
					<option value="0">Male</option>
					<option value="1">Female</option>
					<option value="2">Secret</option>
				</select>
				<span class="message"></span>
			</div>
			<div>
				<label for="country" class="title">Country:</label>
				<select  name="country"  id="country" >
					<option value="0">China</option>
					<option value="1">Usa</option>
				</select>
				<span class="message"></span>
			</div>
			<div>
				<label for="province" class="title">Province:</label>
				<select  name="province" id="province" >
					<option value="0">calif</option>
					<option value="1">was</option>
				</select>
				<span class="message"></span>
			</div>
			<div>
				<label for="city" class="title">City:</label>
				<select  name="city"  id="city" >
					<option value="0">cal</option>
					<option value="1">was</option>
				</select>
				<span class="message"></span>
			</div>
			<div>
				<label for="nativeLanguage" class="title">Native Language:</label>
				<input type="text" name="nativeLanguage" value="<?php echo $nativeLanguage ;?>" id="nativeLanguage"  class=""/>
				<span class="message"></span>
			</div>
			<div>
				<label for="otherLanguage" class="title">Other Language:</label>
				<input type="text" name="otherLanguage" value="<?php echo $otherLanguage ;?>" id="otherLanguage"  class=""/>
				<span class="message"></span>
			</div>
			<div>
				<label for="submit" class="title"></label>
				<input type="submit" value="confirm" name="submit" />
				<span class="message"></span>
			</div>
			
		</div>
		</form>
	</div>
</div>