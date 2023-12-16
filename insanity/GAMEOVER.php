<?php session_start(); ?>
<!DOCTYPE html>
<html>
<img src='images/2019-08-05_29.png'/>
<?php
@session_start();
session_destroy();
header("refresh:5; url=DayGame.php")
?>
</html>