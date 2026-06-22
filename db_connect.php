<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "engineering_college"
);

if($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

?>