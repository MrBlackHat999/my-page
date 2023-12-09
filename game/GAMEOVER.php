<?php session_start(); ?>
<!DOCTYPE html>
<html>
<img src='2019-08-05_29.png'/>
<?php
@session_start();
session_destroy();
header("refresh:5; url=game.php")
?>
</html>