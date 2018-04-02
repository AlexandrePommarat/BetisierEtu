
<?php
$db=new Mypdo();
$citationManager= new CitationManager($db);
$citations=$citationManager -> getAllCitations();
$personneManager= new PersonneManager($db);
$nbcitations=$citationManager->getNbreCitationValide();
$etudiantManager= new EtudiantManager($db);
$VoteManager= new VoteManager($db);
if(isset($_SESSION['userconnecte'])){
	$EstEtudiant=$etudiantManager->EstUnEtudiant($personneManager->getIdByLogin($_SESSION['userconnecte']));
}else{
	$EstEtudiant=0;
}
?>

<div class "titre">	<h1>Liste des citations déposées</h1> </div>
<p>Actuellement <?php echo $nbcitations;  ?> citations sont enregistrées</p>

<table border=1>
	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th>
		<?php
		if($EstEtudiant){
			?>
			<th>Noter</th>
			<?php
		}?>
	</tr>
	<?php

	foreach ($citations as $citation){
		$date = $citation->getCitDate();
		$cita = explode('-',$date);
		$date = $cita[2]."/".$cita[1]."/".$cita[0];
		?>
		<tr>
			<td><?php echo $personneManager->getNomPreById($citation->getPerNum())->getPerPrenom().' '.$personneManager->getNomPreById($citation->getPerNum())->getPerNom();?></td>
			<td><?php echo $citation->getCitLib();?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $citationManager->getMoyenneByIdCit($citation->getCitNum());?></td>
			<?php
			if($EstEtudiant){
		 			if($VoteManager->verifVoteCitation($personneManager->getIdByLogin($_SESSION['userconnecte']),$citation->getCitNum())){
						?><td><img src='./image/erreur.png' alt='Modification' ></td><?php
					}else{
					?><td><a class="lien" href="./index.php?page=16&amp;num=<?php echo $citation->getCitNum();?>"><img src='./image/modifier.png' alt='Modification'></a></td>
					<?php
				}
				?>
			</tr>
			<?php
		}
	}?>
</table>
