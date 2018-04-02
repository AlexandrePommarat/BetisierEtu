
	<h1>Supprimer des personnes enregistrées</h1>
	<?php
	if(!isset($_SESSION['userconnecte'])){
		header("Refresh:0,url='./index.php?page=9'");
	}else{
		if($_SESSION['admin']==false){
			echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
			header("Refresh:2,url='./index.php?page=0'");
		}else{

			$db=new Mypdo();
			$personneManager= new PersonneManager($db);
			$personnes=$personneManager->getAllPersSaufConnecte($_SESSION['userconnecte']);
			?>

		<table border=1>
			<tr><th>Numéro</th><th>Nom</th><th>Prenom</th><th>Supprimer</th></tr>
			<?php

				foreach ($personnes as $personne) {
					?>
					<td><?php echo $personne->getPerNum();?></a></td>
					<td><?php echo $personne->getPerNom();?></td>
					<td><?php echo $personne->getPerPrenom();?></td>
					<td><a class="lien" href="./index.php?page=25&amp;num=<?php echo $personne->getPerNum();?>"><img src='./image/erreur.png' alt='Suppression'></a></td>
				</tr>
				<?php
				}
				?>
			</table>
<?php
	}
}
?>
