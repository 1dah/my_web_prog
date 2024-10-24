<?php
session_start();
session_unset();
header('location:logout_complete.php');
?>