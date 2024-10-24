<?php
  require("connection.php");

  if(isset($_POST["submit"])){
    var_dump($_POST);

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $userAlreadyExists = $stmt->fetchColumn();

        if(!$userAlreadyExists){
      //Registrieren
      registerUser($username, $email, $password);
    }
    else{
      //User existiert bereits
    }
  }

  function registerUser($username, $email, $password){
    global $con;
    $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    header("Location: index.php");
  }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
    <meta http-equiv="refresh" content="4; url=index.php" />
</head>
<body>

<?php  require_once("include/header.php") ?>
    
	<section><center>
 
<font color="green">Logged Out!</font><br>
Redirecting...
    </section></center>




<?php  require_once("include/footer.php") ?>

</body>
</html>