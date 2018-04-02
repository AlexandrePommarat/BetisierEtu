<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$etudiantManager= new EtudiantManager($db);
?>
<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>
			<li><a href="index.php?page=2">Lister</a></li>
			<?php if(isset($_SESSION['userconnecte'])){
				?>
				<li><a href="index.php?page=1">Ajouter</a></li>
				<?php if($_SESSION['admin']==true){
					?>
				<li><a href="index.php?page=3">Modifier</a></li>
				<li><a href="index.php?page=4">Supprimer</a></li>
				<?php
			}
		}
			?>

		</ul>
		<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
		<ul>
			<?php if(isset($_SESSION['userconnecte'])){
				$EstEtudiant=$etudiantManager->EstUnEtudiant($personneManager->getIdByLogin($_SESSION['userconnecte']));
		    if($EstEtudiant){
		      ?>
				<li><a href="index.php?page=5">Ajouter</a></li>
				<?php
			}
			}
			?>
			<li><a href="index.php?page=6">Lister</a></li>
			<?php if(isset($_SESSION['userconnecte'])){
				?>
				<li><a href="index.php?page=7">Rechercher</a></li>
				<?php if($_SESSION['admin']=='1'){
					?>
				<li><a href="index.php?page=18">Valider</a></li>
				<li><a href="index.php?page=19">Supprimer</a></li>
				<?php
			}
		}
			?>
		</ul>
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=8">Lister</a></li>
			<?php if(isset($_SESSION['userconnecte'])){
				?>
				<li><a href="index.php?page=17">Ajouter</a></li>
				<li><a href="index.php?page=20">Modifier</a></li>

				<?php if($_SESSION['admin']=='1'){
					?>
				<li><a href="index.php?page=21">Supprimer</a></li>
				<?php
			}
		}
			?>
		</ul>
	</div>
</div>
