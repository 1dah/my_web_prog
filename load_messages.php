<?php
session_start();
$con = new PDO('mysql:dbname=userdb;host=localhost', 'root', '');

// Nachrichten abrufen
$stmt = $con->prepare("SELECT messages.message, messages.timestamp, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.timestamp ASC");
$stmt->execute();
$messages = $stmt->fetchAll();

foreach ($messages as $message) {
    echo "<p>&nbsp;&nbsp;<strong>{$message['username']}</strong>: {$message['message']}</p>";
}
?>