

<?php
$db=new Mypdo();
$villeManager= new VilleManager($db);
$villes=$villeManager -> getAllVilles();
?>

<div class "titre">	<h1>Liste des villes</h1> </div>
<p>Actuellement <?php echo sizeOf($villes) ?> villes sont enregistrées</p>
<table border=1 class="centrerBlock">
	<tr><th>Numéro</th><th>Nom</th></tr>
	<?php //$villes est un tableau d'objet ville
	foreach ($villes as $ville){ // on parcours le tableau villes
		?>
		<tr>
				<td><?php echo $ville->getVilNum();?></td>
			  <td><?php echo $ville->getVilNom();?></td>
		</tr>
	<?php } ?>
</table>
<br />
