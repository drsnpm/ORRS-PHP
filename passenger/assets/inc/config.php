
<?php
$dbuser = "root";
$dbpass = ""; // Assuming no password is set
$host = "localhost";
$db = "orrsphp";
$port = 3307; // Added the port configuration
$mysqli = new mysqli($host, $dbuser, $dbpass, $db, $port);
?>