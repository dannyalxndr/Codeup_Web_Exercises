<?php 

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'daniel', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbc->query('SELECT * FROM national_parks ORDER BY id LIMIT 4');

// function for getting the offset value
function getOffset() {

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    return ($page - 1) * 4;
}

function getParks($dbc) {
	$page = getOffset();
	$stmt = $dbc->prepare('SELECT * FROM national_parks LIMIT :LIMIT OFFSET :OFFSET');

	$stmt->bindValue(':LIMIT', 4, PDO::PARAM_INT);
	$stmt->bindValue(':OFFSET', $page, PDO::PARAM_INT);
	$stmt->execute();
	$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $stmt;
}

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

$numPages = ceil($count / 4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;

//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

if(!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['date_established']) && !empty($_POST['area_in_acres']) && !empty($_POST['park_description'])) {
	
	$stmt = $dbc->prepare('INSERT INTO national_parks (name, location, date_established, 
		area_in_acres, park_description) 
		VALUES (:name, :location, :date_established, :area_in_acres, :park_description)');

	    $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
	    $stmt->bindValue(':location',  $_POST['location'],  PDO::PARAM_STR);
	    $stmt->bindValue(':date_established', $_POST['date_established'],  PDO::PARAM_STR);
	    $stmt->bindValue(':area_in_acres', $_POST['area_in_acres'],  PDO::PARAM_STR);
	    $stmt->bindValue(':park_description', $_POST['park_description'],  PDO::PARAM_STR);

	    $stmt->execute();
}

?>


<!DOCTYPE html>
<html>
<head>
 	<title>National Parks</title>
 	<link rel="stylesheet" href="/css/bootstrap.min.css">

 	<style>

 	body {
	 	background-color: #F9DAA7;
	 	padding-top: 40px;
 	}
 	.jumbotron {
 		height: 250px;
 	}
 	.navbar {
 		opacity:0.7;
 		height: 60px;
 	}
 	#bigContainer {
 		top: 130px;
		position: absolute;
		left: 70px;
		width: 90%;
		margin-bottom: 50px;
		opacity:1;
 	}
 	#pageTitle {
 		/*text-align: right;*/
 		position: absolute;
 		color: #ADB5C7;
 		font-size: 50px;
 		font-weight: bold;
 		top: -20px;
 		left: 900px;
 	}
 	#links {
 		text-align: center;
 	}
 	#addNationalParkTitle {
 		position: absolute;
 		color: #000;
 		top: -48px;
 		left: 1px;
 	}
 	#parkInputForm {
 		width: 80%;
 		left: 300px;
 		top: -130px;
 		padding-top: 10px;
 		padding-bottom: 6px;
 		margin-left: 15px;
 		clear: top;
 	}
 	#park_description {
 		width: 400px;
 		height: 180px;
 	}
 	#submitBtn {
 		position: absolute;
 		left: 570px;
 		top: 178px;
 	}
 	#parkDescriptionWithLabel {
 		position: absolute;
 		left: 160px;
 		top: 9px;
 	}
	table {
 		border: 1px #9DB0A1;
 		margin-top: 10px;
 		background-color: #fff;
 		opacity:0.7;
 		width: 100%;
 		float: left;
 	}
 	th {
 		color: #000;
 		font-size: 15px;
 	}
 	td {
 		font-size: 14px;
 		color: #000;
 	}
 	a {
 		font-size: 25px;
 	}

 	</style>
</head>
<body>

<!--        ------------------------------------------------------------       -->


 	<div id="bigContainer">
 		<div id="parkInputForm">
 	 		<h3 id="addNationalParkTitle">Add New National Park</h3>
			<div class="row">
				<form method="POST" action="/national_parks.php">
		            <fieldset>
		            	<label for="name">Name</label><br>
		                <input type="text" id="name" name="name" class="input-block-level" placeholder="Name"><br>
		                <label for="location">Location</label><br>
		                <input type="text" id="location" name="location" class="input-block-level" placeholder="State"><br>
		                <label for="date_established">Date Established</label><br>
		                <input type="text" id="date_established" name="date_established" class="input-block-level" placeholder="Date Established"><br>
		                <label for="area_in_acres">Area Of Park</label><br>
		                <input type="text" id="area_in_acres" name="area_in_acres" class="input-block-level" placeholder="Area"><br>
		               	<div id="parkDescriptionWithLabel">
			                <label for="park_description">Park Description</label><br>
			                <textarea id="park_description" name="park_description" class="input-block-level" placeholder="Description"></textarea><br>	                
		               	</div>
		                
		                <button type="submit" id="submitBtn" class="btn btn-warning pull-right">Submit</button>
		            </fieldset>
		        </form>
			</div>
		</div>

<!--        ------------------------------------------------------------       -->

		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
						<p>One fine body…</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<!--        ------------------------------------------------------------       -->

		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container">
				<h2 id="pageTitle">National Parks</h2>
			</div>
		</nav>
			<!-- <div class="jumbotron">


			</div> -->

<!--        ------------------------------------------------------------       -->

	 	<table class="table table-hover" border="1px solid black">
	 		<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Location</th>
				<th>Date Established</th>
				<th>Area In Acres</th>
				<th>Park Description</th>
			</tr>
		    <? foreach (getParks($dbc) as $key => $parks) : ?>
            <tr>
                <? foreach ($parks as $park): ?>
                    <td><?= htmlspecialchars(strip_tags($park)); ?></td>
                <? endforeach; ?>
            </tr>
            <? endforeach; ?>
		</table> 

<!--        ------------------------------------------------------------       -->

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

	<script src="/js/jquery.js"></script>

</body>
</html>







