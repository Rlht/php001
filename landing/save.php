<?php 
    session_start();

    if (isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        
        if (empty($email)){
            $_SESSION['given_email'] = $_POST['email'];
            header ('Location: index.php');
            
        } else {
            require_once 'database.php';
            $query = $db->prepare('INSERT INTO users VALUES (NULL, :email)');
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->execute();
            
        }
    } else {
        header ('Location: index.php');
        exit();
        
    }
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/style_save.css">
</head>

<body>
	<h2>Zapisales sie na NEWSLETTER!</h2>
</body>

</html>
