<?php
if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
}else{
	$db=new Mypdo();
	$villeManager= new VilleManager($db);
	$villes=$villeManager -> getAllVilles();
	?>

	<div class "titre">	<h1>Liste des villes</h1> </div>
	<p>Actuellement <?php echo sizeOf($villes) ?> villes sont enregistrées</p>
	<table border=1 class="centrerBlock">
		<tr><th>Numéro</th><th>Nom</th><th>Supprimer</th></tr>
		<?php //$villes est un tableau d'objet ville
		foreach ($villes as $ville){ // on parcours le tableau villes
			?>
			<tr>
					<td><?php echo $ville->getVilNum();?></td>
				  <td><?php echo $ville->getVilNom();?></td>
					<td><a class="lien" href="./index.php?page=23&amp;num=<?php echo $ville->getVilNum();?>"><img src='./image/erreur.png' alt='Suppression'></a></td>
							<?php
						}
						?>
			</tr>
		<?php } ?>
	</table>
	<br />
<?php
}
?>
