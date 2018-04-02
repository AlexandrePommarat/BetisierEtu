
<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$fonctionManager=new FonctionManager($db);
$fonctions= $fonctionManager->getAllFonction();
$salarieManager=new SalarieManager($db);


if(empty($_POST['fonction']) || empty($_POST['telpro'])){
  ?><h1>Ajouter un salarié</h1>
  <table class="centrerBlock">
    <form method="post" action="#">
      <tr>
        <td><strong>Téléphone professionnel:</strong></td>
        <td><input type="text" class="champ" name="telpro" /></td>
      </tr>
      <tr>
        <td><strong>Fonction:</strong></td>
        <td><select class="champ" name="fonction" size="1">
          <?php

          foreach($fonctions as $fonction){
            ?>
            <option value=<?php echo $fonction->getFonNum(); ?>><?php echo $fonction->getFonLibelle();?></option>

              <?php
            }
            ?>
          </select></td>
        </tr>
      </table>
      <td><input type="submit" class="bouton" value="Valider" /></td>
      <?php
    }
    else{
      $_SESSION['fonction']=$_POST['fonction'];
      $_SESSION['telpro']=$_POST['telpro'];
      if(isset($_SESSION['fonction']) && isset($_SESSION['telpro'])){
      $personne= new Personne(
        array(
          'per_nom' => $_SESSION['nom'],
          'per_prenom' => $_SESSION['prenom'],
          'per_tel' => $_SESSION['telephone'],
          'per_mail' => $_SESSION['mail'],
          'per_login' => $_SESSION['login'],
          'per_pwd' => $_SESSION['mdp']
      ));
      $ajoutPersonne=$personneManager->addPersonne($personne);
      $per_num=$db->lastInsertId();  //permet de récupérer le dernier id ajouté
      $salarie= new Salarie(
        array(
          'per_num' => $per_num,
          'sal_telprof' => $_SESSION['telpro'],
          'fon_num' => $_SESSION['fonction']
      ));
      $ajoutSalarie=$salarieManager->addSalarie($salarie);
      echo "<p><img src='./image/valid.png' alt='Image validation'> <strong> Le salarié a été ajouté !</strong><p>";
      unset($_SESSION['nom']);
			unset($_SESSION['prenom']);
			unset($_SESSION['telephone']);
			unset($_SESSION['mail']);
      unset($_SESSION['login']);
			unset($_SESSION['mdp']);
			unset($_SESSION['categorie']);
      unset($_SESSION['fonction']);
      unset($_SESSION['telpro']);

    }
    else{
      echo "<p><img src='./image/erreur.png' alt='Image erreur'><strong>  Le salarié n'a pas été ajouté</strong> <p>";
    }
  }
