<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Nicht angemeldet!";
    exit;
}

$con = new PDO('mysql:dbname=userdb;host=localhost', 'root', '');

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $stmt = $con->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->execute([$user_id, $message]);
}
?>