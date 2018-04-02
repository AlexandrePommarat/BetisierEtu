
<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);
$etudiantManager=new EtudiantManager($db);
$divisionManager=new DivisionManager($db);
$divisions= $divisionManager->getAllDivisions();
$salarieManager=new SalarieManager($db);
$departementManager= new DepartementManager($db);
$departements= $departementManager->getAllDepartements();


if(empty($_POST['annee']) || empty($_POST['departement'])){
  ?><h1>Ajouter un étudiant</h1>
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
    }
    else{
      $_SESSION['departement']=$_POST['departement'];
      $_SESSION['annee']=$_POST['annee'];
      if(isset($_SESSION['departement']) && isset($_SESSION['annee'])){
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
      $per_num=$db->lastInsertId();
      $etudiant= new Etudiant(
        array(
          'per_num' => $per_num,
          'dep_num' => $_SESSION['departement'],
          'div_num' => $_SESSION['annee']

      ));
      $ajoutEtudiant=$etudiantManager->addEtudiant($etudiant);
      echo "<p><img src='./image/valid.png' alt='Image validation'> <strong> L'étudiant a été ajouté !</strong><p>";
      unset($_SESSION['nom']);
			unset($_SESSION['prenom']);
			unset($_SESSION['telephone']);
			unset($_SESSION['mail']);
      unset($_SESSION['login']);
			unset($_SESSION['mdp']);
			unset($_SESSION['categorie']);
      unset($_SESSION['departement']);
      unset($_SESSION['annee']);

    }
    else{
      echo "<p><img src='./image/erreur.png' alt='Image erreur'><strong>  Le salarié n'a pas été ajouté</strong> <p>";
    }
  }
