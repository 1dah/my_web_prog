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
        <h1>Register</h1>

<form>  
<label> Username </label> <br>
<input type="text" name="username"> <br> <br>  

<label> Email </label><br>
<input type="email" id="email" name="email"/> <br> <br> 

<label> Password </label><br>
<input type="Password" id="pass" name="pass"> <br> <br>

<label>Re-type password </label><br>
<input type="Password" id="repass" name="repass"> <br> <br>
<input type="button" value="Register"/>  
</form>  
<br>
    </section></center>

<?php  require_once("include/footer.php") ?>

</body>
</html>