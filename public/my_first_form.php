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
		    <p>
		        <label for="username">Username: </label>
		        <input id="username" name="username" type="text" placeholder="Username">
		    </p>
		    <p>
		        <label for="password">Password: </label>
		        <input id="password" name="password" type="password" placeholder="Password">
		    </p>
		    <p>
	        	<button type="submit" name="Log In">Log In</button>
		    </p>
		</form>

	<h3>Compose an Email</h3>
		<form meathod="POST">
			<p>
				<label for="to">To: </label>
				<input id="to" name="to" type="email" placeholder="Recipient">
			</p>
			<p>
				<label for="from">From: </label>
				<input id="from" name="from" type="email" placeholder="Sender">
			</p>
			<p>
				<label for="subject">Subject: </label>
				<input id="subject" name="subject" type="text" placeholder="Subject">
			</p>
			<hr>
			<p>
				<textarea id="email_body" name="email_body" rows="5" cols="120"></textarea>
				<br>
				<button type="submit" name="Send">Send</button>
			</p>
		</form>
</body>
</html>













