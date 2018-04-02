
<?php
$db=new Mypdo();

$cit_num = htmlspecialchars($_GET['num']);
$citationManager= new CitationManager($db);
$citations=$citationManager -> getAllCitations();
$personneManager= new PersonneManager($db);
$etudiantManager= new EtudiantManager($db);
$VoteManager= new VoteManager($db);


if ( empty($_POST["note"])){ //premier appel de la page
  ?>
<div class "titre">	<h1><?php echo 'Notation de la citation n°'.' '.$cit_num;?></div>

<table class="centrerBlock">
  <form method="post" action="#">
    <tr>
      <td><strong>Note:</strong></td>
      <td><input type="text" class="champ" name="note" /></td>
    </tr>

    <tr>
      <td></td>
      <td><input type="submit" class="bouton" value="Valider" /></td>
    </tr>
  </table>
  <?php
}else{
  $vote= new Vote(
    array(
      'cit_num' => $cit_num,
      'per_num' => $personneManager->getIdByLogin($_SESSION['userconnecte']),
      'vot_valeur' => $_POST['note']));
  $ajout=$VoteManager->addVote($vote);
    echo "<p><img src='./image/valid.png' alt='Image validation'> Votre vote a bien été enregistré, vous allez être redirigés<p>";
  header("Refresh:2,url='./index.php?page=6'");

}?>
