<?php

$is_invalid = false;
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $con=require __DIR__ . '/database.php';
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $con->real_escape_string( $_POST['email']));

    $result=$con->query($sql);
    $user=$result->fetch_assoc();

   // var_dump($user);
    if($user){
      if(password_verify($_POST["password"], $user["password_hash"])){

            session_start();

            $_SESSION["user_id"] = $user["id"];

            header("Location:index.php");

            exit;

      }
        $is_invalid = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <title>::Login to Umoja Magharibi</title>
</head>
<body>
    <h1 style="font-family: Nunita;">Login to <span style="color: royalblue ;"> Umoja Magharibi</span></h1>
  
    <?php if($is_invalid):?>
    <em>Invalid Login</em>
    <?php endif; ?>


    <form method="post">
        <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" >
        </div>
   
        <div>
            <label for="password">Password</label>
            <input type="password"name="password" id="password" >
        </div>
        <button>Login</button>
        <div>
            <p>Dont have an Account?  <a href="signup.html">Signup</a></p>
        </div>
    </form>
</body>
</html>