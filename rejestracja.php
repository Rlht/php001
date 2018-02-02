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
        
        
        
        
        if ($allgood)
        {
            //zapytanie insert
            echo "udana walidacja";
            exit();
        }
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
		Nickname</br><input type="text" name="nick" /> </br>		
		<?php 
		  if(isset($_SESSION['e_nick']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_nick'].'</span></br>';
		      unset ($_SESSION['e_nick']);
		  }
		?>
		e-mail</br><input type="email" name="email" /> </br>
		<?php 
		  if(isset($_SESSION['e_email']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_email'].'</span></br>';
		      unset ($_SESSION['e_email']);
		  }
		?>
		Haslo</br><input type="password" name="haslo1" /> </br>
		<?php 
		  if(isset($_SESSION['e_haslo']))
		  {
		      echo '<span style="color:red">'.$_SESSION['e_haslo'].'</span></br>';
		      unset ($_SESSION['e_haslo']);
		  }
		?>
		Powtorz haslo</br><input type="password" name="haslo2" /> </br>
		<label>
			<input type="checkbox" name="regulamin"/> Akceptuje 
		</label> 
		<a href="regulamin.html">regulamin</a></br>
		<!--   <div class="g-recaptcha" data-sitekey="6LfE-EMUAAAAAFElRpclvKQ8sn39jqyy-ATRLHqI"></div> <br/> -->
		<input type="submit" value="Zarejestruj sie" />
	</form>
	<?php 


    ?>
</body>
</html>