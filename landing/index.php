<?php 
 $maintext = file('maintext.txt');
?>
<!DOCTYPE html>
<html lang="pl">

<head>
<meta charset="UTF-8">
<title>Landing Page</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=VT323&amp;subset=latin-ext" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style_header.css">
<link rel="stylesheet" href="css/style_main.css">
</head>

<body>
<header>
<nav>
<i class="fa fa-bars" aria-hidden="true"></i>
</nav>
<hgroup>
<h1>Marcin Ścigajło</h1>
<h3>Programista - to też człowiek</h3>
</hgroup>
<img src="img/header_img.jpg">
<div id="arrow">
<i class="fa fa-sort-desc" aria-hidden="true"></i>
</div>
<form method ="post" action ="save.php">
<label>Podaj adres e-mail
<input type="email" name="email"
    <?=
    isset($_SESSION['given_email'])
        ? 'value="' . $_SESSION['given_email'].'"' 
        : '';  
        ?> >
        	</label>
        	<input type="submit" value="Zapisz się!">
        	<?php
				if (isset($_SESSION['given_email'])) {
				echo '<p>To nie jest poprany adres!</p>';
				unset($_SESSION['given_email']);
				}
			?>
        </form>                
    </header>
    <!--  2ga stronka  -->
    <main>
        <img src="img/face_img.jpg">
        <div id="inside">
            <?php 
            foreach($maintext as $text) {
                echo '<span>'.$text.'</span>';
            }
            ?>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/screenmove.js"></script>
</body>

</html>
