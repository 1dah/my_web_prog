<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <meta name="description" content="test">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">

</head>
<body>
<?php
$con = new PDO('mysql:dbname=userdb;host=localhost', 'root', '');
$stmt = $con->prepare("SELECT id, username, email, last_activity, IF(last_activity > ?, 'online', 'offline') AS status FROM users");
$time_limit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
$stmt->execute([$time_limit]);
$users = $stmt->fetchAll();
?>

<?php  require_once("include/header.php") ?>
    
	<section><center>
    <h1>Members</h1>

    <table border="0" cellpadding="10">
        <thead>
            <tr>
                <th>Username</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>
                    <span style="color: <?php echo $user['status'] === 'online' ? 'green' : 'red'; ?>">
                        <?php echo ucfirst($user['status']); ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br>
    </section>

<?php  require_once("include/footer.php") ?>

</body>
</html>