<?php
$db=new Mypdo();
$citationManager= new CitationManager($db);
$citations=$citationManager -> getCitationEnAttente();
$personneManager= new PersonneManager($db);
$nbcitations=$citationManager->getNbreCitationEnAttente();
$etudiantManager= new EtudiantManager($db);
$VoteManager= new VoteManager($db);

if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
}else{
?>
<div class "titre">	<h1>Liste des citations en attente de validation</h1> </div>
<p>Actuellement <?php echo $nbcitations;  ?> citations sont en attente</p>

<table border=1>
	<tr><th>Nom de l'enseignant</th><th>Libellé</th><th>Date</th><th>Valider</th></tr>
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
			<td><a class="lien" href="./index.php?page=22&amp;num=<?php echo $citation->getCitNum();?>"><img src='./image/valid.png' alt='Validation'></a></td>
					<?php
				}
				?>
			</tr>
			<?php
		}
	}?>
</table>
