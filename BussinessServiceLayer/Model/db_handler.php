<?php
// require_once('includes/config.php');

$conn = $conn = mysqli_connect("localhost:3307", "root", "", "rlms");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
