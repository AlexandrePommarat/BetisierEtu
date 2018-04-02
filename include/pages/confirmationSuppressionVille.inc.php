<?php
$db=new Mypdo();
$departementManager=new DepartementManager($db);
$villeManager= new VilleManager($db);

if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
  }else{
    $numero = htmlspecialchars($_GET['num']);
    $departements=$departementManager->getDepNumByVilNum($numero);
    if(!empty($departements)){
      echo "<p><img src='./image/erreur.png' alt='Image erreur'>  On ne peut pas supprimer la ville, il y a des départements qui y sont associés.<p>";
      header("Refresh:2,url='./index.php?page=21'");
    }else{
        $villeManager->deleteVille($numero);
        echo "<p><img src='./image/valid.png' alt='Image validation'> La ville a bien été supprimés.<p>";
        header("Refresh:2,url='./index.php?page=21'");

      }
}
}
?>
