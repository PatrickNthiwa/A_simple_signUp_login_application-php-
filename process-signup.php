<?php 
if(empty($_POST["name"])){
    die('Name is required');
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Email is required");
}
 if(strlen($_POST['password']>8)){
    die("Password is less than 8 characters long");
 }

if(!preg_match("/[a-z]/i",$_POST['password'])){
    die("Password must contain atleast one character");
}
if(!preg_match("/[0-9]/",$_POST['password'])){
    die("Password must contain  atleast one number");
}

if($_POST['password'] !== $_POST['confirmation_password']){
    die("passwords do not match");
}

$password_hash=password_hash($_POST['password'], PASSWORD_DEFAULT);

$con = require(__DIR__ . '/database.php');

$sql = 'INSERT INTO user (name,email,password_hash) VALUES(?,?,?)';

$stmt = $con->stmt_init();

if(!$stmt->prepare($sql)){
    die("Sql Error " . $con->error);
}

$stmt->bind_param(
    "sss",
    $_POST['name'],
    $_POST['email'],
    $password_hash
);

if($stmt->execute()){
    header('Location:signup-success.html');
    exit();
}else{

    if($con->errno === 1062){
        die("Email already Taken");
    }else{
        echo ($con->error . "". $con->errno);
    }
   
}
