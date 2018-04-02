<?php
  $db=new Mypdo();
  $numero = htmlspecialchars($_GET['num']);
  $EtudiantManager=new EtudiantManager($db);
  $EstEtudiant=$EtudiantManager->EstUnEtudiant($numero);
  $PersonneManager=new PersonneManager($db);
  $VilleManager=new VilleManager($db);
  $SalarieManager=new SalarieManager($db);
  $FonNumTelSalarie=$SalarieManager->getTelProfFonNumById($numero);


  if($EstEtudiant){
    ?>
    <div class "titre"><h1>Détail sur l'étudiant <?php echo $PersonneManager->getNomPreById($numero)->getPerNom(); ?></h1></div>

    <table border=1>
    	<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>
        <tr>
    			<td><?php echo $PersonneManager->getNomPreById($numero)->getPerPrenom();?></a></td>
    			<td><?php echo $PersonneManager->getMailTelById($numero)->getPerMail();?></td>
    			<td><?php echo $PersonneManager->getMailTelById($numero)->getPerTel();?></td>
          <td><?php echo $EtudiantManager->getDepartementById($numero);?></td>
          <td><?php echo $VilleManager->getVilNomByIdPers($numero);?></td>
    		</tr>
    	</table>

  <?php
  }
  else{
  ?>
    <div class "titre"><h1>Détail sur le salarié <?php echo $PersonneManager->getNomPreById($numero)->getPerNom(); ?></h1></div>
    <table border=1>
      <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>
        <tr>
          <td><?php echo $PersonneManager->getNomPreById($numero)->getPerPrenom();?></a></td>
          <td><?php echo $PersonneManager->getMailTelById($numero)->getPerMail();?></td>
          <td><?php echo $PersonneManager->getMailTelById($numero)->getPerTel();?></td>
          <td><?php echo $FonNumTelSalarie->getSalTelProf();?></td>
          <td><?php echo $SalarieManager->getFonctionById($FonNumTelSalarie->getFonNum());?></td>
        </tr>
      </table>
  <?php
  }
  ?>
