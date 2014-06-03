<?php

$address_book = [];
$new_address = [];
$filename = "address_book.csv";

// Reading my CSV file
function read_csv($filename)
{
	$entries = [];
	$handle = fopen($filename, 'r');
	while(!feof($handle))
	{
		$row = fgetcsv($handle);
		if(is_array($row))
		{
			$entries[] = $row;
		}
	}
	fclose($handle);
	return $entries;
}

$address_book = read_csv($filename);

// Write CSV function
function write_csv($array, $filename) 
{
    if (is_writable($filename)) 
    {
        $handle = fopen($filename, "w");
        foreach ($array as $fields) 
        {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }
}

if(isset($_GET['remove_item'])) 
{

	unset($address_book[$_GET['remove_item']]);
	write_csv($address_book, $filename); 
	header('address_book.php');
}

// Error check
if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) 
{
    $new_address['name'] = $_POST['name'];
    $new_address['address'] = $_POST['address'];
    $new_address['city'] = $_POST['city'];
    $new_address['state'] = $_POST['state'];
    $new_address['zip'] = $_POST['zip'];
    $new_address['phone'] = $_POST['phone'];

    array_push($address_book, $new_address);
    
    write_csv($address_book, $filename);    
} 
else 
{
    foreach ($_POST as $key => $value) 
    {
        if (empty($value)) 
        {
        	array_push($address_book, $new_address);
		    write_csv($address_book, $filename); 
            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Address Book Entries</title>
</head>
<body>
	<h2>Your Address Book</h2>
	<h3>Input Information Here:</h3>
	<form method="POST" action="/address_book.php">

	        <label for="name">Name</label>
	        <input id="name" name="name" type="text" placeholder="Your Name">

	        <label for="address">Address</label>
	        <input id="address" name="address" type="text" placeholder="Your Address">

	        <label for="city">City</label>
	        <input id="city" name="city" type="text" placeholder="Your City">

	        <label for="state">State</label>
	        <input id="state" name="state" type="text" placeholder="Your State">

	        <label for="zip">Zip</label>
	        <input id="zip" name="zip" type="text" placeholder="Your Zip">

	        <label for="phone">Phone</label>
	        <input id="phone" name="phone" type="text" placeholder="Your phone">



	        <input type="submit" value="Submit">
	</form>
	<br>
	<table border="1">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Remove</th>
        </tr>
        <? foreach ($address_book as $key => $fields) : ?>
        <tr>
            <? foreach ($fields as $value): ?>
                <td><?= $value; ?></td>
            <? endforeach; ?>
            <td><a href="?remove_item=<?=$key?>">Remove Item</a></td>
        </tr>
        <? endforeach; ?>
    </table>
</body>
</html>

	




