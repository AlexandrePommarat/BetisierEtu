<?php
$db=new Mypdo();

if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
}else{
$numero = htmlspecialchars($_GET['num']);
$todayh = getdate(); //monday week begin reconvert
$mday="mday";
$mon="mon";
$year="year";
$d = $todayh[$mday];
$m = $todayh[$mon];
$y = $todayh[$year];
$date="$y-$m-$d";
  $citationManager=new CitationManager($db);
  $citationManager->validerCitations($numero,$date);
}
}
echo "<img src='./image/valid.png' alt='Image validation'>La citation a bien été validé, vous allez être redirigé.";
header("Refresh:2,url='./index.php?page=0'");

?>
