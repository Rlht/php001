<?php 
    session_start();
    
    if(isset($_POST['email'])) 
    {
        //odnosnik walidacji
        $allgood = true;
        //nick
        $nick = $_POST['nick'];
        if (strlen($nick)<3 || (strlen($nick)>20))
        {
           $allgood = false;
           $_SESSION['e_nick'] = "Nick musi posiadac od 3 do 20 znakow";
        }
        if (ctype_alnum($nick)==false)
        {
            $allgood = false;
            $_SESSION['e_nick'] = "Nick musi skladac sie z liter i cyfr, bez polskich znakow";
        }
        //email dla typu email to tezz string lel ale akceptuje np. aa@aa
        $email = $_POST['email'];
        $emailb = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ((filter_var($emailb, FILTER_VALIDATE_EMAIL)==false) || ($emailb!=$email))
        {
            $allgood = false;
            $_SESSION['e_email'] = "Email nieprawidlowy";
            
        }
        //sprawdz poprawnosc hasla
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];
        if (strlen($haslo1) < 8 || (strlen($haslo1) > 20))
        {
            $allgood = false;
            $_SESSION['e_haslo'] = "haslo musi posiadac od 8 do 20 znakow";
        }
        if ($haslo1 != $haslo2)
        {
            $allgood = false;
            $_SESSION['e_haslo'] = "hasla sa niepoprawne";
        }
        
        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
        //regulamin
        if(!isset ($_POST['regulamin'])) {
            $_SESSION['e_regulamin'] = "potwierdz regulamin";    
        } 
        //bot or not?
        //$secret = "6LfE-EMUAAAAAMiSfw-1TMn7Uy6f2l0fGku2BJE-";
        //$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST[g-recaptcha-response]);
        //$odpowiedz = json_decode($sprawdz);
        //if ($odpowiedz->success==false)
        //{
         //   $_SESSION['e_bot'] = "Potwierdz ze nie jestes botem";
        //}
        
        require_once "dbh.php";
        //usuwa ostrze¿enie o wyrzucie
        mysqli_report(MYSQLI_REPORT_STRICT);
        try 
        {
            $dbh = new mysqli($host, $db_user, $db_password, $db_name);
            if ($dbh->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            } else {
                //czy email ju¿ istnieje?
                $rezultat=$dbh->query("SELECT id FROM uzytkownicy WHERE email='$email'");
                if (!$rezultat) throw new Exception($dbh->error);
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0)
                {
                    $allgood = false;
                    $_SESSION['e_email'] = "Istnieje juz konto na tym adresie email";
                }
                //czy nick ju¿ istnieje?
                $rezultat=$dbh->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
                if (!$rezultat) throw new Exception($dbh->error);
                $ile_takich_nickow = $rezultat->num_rows;
                if($ile_takich_nickow>0)
                {
                    $allgood = false;
                    $_SESSION['e_nick'] = "Istnieje juz konto na tym nicku";
                }
                if ($allgood)
                {
                    //zapytanie insert
                    if ($dbh->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, now() + INTERVAL 14 DAY)"))
                    {
                        $_SESSION['udanarejestracja'] = true;
                        header ('Location: index.php');
                    }
                    else
                    {
                        throw new Exception($dbh->error);
                    }
                }
                
                
                $dbh->close();
            }
        } catch(Exception $e) {
            echo '<span style="color:red;">Blad serwera! Przepraszamy za niedogodnosc! 404!</span>';
            echo '<br/>Informacja developerska: '.$e;
            exit();
        }
        //flaga kiedy wszystko OK

    }

?>


<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <meta charset="UTF-8">
    <title>Osadnicy - rejestracja</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <form method="POST">
        Nickname</br><input type="text" name="nick" /></br>
        <?php 
		  if(isset($_SESSION['e_nick']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_nick'].'</span></br>';
		      unset ($_SESSION['e_nick']);
		  }
		?> e-mail
        </br><input type="email" name="email" /> </br>
        <?php 
		  if(isset($_SESSION['e_email']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_email'].'</span></br>';
		      unset ($_SESSION['e_email']);
		  }
		?> Haslo
        </br><input type="password" name="haslo1" /> </br>
        <?php 
		  if(isset($_SESSION['e_haslo']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_haslo'].'</span></br>';
		      unset ($_SESSION['e_haslo']);
		  }
		?> Powtorz haslo</br><input type="password" name="haslo2" /> </br>
        <label>
			<input type="checkbox" name="regulamin"/> Akceptuje 
		</label>
        <a href="regulamin.html">regulamin</a></br>
        <?php 
		  if(isset($_SESSION['e_regulamin']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_regulamin'].'</span></br>';
		      unset ($_SESSION['e_regulamin']);
		  }
		?>
        <!--   <div class="g-recaptcha" data-sitekey="6LfE-EMUAAAAAFElRpclvKQ8sn39jqyy-ATRLHqI"></div> <br/>-->
        <?php 
		 // if(isset($_SESSION['e_bot']))
		 // {
		 //     echo '<span style="color:red">'.$_SESSION['e_bot'].'</span></br>';
		 //    unset ($_SESSION['e_bot']);
		 //} ?>

        <input type="submit" value="Zarejestruj sie" />
    </form>
    <?php 


    ?>
</body>

</html>
