<?php

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "acciaware";

$conn = new mysqli($server_name, $username, $password, $db_name);

$num_of_results_per_page = 5;

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}