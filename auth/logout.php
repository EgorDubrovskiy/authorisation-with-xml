<?php
session_start();
unset($_SESSION['UserLogin']);
unset($_SESSION['UserName']);
unset($_COOKIE['UserLogin']);
unset($_COOKIE['UserRememberToken']);

header("Location: ../index.php");

