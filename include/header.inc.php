<?php
  session_start();
  ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">

		<div id="connect">
      <?php
          if(isset($_SESSION['userconnecte'])){
            echo "Utilisateur : <strong>".$_SESSION['userconnecte']." <a href=\"index.php?page=11\" >Déconnexion</a></strong> "; ?>
            </div>
        		<div id="entete">
        			<div id="logo">
                <img src='./image/smile.jpg' width="150px" height="150 px">
                <?php
          }
          else{
            echo"<a href=\"index.php?page=9\" >Connexion</a>";?>
            </div>
        		<div id="entete">
        			<div id="logo">
                <img src='./image/lebetisier.gif' width="120px" height="175px">
        <?php  }
        ?>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
