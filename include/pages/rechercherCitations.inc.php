
<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);

$erreur=0;
if(!isset($_SESSION['userconnecte'])){
	header("Refresh:0,url='./index.php?page=9'");
}
else{

	if( empty($_POST["nom"]) && empty($_POST["date"]) && empty($_POST["note"]) ){

		?>
		<h1>Rechercher une citation</h1>

		<table class="centrerBlock">
			<form method="post" action="#">
				<tr>
					<td><strong>Nom de l'enseignant:</strong></td>
					<td><input type="text" class="champ" name="nom" /></td>
				</tr>
				<tr>
					<td><strong>Date:</strong></td>
					<td><input type="text" class="champ" name="date" /></td>
				</tr>
				<tr>
					<td><strong>Note obtenue:</strong></td>
					<td><input type="text" class="champ" name="note" /></td>
				</tr>
			</table>

			<input type="submit" class="bouton" value="Valider" />
			<?php



		}else{
      echo "hello world";
		}
	}

	?>
