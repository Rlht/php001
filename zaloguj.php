<?php

    session_start();
    
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
    // zapytanie z mySQL
    $sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";
    // jesli zapytanie nie uda sie wykonac to false, literowka czy cos...
    if ($rezultat = @$dbh->query($sql)) 
    {
        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow>0)
        {
            //tablica ze skojarzeniem, pozwala przypisac indexy z tablicy g³ównej
            $wiersz = $rezultat->fetch_assoc();
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