<header class="headerimg">

<?php session_start();
echo $_SESSION["username"];
?><br><a href="logout.php">Logout</a>

    </header>
    
    <nav class="topnav">
       <a href="register.php">Register</a>
       <a href="login.php">Login</a>
       <a href="index.php">Home</a>
       <a href="about.php">About</a>
       <a href="user.php">User</a>
       <a href="members.php">Members</a>
       <a href="community.php">Community</a>
       <a href="contact.php">Contact</a>
       <a href="javascript:openNav()">Chat</a>

    </nav>

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

