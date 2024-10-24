<?php
  require("connection.php");

  if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetchAll();
    var_dump($userExists);

    $passwordHashed = $userExists[0]["password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false){
      echo "Login failed.";
    }
    if($checkPassword === true){

      session_start();
      $_SESSION["username"] = $userExists[0]["username"];

      header("Location: index.php");
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

</head>
<body>

<?php  require_once("include/header.php") ?>
    
	<section><center>
 
  <form action="login.php" method="POST">
        <h1>Login</h1>
        <div class="inputs_container">
            <input type="text" placeholder="Username" name="username" autocomplete="off" required><br><br>
            <input type="password" minlength="6" placeholder="Password" name="password" autocomplete="off" required><br><br>
        </div>
        <button name="submit">Login</button>
    </form>
<br>
    </section></center>




<?php  require_once("include/footer.php") ?>

</body>
</html>