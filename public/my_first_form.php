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
</body>
</html>