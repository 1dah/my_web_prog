<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

</head>
<body>

<?php  require_once("include/header.php") ?>

    <section>
	<center>

    <h1>Write E-Mail</h1>

    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea><br><br>
    <input type="submit" value="Send Mail">
	</section>

<?php  require_once("include/footer.php") ?>
	
</body>
</html>