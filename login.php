<?php
require_once("include/header.php");
require("connection.php");

$error_message = ""; // Variable für Fehlermeldungen

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetchAll();

    // Benutzer nicht gefunden
    if (!$userExists) {
        $error_message = "Login failed!";
    } else {
        $passwordHashed = $userExists[0]["password"];
        $checkPassword = password_verify($password, $passwordHashed);

        if ($checkPassword === false) {
            $error_message = "Login failed!";
        } else {
            // Setze die Benutzerdaten in die Session
            session_start();
            $_SESSION["user_id"] = $userExists[0]["id"]; // Die user_id wird hier in die Session gesetzt
            $_SESSION["username"] = $userExists[0]["username"];

            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
</head>
<body>

<?php require_once("include/header.php"); ?>

<section>
    <center>
        <form action="login.php" method="POST">
            <h1>Login</h1>
            <div class="inputs_container">
                <input type="text" placeholder="Username" name="username" autocomplete="off" required><br><br>
                <input type="password" minlength="6" placeholder="Password" name="password" autocomplete="off" required><br><br>
            </div>
            <button name="submit">Login</button>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
        </form>
    </center>
</section>

<?php require_once("include/footer.php"); ?>

</body>
</html>