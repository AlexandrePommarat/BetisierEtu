<?php
$db=new Mypdo();
$citationManager= new CitationManager($db);
$voteManager= new VoteManager($db);

if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
  }else{
    $numero = htmlspecialchars($_GET['num']);
    $voteManager->deleteVoteByCitId($numero);
    $citationManager->deleteCitationByCitNum($numero);

    echo "<p><img src='./image/valid.png' alt='Image validation'> La citation a bien été supprimés.<p>";
    header("Refresh:2,url='./index.php?page=19'");

  }
}
?>
