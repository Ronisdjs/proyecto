<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
    exit();
}
?>