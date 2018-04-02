
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
	$personnes=$personneManager->getPreNomId();
	$nbpersonne=$personneManager->getNbrePersonne();
	?>
<div class "titre"><h1>Liste des personnes enregistrées</h1></div>
<p>Actuellement <?php echo $nbpersonne;  ?> citations sont enregistrées</p>

<table border=1>
	<tr><th>Nom</th><th>Prenom</th><th>Modifier</th></tr>
	<?php

		foreach ($personnes as $personne) {
			?>
			<td><?php echo $personne->getPerNom();?></td>
			<td><?php echo $personne->getPerPrenom();?></td>
      <td><a class="lien" href="./index.php?page=26&amp;num=<?php echo $personne->getPerNum();?>"><img src='./image/modifier.png' alt='Modification'></a></td>
		</tr>
		<?php
		}
		?>
	</table>
<?php }
}
?>
