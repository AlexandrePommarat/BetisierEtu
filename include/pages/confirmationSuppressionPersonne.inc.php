<?php
$db=new Mypdo();
$voteManager=new VoteManager($db);
$etudiantManager= new EtudiantManager($db);
$citationManager= new CitationManager($db);
$personneManager= new PersonneManager($db);
$salarieManager= new SalarieManager($db);


if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
  }else{
    $numero = htmlspecialchars($_GET['num']);
    $EstEtudiant=$etudiantManager->EstUnEtudiant($numero);
    if($EstEtudiant){
      $voteManager->deleteVoteByEtuId($numero);
      $citationManager->deleteCitationByEtuId($numero);
      $etudiantManager->deleteEtudiantById($numero);
      $personneManager->deletePersonneById($numero);
      echo "<p><img src='./image/valid.png' alt='Image validation'> L'étudiant et toutes ses données affiliés ont été supprimés.<p>";
      header("Refresh:2,url='./index.php?page=4'");


    }else{//est salarie
      if($personneManager->estAdmin($numero)){
        echo "<p><img src='./image/erreur.png' alt='Image Erreur'> On ne peut pas supprimés un administrateur, désolé.<p>";
        header("Refresh:2,url='./index.php?page=4'");
      }
      else{
      $citations=$citationManager->getCitNumBySalNum($numero);
      foreach($citations as $citation){
        $voteManager->deleteVoteByCitId($citation->getCitNum());
        $citationManager->deleteCitationByCitNum($citation->getCitNum());
      }
      $salarieManager->deleteSalarieBySalNum($numero);
      $personneManager->deletePersonneById($numero);
      echo "<p><img src='./image/valid.png' alt='Image validation'> Le salarié et toutes ses données affiliés ont été supprimés.<p>";
      header("Refresh:2,url='./index.php?page=4'");
      }
    }
  }
}
?>
