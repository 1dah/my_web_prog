<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

</head>
<body>
<?php
require("connection.php");


$error_message = "";
$success_message = "";

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    
    // Benutzer aus der Datenbank abrufen
    $stmt = $con->prepare("SELECT password FROM users WHERE id=:id");
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Aktuelles Passwort überprüfen
    if ($user && password_verify($current_password, $user['password'])) {
        // Neues Passwort hashen
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Passwort in der Datenbank aktualisieren
        $update_stmt = $con->prepare("UPDATE users SET password=:password WHERE id=:id");
        $update_stmt->bindParam(":password", $new_password_hashed);
        $update_stmt->bindParam(":id", $user_id);
        
        if ($update_stmt->execute()) {
            $success_message = "Password updated successfully!";
        } else {
            $error_message = "Failed to update password.";
        }
    } else {
        $error_message = "Current password is incorrect.";
    }
}
?>

<?php  require_once("include/header.php") ?>
    
	<section>
    <center>
        <h1>Control Panel</h1>
        <form action="user.php" method="POST">
            <div class="inputs_container">
                <input type="password" placeholder="Current Password" name="current_password" required><br><br>
                <input type="password" placeholder="New Password" name="new_password" required><br><br>
            </div>
            <button name="submit">Change Password</button>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <p style="color:green;"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
        </form>
    </center>
<br>
</section>

<?php  require_once("include/footer.php") ?>

</body>
</html>