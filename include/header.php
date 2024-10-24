<?php 
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['user_id']) && $current_page != 'login.php' && $current_page != 'register.php') {
    header("Location: login.php");
    exit;
}
?>

<header class="headerimg">
</header>
    
<script>
function smileySelect(event) {
  /*
  event.target = the actually clicked element
  event.currentTarget = the element that has the event handler
  
  When they are not equal we know the click was on a child of the .emoji element.
  Any child is valid since you only have the emoticon span elements inside the .emoji element.
  */
  if (event.target != event.currentTarget) {
    let smiley = event.target;
    document.querySelector('#text').value += smiley.textContent;
  }
};
</script>

<nav class="topnav">
       
<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="register.php">Register</a>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="login.php">Login</a>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
 <a href="index.php">Home</a>
<?php }else{ ?>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
 <a href="about.php">About</a>
<?php }else{ ?>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
 <a href="user.php">User</a>
<?php }else{ ?>
<?php } ?>
    
<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
 <a href="members.php">Members</a>
<?php }else{ ?>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
 <a href="javascript:openNav()">Chat</a>
<?php }else{ ?>
<?php } ?>
</nav>

<br>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
{
?><nav class="topbar">  Logged in as, <?php echo $_SESSION["username"];
?>
      <a href="logout.php">Logout</a></nav>
<?php }else{ ?>
  
<?php } ?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

<?php

$con = new PDO('mysql:dbname=userdb;host=localhost', 'root', '');

// Benutzerinformationen abrufen
$stmt = $con->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Aktivität des Benutzers aktualisieren
$stmt = $con->prepare("UPDATE users SET last_activity = NOW() WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);

?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<center>
    Welcome to Chat, <?php echo $_SESSION["username"]; ?></center>
    <div id="chat-box" style="border: 0px solid #000; scrollbar-width: none; height: 80vh; overflow-y: scroll;">
       
    </div>
<center>
    <form id="chat-form">
        <input id="message" placeholder="Enter Message..." required rows="1" cols="30" autocomplete="off"></input>
        <button type="submit">Send</button>
    </form>


<?php
// Zeitrahmen für "online" (z.B. 5 Minuten)
$time_limit = date('Y-m-d H:i:s', strtotime('-5 minutes'));

$stmt = $con->prepare("SELECT COUNT(*) AS online_users FROM users WHERE last_activity > ?");
$stmt->execute([$time_limit]);
$online_users = $stmt->fetchColumn();
?>

<p><img src="imgs/online.png" width="10" height="10"> Online: <?php echo $online_users; ?></p>

</center>
    <script>
        
        function loadMessages() {
            $.ajax({
                url: 'load_messages.php',
                method: 'GET',
                success: function(data) {
                    $('#chat-box').html(data);
                }
            });
        }
        loadMessages();
        setInterval(loadMessages, 3000);

     
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message').val();
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: {message: message},
                success: function() {
                    $('#message').val('');  // Textarea leeren
                    loadMessages();  // Nachrichten neu laden
                }
            });
        });
    </script>

</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>

