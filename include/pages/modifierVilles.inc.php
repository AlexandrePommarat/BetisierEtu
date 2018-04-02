<?php
if(!isset($_SESSION['userconnecte'])){
  header("Refresh:0,url='./index.php?page=9'");
}else{
  if($_SESSION['admin']==false){
    echo "il faut être admin pour accéder à cette page, vous allez être redirigé dans 2 secondes";
    header("Refresh:2,url='./index.php?page=0'");
}else{
  echo "vous pouvez modifier une ville";
}
}
?>
