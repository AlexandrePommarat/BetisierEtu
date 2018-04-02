<?php

unset($_SESSION['userconnecte']);
unset($_SESSION['admin']);
echo "<img src='./image/valid.png' alt='Image validation'> Vous avez bien été déconnecté !<br /><br />";
echo "Redirection dans 2 secondes.";
header("Refresh:2,url='./index.php?page=0'");
?>
