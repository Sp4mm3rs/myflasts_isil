<?php
session_start();
if (!$_SESSION['uname']) {
    header("Location: login.php");
}
?>