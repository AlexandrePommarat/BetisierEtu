<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$fonctionManager=new FonctionManager($db);
$fonctions= $fonctionManager->getAllFonction();
$salarieManager=new SalarieManager($db);
$voteManager= new VoteManager($db);
$etudiantManager= new EtudiantManager($db);
$citationManager = new CitationManager($db);
$divisionManager=new DivisionManager($db);
$divisions= $divisionManager->getAllDivisions();
$departementManager= new DepartementManager($db);
$departements= $departementManager->getAllDepartements();

if(empty($_POST['annee']) || empty($_POST['departement'])){
  ?><h1>Modifier un étudiant</h1>
  <table class="centrerBlock">
    <form method="post" action="#">
      <tr>

        <td><strong>Année:</strong></td>
        <td><select class="champ" name="annee" size="1">
          <?php

          foreach($divisions as $division){
            ?>
            <option  value=<?php echo $division->getDivNum(); ?>><?php echo $division->getDivNom();?></option>

              <?php
            }
            ?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Département:</strong></td>
        <td><select class="champ" name="departement" size="1">
          <?php

          foreach($departements as $departement){
            ?>
            <option value=<?php echo $departement->getDepNum(); ?>><?php echo $departement->getDepNom();?></option>

              <?php
            }
            ?>
          </select></td>
        </tr>
      </table>
      <td><input type="submit" class="bouton" value="Valider" /></td>
      <?php
    }else{
    $_SESSION['annee']=$_POST['annee'];
    $_SESSION['departement']=$_POST['departement'];
    if($_SESSION['ancienTitre']==false){ // si c'était un salarié
      unset($_SESSION['ancienTitre']);
      $personneManager->updatePersonne($_SESSION['per_num'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['telephone'],$_SESSION['mail'],$_SESSION['login'],$_SESSION['mdp']);
      $citations=$citationManager->getCitNumBySalNum($_SESSION['per_num']);
      foreach($citations as $citation){
        $voteManager->deleteVoteByCitId($citation->getCitNum());
        $citationManager->deleteCitationByCitNum($citation->getCitNum());
      }
      $salarieManager->deleteSalarieBySalNum($_SESSION['per_num']);

      $etudiant= new Etudiant(
        array(
          'per_num' => $_SESSION['per_num'],
          'dep_num' => $_SESSION['departement'],
          'div_num' => $_SESSION['annee']

      ));
      $ajoutEtudiant=$etudiantManager->addEtudiant($etudiant);
      echo "<p><img src='./image/valid.png' alt='Image validation'> Le salarié est redevenu un étudiant, et ses informations ont bien été mis à jour.<p>";
      header("Refresh:2,url='./index.php?page=3'");

    }else{ // si c'était un étudiant
      unset($_SESSION['ancienTitre']);
      $etudiantManager->updateEtudiant($_SESSION['per_num'],$_SESSION['departement'],$_SESSION['annee']);
      $personneManager->updatePersonne($_SESSION['per_num'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['telephone'],$_SESSION['mail'],$_SESSION['login'],$_SESSION['mdp']);

        echo "<p><img src='./image/valid.png' alt='Image validation'> Les informations de l'étudiant ont bien été mis à jour.<p>";
        header("Refresh:2,url='./index.php?page=3'");
      }

      unset($_SESSION['nom']);
      unset($_SESSION['prenom']);
      unset($_SESSION['telephone']);
      unset($_SESSION['mail']);
      unset($_SESSION['login']);
      unset($_SESSION['login_existant']);
      unset($_SESSION['mdp']);
      unset($_SESSION['categorie']);
      unset($_SESSION['annee']);
      unset($_SESSION['departement']);
      unset($_SESSION['ancienLogin']);
      unset($_SESSION['ancienTitre']);
      unset($_SESSION['per_num']);

    }


  ?>
