<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'daniel', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4');

function getParks() {

    // Bring the $dbc variable into scope somehow
    return $dbc->query('SELECT * FROM national_parks')->fetchAll(PDO::FETCH_ASSOC);

}

if ($_GET['page'] == '1') {
	// if($_GET['next']) {
	// 	$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4 OFFSET 8');
	// }
	$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4');
}
elseif ($_GET['page'] == '2') {
	$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4 OFFSET 4');
}
elseif ($_GET['page'] == '3') {
	$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4 OFFSET 8');
}

 ?>


<!DOCTYPE html>
 <html>
 <head>
 	<title>National Parks</title>
 	<link rel="stylesheet" href="/css/bootstrap.min.css">

 	<style>

 	body {
	 	background-color: #fff;
 	}
 	#container {
 		top: 200px;
		position: absolute;
		left: 150px;
		width: 80%;
		margin-bottom: 50px;
		opacity:1;
 	}
 	#pageTitle {
 		text-align: center;
 		color: #000;
 		font-size: 50px;
 		font-weight: bold;
 		top: 100px;
 	}
 	#links {
 		text-align: center;
 	}
	table {
 		border: 1px #000;
 		width: 90%;
 	}
 	th {
 		color: #000;
 		font-size: 22px;
 	}
 	td {
 		font-size: 20px;
 		color: #000;
 	}
 	a {
 		font-size: 25px;
 		color: #FF0000;
 	}

 	</style>
 </head>
 <body>
 	<h2 id="pageTitle">National Parks</h2>
 	<div id="container">
	 	<table class="table table-hover" border="1px solid black">
	 		<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Location</th>
				<th>Date Established</th>
				<th>Area In Acres</th>
			</tr>
		<? while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
		    <tr>
		    	<td><?= $row['id'] ?></td>
		        <td><?= $row['name'] ?></td>
		        <td><?= $row['location'] ?></td>
		        <td><?= $row['date_established'] ?></td>
		        <td><?= $row['area_in_acres'] ?></td>
		    </tr>
		<? endwhile; ?>
		</table>

		<div id="links">
			<a href='?page=1'>1</a>
			<a href='?page=2'>2</a>
			<a href='?page=3'>3</a> 
		</div>

	</div>
 </body>
 </html>