<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'testdb';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die('Connection to DB failed: ' . $conn->connect_error);
}
