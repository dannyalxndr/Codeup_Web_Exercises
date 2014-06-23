<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'daniel', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4');

function getOffset() {

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    return ($page - 1) * 4;
}

$query = 'SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset(); 
$parks = $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

$numPages = ceil($count / 4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;

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
		<? foreach ($parks as $park) : ?> 
		    <tr>
		    	<td><?= $park['id'] ?></td>
		        <td><?= $park['name'] ?></td>
		        <td><?= $park['location'] ?></td>
		        <td><?= $park['date_established'] ?></td>
		        <td><?= $park['area_in_acres'] ?></td>
		    </tr>
		<? endforeach; ?>
		</table>

	<ul class="pager">
		<?php if ($page == 1): ?>
			<li class="previous disabled">
				<a href="">&larr; Previous</a>
			</li>
		<? else: ?>
			<li class="previous">
				<a href="?page=<?= $prevPage; ?>">&larr; Previous</a>
			</li>
		<?php endif ?>

		<li class="next">
			<a href="?page=<?= $nextPage; ?>">Next &rarr;</a>
		</li>		
	</ul>

	</div>
 </body>
 </html>