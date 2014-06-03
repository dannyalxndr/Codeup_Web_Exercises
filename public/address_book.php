<?php

$address_book = [];
$new_address = [];
$filename = "address_book.csv";

// creating the class with funcitons and attributes inside
class AddressDataStore 
{
    public $filename = '';

    public function read_address_book()
    {
        // Code to read file $this->filename
        $entries = [];
		$handle = fopen($this->filename, 'r');
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

    public function write_address_book($array) 
    {
        // Code to write $addresses_array to file $this->filename
        if (is_writable($this->filename)) 
	    {
	        $handle = fopen($this->filename, "w");
	        foreach ($array as $fields) 
	        {
	            fputcsv($handle, $fields);
	        }
	        fclose($handle);
	    }
    }

}

// $address_book = read_csv($filename);
$addStore = new AddressDataStore();
$addStore->filename = 'address_book.csv';
$address_book = $addStore->read_address_book();

// this removes a selected item
if(isset($_GET['remove_item'])) 
{
	unset($address_book[$_GET['remove_item']]);
	$ads1 = new AddressDataStore();
	$ads1->filename = "address_book.csv";
	$ads1->write_address_book($address_book);
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
    
    $ads2 = new AddressDataStore();
	$ads2->filename = "address_book.csv";
	$ads2->write_address_book($address_book);    
} 
else 
{
    foreach ($_POST as $key => $value) 
    {
        if (empty($value)) 
        {
        	array_push($address_book, $new_address);
		    $ads3 = new AddressDataStore();
			$ads3->filename = "address_book.csv";
			$ads3->write_address_book($address_book); 
            echo "<h3>" . ucfirst($key) .  " is empty.</h3>";
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

