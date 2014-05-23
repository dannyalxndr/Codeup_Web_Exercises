<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<title>FORM!</title>
</head>
<body>
	<?php
    	var_dump($_GET);
        var_dump($_POST);
    ?>
    <h3>User Login</h3>
	    <form method="POST">
		  
		        <label for="username">Username: </label>
		        <input id="username" name="username" type="text" placeholder="Username">
		    
		        <label for="password">Password: </label>
		        <input id="password" name="password" type="password" placeholder="Password">
		   
	        	<button type="submit" name="Log In">Log In</button>
		</form>
		<hr>
		<hr>
	<h3>Compose an Email</h3>
		<form meathod="POST">
		
				<label for="to">To: </label>
				<input id="to" name="to" type="email" placeholder="Recipient">
			
				<label for="from">From: </label>
				<input id="from" name="from" type="email" placeholder="Sender">
			
				<label for="subject">Subject: </label>
				<input id="subject" name="subject" type="text" placeholder="Subject">
			
				<button type="submit" name="Save">Save Draft</button>
		
				<textarea id="email_body" name="email_body" rows="10" cols="120"></textarea>
				<br>
				<button type="submit" name="Send">Send</button>
				<br>	
		</form>
		<hr>
	<h3>Multiple Choice Test</h3>
		<form method="POST">
		
				Can you read?<br>
				<input type="radio" name="q1" id="yes1" value="yes">
				<label for="yes1">Yes</label><br>

				<input type="radio" name="q1" id="no" value="no">
				<label for="no">No</label><br>
		
				Do you like Codeup?<br>
				<input type="radio" name="q2" id="yes2" value="yes" checked>
				<label for="yes2">Yes</label><br>
			
				What kind of food do you like?<br>
				<input type="checkbox" name="q3[]" id="Italian">
				<label for="Italian">Italian</label><br>

				<input type="checkbox" name="q3[]" id="Mexican">
				<label for="Mexican">Mexican</label><br>

				<input type="checkbox" name="q3[]" id="German">
				<label for="German">German</label><br>

				<input type="checkbox" name="q3[]" id="Chinese">
				<label for="Chinese">Chinese</label><br>

				<input type="checkbox" name="q3[]" id="Country">
				<label for="Country">Country</label><br>
				What bands do you like?<br>
				<select id="bands" name="bands[]" multiple>
				    <option value="beatles">Beatles</option>
				    <option value="pink_floyd">Pink Floyd</option>
				    <option value="rush">Rush</option>
				</select><br>
			<button type="submit" name="answer">Send</button>	
		</form>
		<form>
			Select Testing
			<label for="swim">Can you swim?</label>
			<select id="swim" name="swim">
    			<option value="1"selected>Yes</option>
    			<option value="0">No</option>
			</select>
			<br>
		<button type="submit" name="answer">Send</button>
		</form>
</body>
</html>













