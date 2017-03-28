<?php
session_start();
unset($_SESSION['rname']);
session_destroy();
header("Location:../index.php");
?>