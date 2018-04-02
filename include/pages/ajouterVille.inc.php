<h1>Ajouter une ville</h1>
<?php
$db=new Mypdo();
$villeManager= new VilleManager($db);

if ( empty($_POST["nom"])){ //premier appel de la page
  ?>


  <table class="centrerBlock">
    <form method="post" action="#">
      <tr>
        <td><strong>Nom:</strong></td>
        <td><input type="text" class="champ" name="nom" /></td>
      </tr>

      <tr>
        <td></td>
        <td><input type="submit" class="bouton" value="Valider" /></td>
      </tr>
    </table>

    <?php
  }else{
    $ville= new Ville(
      array('vil_nom' => $_POST['nom'])
    );
    $ajout=$villeManager->addVille($ville);
    if($ajout){
      echo "<p><img src='./image/valid.png' alt='Image validation'>  La ville \"<strong>".$_POST['nom']."</strong>\" a été ajoutée<p>";
    }
    else{
      echo "<p><img src='./image/erreur.png' alt='Image erreur'>  La ville \"<strong>".$_POST['nom']."</strong>\" existe déja <p>";
    }
  }?>
