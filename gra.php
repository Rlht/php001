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
        echo "<br/><b>Data wygasniecia premium</b>:".$_SESSION['dnipremium']."</p>";
        echo "<p><a href='logout.php'>[WYLOGUJ]</a></p>";
        // '2018-02-20 19:30:15'
        $dataczas = new DateTime('2018-02-20 11:30:15');
        
        echo "<br>Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."</br>";
        
        $koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);
        $roznica = $dataczas->diff($koniec);
        
        if ($dataczas<$koniec)
            echo "Pozostalo premium: ".$roznica->format('%d dni, %h godz, %i min,');
        else 
            echo "Premium nieaktywne od: ".$roznica->format('%d dni, %h godz, %i min,');
	   
    ?>
</body>
</html>