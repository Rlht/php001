<?php
    session_start();
    require_once 'database.php';
        
    if (!isset ($_SESSION['logged_id'])) {
    
    
        if(isset($_POST['login']))
        {
            $login = filter_input(INPUT_POST,'login');
            $password = filter_input(INPUT_POST,'pass');
            
            // echo $login." ".$password;
            
            
            $userQuery = $db->prepare('SELECT id, password FROM admins WHERE login = :login');
            $userQuery->bindValue(':login', $login, PDO::PARAM_STR);
            $userQuery->execute();
            
            // echo $userQuery->rowCount();
            
            $user = $userQuery->fetch();
            // echo $user['id'].' '.$user['password'];
            
            if(!empty($user) && password_verify($password, $user['password'])) {
                $_SESSION['logged_id'] = $user['id'];
                unset ($_SESSION['bad_attempt']);
            } else {
                $_SESSION['bad_attempt'] = true;
                header ('Location: admin.php');
                exit();
            }
            
        } else
        {
            header ('Location: list.php');            
            exit();
        }
    }
    
    $usersQuery = $db->query('SELECT * FROM users');
    $users = $usersQuery->fetchAll();
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
		<main>
			<article>
				<table>
					<thead>
						<tr>
							<th colspan="2">
								Lacznie rekordow: 
								<?= $usersQuery->rowCount() ?>
						
							</th>
						 </tr>
						 <tr><th>ID</th><th>EMAIL</th></tr>
					</thead>
					<tbody>
						<?php 
						foreach ($users as $user1) {
						    echo "<tr><td>{$user1['id']}</td><td>{$user1['email']}</td></tr>";
						}
						?>
					</tbody>
				</table>
				<p><a href="logout.php">Wyloguj sie!</a></p>								
			</article>
		</main>
	</div>
</body>
</html>