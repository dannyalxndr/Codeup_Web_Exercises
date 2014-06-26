<?php

// dbc: data base connection. this new object helps us to connect to the database
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'daniel', 'letmein');

// tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// this attribute tells me if i have an active connection to the database
// the PDO::ATTR_CONNECTION_STATUS ^^
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";