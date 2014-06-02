<?php

$address_book = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];

$filename = "address_book.csv";

function write_csv($bigArray, $filename) 
{
    if (is_writable($filename)) 
    {
        $handle = fopen($filename, 'w');
        foreach ($bigArray as $fields) 
        {
        	fputcsv($handle, $fields);
        }       
        fclose($handle); 
    }   
}

write_csv($address_book, $filename);

if (!empty($_POST)) 
{
    write_csv($address_book, $filename);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Address Book Entries</title>
</head>
<body>
	<h2>Address Book</h2>
	<h3>Add Your Information: </h3>
	<form method="POST" action="/address_book.php">

	        <label for="name">Name</label>
	        <input id="name" name="name" type="text" placeholder="Enter Your Name">
	        <label for="address">Address</label>
	        <input id="address" name="address" type="text" placeholder="Enter Your Address">
	        <label for="city">City</label>
	        <input id="city" name="city" type="text" placeholder="Enter Your City">
	        <label for="state">State</label>
	        <input id="state" name="state" type="text" placeholder="Enter Your State">
	        <label for="zip">Zip</label>
	        <input id="zip" name="zip" type="text" placeholder="Enter Your Zip">
	        <label for="phone">Phone</label>
	        <input id="phone" name="phone" type="text" placeholder="Enter Your Phone">
	        <input type="submit" value="Submit">
	</form>

	<h3>List of Information: </h3>
	<table>

		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Phone</th>
		</tr>

	<? if (!empty($_POST)) : ?>
	    <? if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) : ?>
	    <tr>
	        <? foreach ($_POST as $key => $value) :?>
	            <td><?= $value ?></td>
	        <? endforeach; ?>
	    <? else : ?>
	        <?="Please don't leave fields empty"?>
	    <? endif; ?>
	<? endif; ?>
		</tr>
	</table>

</body>
</html>

	




