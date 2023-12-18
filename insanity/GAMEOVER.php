<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="visaulity/DayGame.css">
</head>
<html id="UDeadLol">
<?php
@session_start();
session_destroy();
header("refresh:5; url=DayGame.php")
?>
</html>