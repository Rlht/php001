<?php 
session_start();
if(!isset($_SESSION['zalogowany']))
{
    header ('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Osadnicy</title>
</head>
<body>
	<?php 
	   echo "<p>Witaj ".$_SESSION['user']. "!</p>";
	   echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
	   echo " | <b>Kamien</b>: ".$_SESSION['kamien'];
	   echo " | <b>Zboze</b>: ".$_SESSION['zboze']."</p>";
	   echo "<p><b>E-mail</b>: ".$_SESSION['email'];
	   echo "<br/><b>Dni premium</b>:".$_SESSION['dnipremium']."</p>";
	   echo "<p><a href='logout.php'>[WYLOGUJ]</a></p>";
	?>
</body>
</html>