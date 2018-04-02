

	<?php
	
	$db=new Mypdo();
	$personneManager= new PersonneManager($db);
	$personnes=$personneManager->getPreNomId();
	$nbpersonne=$personneManager->getNbrePersonne();
	?>
<div class "titre"><h1>Liste des personnes enregistrées</h1></div>
<p>Actuellement <?php echo $nbpersonne;  ?> citations sont enregistrées</p>

<table border=1>
	<tr><th>Numéro</th><th>Nom</th><th>Prenom</th></tr>
	<?php

		foreach ($personnes as $personne) {
			?>
			<td><a class="lien" href="./index.php?page=12&amp;num=<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNum();?></a></td>
			<td><?php echo $personne->getPerNom();?></td>
			<td><?php echo $personne->getPerPrenom();?></td>
		</tr>
		<?php
		}
		?>
	</table>
	<p>Cliquez sur le numéro de la personne pour obtenir plus d'informations.</p>
