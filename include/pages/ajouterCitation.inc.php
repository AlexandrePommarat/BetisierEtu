
<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$motManager = new MotManager($db);
$salarieManager= new SalarieManager($db);
$etudiantManager= new EtudiantManager($db);
$enseignants= $salarieManager->getPerNumProf();
$_SESSION['page_personne']=5;
if(!isset($_SESSION['userconnecte'])){
	header("Refresh:0,url='./index.php?page=9'");
}else{
	$EstEtudiant=$etudiantManager->EstUnEtudiant($personneManager->getIdByLogin($_SESSION['userconnecte']));
	if($EstEtudiant){
		?>
		<h1>Ajouter une citation</h1>
		<?php
			if(!empty($_POST['citation'])){
				$listeMotsCitation = explode(' ',$_POST['citation']);
				$nbrMotInterdit = 0;

				foreach($listeMotsCitation as $mot){
					$motManager->estInterdit($mot);

					if($motManager->estInterdit($mot)){
						$nbrMotInterdit += 1;
						echo "<img src='./image/erreur.png' alt='icone erreur'> Le mot : ".$mot." n'est pas autorisé <br>";
						$listeMotsCitation = str_replace($mot,"---",$listeMotsCitation);
					}
				}

				$citationRecolee = implode(' ',$listeMotsCitation);
				$_SESSION['cit_libelle'] = $citationRecolee;
				$_SESSION['cit_date'] = $_POST['cit_date'];
			}
			?>
			<table class="centrerBlock">
				<form method="post" action="#">
					<tr>
						<td><strong>Enseignant:</strong></td>
						<td><select class="champ" name="enseignant" size="1">
							<?php
							foreach($enseignants as $enseignant){
								?>

								<option value=<?php echo $enseignant->getPerNum() ?>><?php echo $personneManager->getPerNomByNum($enseignant->getPerNum()) ;?></option>

								<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<td><strong>Date Citation:</strong></td>
						<td><input type="date" class="champ" name="cit_date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}"
							<?php
							if(!empty($_SESSION['cit_date'])){
								echo "value=".$_SESSION['cit_date'];
							}
							?> required /></td>


							<tr>
								<td><strong>Citation:</strong></td>
								<td><input type="text" class="champ" name="citation" value="<?php if(!empty($_SESSION['cit_libelle'])){echo $_SESSION['cit_libelle'];}?>" required /></td>
							</tr>
						</tr>
					</table>
					<td><input type="submit" class="bouton" value="Valider" /></td>
					<?php

    if(!empty($_POST['citation']) && $nbrMotInterdit==0){

      $citationManager = new CitationManager($db);



      $date = getDate();
      $timestamp = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
      $citationManager->ajouterCitation($_POST['enseignant'],null,$personneManager->getIdByLogin($_SESSION['userconnecte']),$_POST['citation'],$_POST['cit_date'],false,null,$timestamp);

      echo "<img src='./image/valid.png' alt='icone valide'> La citation a été ajoutée !";

      unset($_SESSION['cit_date']);
      unset($_SESSION['cit_libelle']);
    }



			}else{
				echo "Il faut être un étudiant pour ajouter une citation, vous allez être redirigé";
				header("Refresh:2,url='./index.php?page=0'");

			}
		}
		?>
