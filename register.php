<?php
require("connection.php");

if (isset($_POST["submit"])) {
    // Entferne var_dump($_POST); um die Ausgabe zu vermeiden
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Kleinbuchstaben

    // Überprüfen, ob der Benutzer oder die E-Mail bereits existiert
    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    // Wenn ein Benutzer existiert, wird die Zeile als true gewertet
    if ($stmt->rowCount() === 0) {
        // Registrieren
        registerUser($username, $email, $password);
    } else {
        // Benutzer existiert bereits, gib eine Fehlermeldung aus
        $error_message = "Username or E-Mail already existing.";
    }
}

function registerUser($username, $email, $password) {
    global $con;
    $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    header("Location: register_complete.php");
    exit(); // Wichtig: Beende das Skript hier
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

<?php require_once("include/header.php") ?>

<section><center>
    <form action="register.php" method="POST">
        <h1>Register</h1>
        <div class="inputs_container">
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off" required><br><br>
            <input type="email" placeholder="Email" name="email" autocomplete="off" required><br><br>
            <input type="password" minlength="6" placeholder="Passwort" name="password" autocomplete="off" required><br><br>
        </div>
        <button name="submit">Register</button>
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </form>
    <br>
</section></center>

<?php require_once("include/footer.php") ?>

</body>
</html>