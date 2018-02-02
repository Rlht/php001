<?php

    session_start();
    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
        header ('Location: index.php');
        exit();
    }
    
    require_once 'dbh.php';
    // @ wycisza kontrole b³êdów
    $dbh = @new mysqli($host, $db_user, $db_password, $db_name);
    // connect_errno = atrybut wartosc 0 jestli proba dolaczenia sie powiedzie
    if ($dbh->connect_errno != 0) 
    {
        echo " ERROR: ".$dbh->connect_errno ;
    }
    else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    //encje HTML zmienia kod < na &lt
    $login = htmlentities($login,ENT_QUOTES,"UTF-8");
    $haslo = htmlentities($haslo,ENT_QUOTES,"UTF-8");
    // zapytanie z mySQL
    $sql = sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
        my_sqli_real_escape_string($dbh,$login),
        my_sqli_real_escape_string($dbh,$haslo));
    // jesli zapytanie nie uda sie wykonac to false, literowka czy cos...
    if ($rezultat = @$dbh->query($sql)) 
    {
        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow>0)
        {
            $_SESSION['zalogowany']=true;
            
            //tablica ze skojarzeniem, pozwala przypisac indexy z tablicy g³ównej
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['id'] = $wiersz['id'];
            $_SESSION['user'] = $wiersz['user'];
            $_SESSION['drewno'] = $wiersz['drewno'];
            $_SESSION['kamien'] = $wiersz['kamien'];
            $_SESSION['zboze'] = $wiersz['zboze'];
            $_SESSION['email'] = $wiersz['email'];
            $_SESSION['dnipremium'] = $wiersz['dnipremium'];
            // usun blad z sesji, zeby nie bylo go
            unset($_SESSION['blad']);
            //pozbywanie siê z pamiêci rezultatów TO RZECZ ŒWIÊTA
            $rezultat->free();
            // przekierowanie
            header('Location: gra.php');
        } else {
            $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub haslo!</span>';
            header('Location: index.php');
        }
    }
    
    $dbh->close();
    }
?>