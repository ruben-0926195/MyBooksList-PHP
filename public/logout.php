<?php require_once "../templates/header.php" ?>

<?php 

if (!isset($_SESSION['user_id'])) {
    header('Location:' . siteURL() . '/login');
    exit();
}

session_destroy(); 
header('Location: ' . siteURL() . '/login');

?>