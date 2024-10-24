<?php session_start();?>

<header class="headerimg">
</header>
    
<nav class="topnav">
       
<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="register.php">Register</a>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="login.php">Login</a>
<?php } ?>

<a href="index.php">Home</a>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="about.php">About</a>
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
<a href="community.php">Community</a>
<?php }else{ ?>
<?php } ?>

<?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) ){?>
<?php }else{ ?>
<a href="contact.php">Contact</a>
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
<center>Chat</center>
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

