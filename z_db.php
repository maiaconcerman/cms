<?php
$con = new mysqli("localhost", "root", "", "sinag");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//Your Website URL Goes Here
$url="http://localhost/sinag";
