

	<?php
	if(!isset($_SESSION['userconnecte'])){
		header("Refresh:0,url='./index.php?page=9'");
	}else{
		if($_SESSION['admin']==false){
			echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
			header("Refresh:2,url='./index.php?page=0'");
		}else{
			$db=new Mypdo();
			$personneManager=new PersonneManager($db);
			$etudiantManager=new EtudiantManager($db);
			$erreur=0;

			if( empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["mail"]) || empty($_POST["login"]) || empty($_POST["mdp"]) || empty($_POST["categorie"])){
				if(isset($_SESSION['login_existant'])){
					echo "<p><img src='./image/erreur.png' alt='Image erreur'>  Le login \"<strong>".$_SESSION['login']."</strong>\" existe déja <p>";
					unset($_SESSION['login_existant']);
					unset($_SESSION['login']);

				}
				$numero = htmlspecialchars($_GET['num']);
				$_SESSION['per_num']=$numero;

				$personne=$personneManager->getPersonneByNum($numero);
				$_SESSION['ancienLogin']=$personne->per_login;
				if($etudiantManager->EstUnEtudiant($personne->per_num)){
					$_SESSION['ancienTitre']=true;
				}else{
					$_SESSION['ancienTitre']=false;
				};
				?>
				<h1>Modifier une personne enregistrées</h1>
				<table class="centrerBlock">
					<form method="post" action="#">
						<tr>
							<td><strong>Nom:</strong></td>
							<td><input type="text" class="champ" name="nom" value="<?php echo $personne->per_nom;?>" /></td>
						</tr>
						<tr>
							<td><strong>Prénom:</strong></td>
							<td><input type="text" class="champ" name="prenom" value="<?php echo $personne->per_prenom;?>" /></td>
						</tr>
						<tr>
							<td><strong>Téléphone:</strong></td>
							<td><input type="text" class="champ" name="telephone" value="<?php echo $personne->per_tel;?>"/></td>
						</tr>
						<tr>
							<td><strong>Mail:</strong></td>
							<td><input type="text" class="champ" name="mail" value="<?php echo $personne->per_mail;?>" /></td>
						</tr>
						<tr>
							<td><strong>Login:</strong></td>
							<td><input type="text" class="champ" name="login" value="<?php echo $personne->per_login;?>" /></td>
						</tr>
						<tr>
							<td><strong>Mot de Passe:</strong></td>
							<td><input type="password" class="champ" name="mdp" required /></td>
						</tr>
						<tr>
							<td><strong>Catégorie:</strong></td>
							<td>
								<?php
								$EstEtudiant=$etudiantManager->EstUnEtudiant($personne->per_num);
								if($EstEtudiant){
									?>
								<input type= "radio" name="categorie" value="etudiant" checked> Etudiant
								<input type= "radio" name="categorie" value="personnel"> Personnel
							</td>
							<?php
						}else{
							?>
							<input type= "radio" name="categorie" value="etudiant" > Etudiant
							<input type= "radio" name="categorie" value="personnel" checked > Personnel
							<?php
						}?>
						</tr>

					</table>


					<td><input type="submit" class="bouton" value="Valider" /></td>
					<?php



				}else{
					if($_POST['login']!=$_SESSION['ancienLogin']){
						$login_existant=$personneManager->getLoginExistant($_POST['login']);

						$_SESSION['login_existant']=$login_existant;
						if($login_existant==1){
							$_SESSION['ok']=false;
						}else{
							$_SESSION['ok']=true;
						}
					}else{
						$_SESSION['ok']=true;

					}
					$_SESSION['login']=$_POST['login'];
						if($_SESSION['ok']==true){
							unset($_SESSION['ok']);
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
								header("Refresh:0,url='./index.php?page=27'");
							}
							else{
								header("Refresh:0,url='./index.php?page=28'");

							}

						}else{
								unset($_SESSION['login']);
								unset($_SESSION['login_existant']);
								unset($_SESSION['ok']);
								header("Refresh:0,url='./index.php?page=3'");
						}

					}
				}
			}
			?>
