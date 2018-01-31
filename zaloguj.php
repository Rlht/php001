<?php
    require_once 'dbh.php';
    // @ wycisza kontrole b³êdów
    $dbh = @new mysqli($host, $db_user, $db_password, $db_name);
    // connect_errno = atrybut wartosc 0 jestli proba dolaczenia sie powiedzie
    if ($dbh->connect_errno != 0) {
        echo " ERROR: ".$dbh->connect_errno ;
    }
    else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    // zapytanie z mySQL
    $sql = "SELECT * FROM uzytkownicy WHERE user='login' AND pass='haslo'";
    
    if ($rezultat = @$dbh->query($sql)) {
        $ilu_userow = $rezultat->num_rows;
    }
    echo "ITs work!";
    
    $dbh->close();
    }
?>