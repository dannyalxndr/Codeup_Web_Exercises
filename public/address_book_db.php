<?

//address book class import
require_once('php/address_data_store_db.php');

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_book', 'daniel', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbFilestore = new filestoreDB();
$dbFilestore->getOffset();
$dbFilestore->getList($dbc);

if(!empty($_POST['firstName']) && !empty($_POST['lastName'])) {
    
    $stmt = $dbc->prepare('INSERT INTO names (first_name, last_name) VALUES (:first_name, :last_name)');

    $stmt->bindValue(':first_name', $_POST['firstName'], PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $_POST['lastName'], PDO::PARAM_STR);
    
    $stmt->execute();
}

if (!empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
	
	$stmt = $dbc->prepare('INSERT INTO addresses (address, city, state, zip) VALUES (:address, :city, :state, :zip)');
	$stmt->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
    $stmt->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
    $stmt->bindValue(':state', $_POST['state'], PDO::PARAM_STR);
    $stmt->bindValue(':zip', $_POST['zip'], PDO::PARAM_STR);
	
	$stmt->execute();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Address Book Writer</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/cssaddress_book_db_styling.css">
	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="/css/animate_02.css">

</head>
<body>
	<h3 id="mainTitle" class="animated fadeInLeft">Your Address Book.</h3>

	<!--'sticky' form-->
	<div id="container">
		<h2 id="newContactTitle" >New Contact</h2>
		<form id="addressInputForm" method="POST" action="address_book_db.php">
				<label for="firstName">First Name:</label>
				<input id="firstName" placeholder="First Name" type="text" name="firstName">

				<label for="lastName">Last Name:</label>
				<input id="lastName" placeholder="Last Name" type="text" name="lastName">

				<label for="address">Address:</label>
				<input id="address" placeholder="Your Address" type="text" name="address">

				<label for="city">City:</label>
				<input id="city" placeholder="City" type="text" name="city">

				<label for="state">State:</label>
				<input id="state" placeholder="State" type="text" name="state">

				<label for="zip">Zip:</label>
				<input id="zip" placeholder="Zip Code" type="text" name="zip">
			
			<input id="newContactSubmit" type='submit' value="Add Contact">
		</form>

	</div>

	<h3 class="animated " id="addressTableHeader">Address Book</h3>

	<!--here is our address book loop -->

		<table class="table table-hover" border="1px solid black">
			<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Address</th><th>City</th><th>State</th><th>Zip</th></tr>
            </tr>
            <? foreach ($dbFilestore->getList($dbc) as $key => $items) : ?>
                <tr>
                    <? foreach ($items as $item): ?>
                        <td><?= htmlspecialchars(strip_tags($item)); ?></td>
                    <? endforeach; ?>
                        <!-- <td><button class="btn btn-danger btn-sm pull-right btn-remove">Remove</button></td> -->
                </tr>
            <? endforeach; ?>
        </table>

</body>
</html>