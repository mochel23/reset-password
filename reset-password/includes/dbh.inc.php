<?php
$dBServername = "localhost";
$dBUsername = "mochel23_login";
$dBPassword = "Queen#2468";
$dBName = "mochel23_login_registration";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
