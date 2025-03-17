<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != 1)
    header("Location: index.php");
