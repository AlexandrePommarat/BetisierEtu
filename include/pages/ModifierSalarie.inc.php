<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$fonctionManager=new FonctionManager($db);
$fonctions= $fonctionManager->getAllFonction();
$salarieManager=new SalarieManager($db);
$voteManager= new VoteManager($db);
$citationManager = new CitationManager($db);


if(empty($_POST['fonction']) || empty($_POST['telpro'])){
  ?><h1>Modifier un salarié</h1>
  <table class="centrerBlock">
    <form method="post" action="#">
      <tr>
        <td><strong>Téléphone professionnel:</strong></td>
        <?php
        if($_SESSION['ancienTitre']==true){
          ?>
          <td><input type="text" class="champ" name="telpro" /></td>
          <?php
        }else{
          $telpro=$salarieManager->getTelProfFonNumById($_SESSION['per_num'])
          ?>
          <td><input type="text" class="champ" name="telpro" value="<?php echo $telpro->getSalTelProf()?>" /></td>
          <?php
        }
        ?>

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
    if($_SESSION['ancienTitre']==false){ // si c'était un salarié
      unset($_SESSION['ancienTitre']);
      $personneManager->updatePersonne($_SESSION['per_num'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['telephone'],$_SESSION['mail'],$_SESSION['login'],$_SESSION['mdp']);
      $salarieManager->updateSalarie($_SESSION['per_num'],$_SESSION['telpro'],$_SESSION['fonction']);
      echo "<p><img src='./image/valid.png' alt='Image validation'> Le salarié a bien été mis à jour.<p>";
      header("Refresh:2,url='./index.php?page=3'");

    }else{ // si c'était un étudiant
      unset($_SESSION['ancienTitre']);
      $voteManager->deleteVoteByEtuId($_SESSION['per_num']);
      $citationManager->deleteCitationByEtuId($_SESSION['per_num']);
      $etudiantManager->deleteEtudiantById($_SESSION['per_num']);
      $personneManager->updatePersonne($_SESSION['per_num'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['telephone'],$_SESSION['mail'],$_SESSION['login'],$_SESSION['mdp']);

      $salarie= new Salarie(
        array(
          'per_num' => $_SESSION['per_num'],
          'sal_telprof' => $_SESSION['telpro'],
          'fon_num' => $_SESSION['fonction']
        ));
        $ajoutSalarie=$salarieManager->addSalarie($salarie);
        echo "<p><img src='./image/valid.png' alt='Image validation'> L'étudiant a bien été modifiés en salarié, ses citations et ses notes sont maintenant perdus.<p>";
        header("Refresh:2,url='./index.php?page=3'");
      }

      unset($_SESSION['nom']);
      unset($_SESSION['prenom']);
      unset($_SESSION['telephone']);
      unset($_SESSION['mail']);
      unset($_SESSION['login']);
      unset($_SESSION['mdp']);
      unset($_SESSION['categorie']);
      unset($_SESSION['fonction']);
      unset($_SESSION['telpro']);
      unset($_SESSION['ancienLogin']);
      unset($_SESSION['ancienTitre']);
      unset($_SESSION['per_num']);

    }


  ?>
