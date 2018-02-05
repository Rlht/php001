<?php
//sesia trwa
session_start(); 
if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) 
{
    //natychmiastwe przejscie, szkkoda mocy
    header ('Location: gra.php');
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
     if(isset($_SESSION['udanarejestracja']))
        {
            echo '<span style="color:red;">Konto utworzone, zapraszam do gry</span>';
            unset ($_SESSION['udanarejestracja']);
        };                  
?>
	<form action="zaloguj.php" method="post">
		Login:<br/> <input type="text" name="login" /> <br/>
		Haslo:<br/> <input type="password" name="haslo" /> <br/><br/>
		<input type="submit" value="Zaloguj sie" />
	</form>    
	<br/><a href="rejestracja.php">Zaloz konto juz teraz!</a><br/>
	<?php 
	
	if(isset($_SESSION['blad'])) {
	    echo $_SESSION['blad'];
	}
	?>
</body>
</html>