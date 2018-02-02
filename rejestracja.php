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
		e-mail</br><input type="email" name="email" /> </br>
		Haslo</br><input type="password" name="haslo1" /> </br>
		Powtorz haslo</br><input type="text" name="haslo2" /> </br>
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