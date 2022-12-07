<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbname = 'login_db';
$dbpass = '';

$con = new mysqli(
    hostname:$dbhost,
    username: $dbuser,
    database:$dbname,
    password: $dbpass);

if($con->connect_errno){
    die("Connection error " . $con->connect_error);
}

return $con;