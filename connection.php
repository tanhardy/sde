<?php
$servername = "sql101.byethost.com";
$username = "b9_22175232";
$password = "06197350";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
