<?php

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "acciaware";

$conn = mysqli_connect($server_name, $username, $password, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}