

<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);

$erreur=0;
if(!isset($_SESSION['userconnecte'])){
	header("Refresh:0,url='./index.php?page=9'");
}
else{

	if( empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["mail"]) || empty($_POST["login"]) || empty($_POST["mdp"]) || empty($_POST["categorie"])){
		if(isset($_SESSION['login_existant'])){
			echo "<p><img src='./image/erreur.png' alt='Image erreur'>  Le login \"<strong>".$_SESSION['login']."</strong>\" existe déja <p>";
			unset($_SESSION['login_existant']);
			unset($_SESSION['login']);

		}
		?>
		<h1>Ajouter une personne</h1>

		<table class="centrerBlock">
			<form method="post" action="#">
				<tr>
					<td><strong>Nom:</strong></td>
					<td><input type="text" class="champ" name="nom" /></td>
				</tr>
				<tr>
					<td><strong>Prénom:</strong></td>
					<td><input type="text" class="champ" name="prenom" /></td>
				</tr>
				<tr>
					<td><strong>Téléphone:</strong></td>
					<td><input type="text" class="champ" name="telephone" /></td>
				</tr>
				<tr>
					<td><strong>Mail:</strong></td>
					<td><input type="text" class="champ" name="mail" /></td>
				</tr>
				<tr>
					<td><strong>Login:</strong></td>
					<td><input type="text" class="champ" name="login" /></td>
				</tr>
				<tr>
					<td><strong>Mot de Passe:</strong></td>
					<td><input type="password" class="champ" name="mdp" /></td>
				</tr>
				<tr>
					<td><strong>Catégorie:</strong></td>
					<td>
						<input type= "radio" name="categorie" value="etudiant"> Etudiant
						<input type= "radio" name="categorie" value="personnel"> Personnel
					</td>
				</tr>

			</table>


			<td><input type="submit" class="bouton" value="Valider" /></td>
			<?php



		}else{

			$login_existant=$personneManager->getLoginExistant($_POST['login']);
			$_SESSION['login']=$_POST['login'];
			if($login_existant==1){
				$_SESSION['login_existant']=$login_existant;
				header("Refresh:2,url='./index.php?page=1'");
			}
			else{
				$salt = "48@!alsd";
				$password = $_POST['mdp'];
				$passwordMD5 = md5(md5($password).$salt);
				$_SESSION['nom']=$_POST['nom'];
				$_SESSION['prenom']=$_POST['prenom'];
				$_SESSION['telephone']=$_POST['telephone'];
				$_SESSION['mail']=$_POST['mail'];
				$_SESSION['mdp']=$passwordMD5;
				$_SESSION['categorie']=$_POST['categorie'];
				if($_SESSION['categorie']=="personnel"){
					header("Refresh:0,url='./index.php?page=14'");
				}
				else{
					header("Refresh:0,url='./index.php?page=15'");

				}
			}
		}
	}

	?>
