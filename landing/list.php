<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        $login = filter_input(INPUT_POST,'login');
        $password = filter_input(INPUT_POST,'pass');
        echo $login." ".$password;
        
    } else
    {
        header ('Location: admin.php');
        
    }
?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<title>lista</title>

</head>
<body>
	<div id="container">
		<header>
			<h1>Newsletter</h1>
		</header>
	</div>
</body>
</html>