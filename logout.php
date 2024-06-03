<?php
// Indítsd el a munkamenetet
session_start();

// Töröld a munkamenetbe lévő adatokat
$_SESSION = array();

// Szüntesd meg a munkamenetet
session_destroy();

// Irányítsd vissza az index.php-ra
header("location: index.php");
exit;
?>
