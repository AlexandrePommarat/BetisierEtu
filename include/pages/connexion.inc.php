<?php
$db=new Mypdo();
$personneManager=new PersonneManager($db);


if(empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['captcha'])){
  ?><h1>Pour vous connecter</h1>
  <?php
  if(isset($_SESSION['mauvaiscaptcha']))
  echo "<p><img src='./image/erreur.png' alt='Image erreur'>  Le captcha saisie est incorrect<p>";
  unset($_SESSION['mauvaiscaptcha']);
  if(isset($_SESSION['echec']))
  echo "<p><img src='./image/erreur.png' alt='Image erreur'>  Le login ou le mot de passe est incorrect<p>";
  ?>
  <table class="centrerBlock">
    <form method="post" action="#">
      <tr>
        <td><strong>Nom d'utilisateur:</strong></td>
        <td><input type="text" class="champ" name="login" required /></td>
      </tr>
      <tr>
        <td><strong>Mot de Passe:</strong></td>
        <td><input type="password" class="champ" name="mdp" required /></td>
      </tr>
      <tr>
        <td><strong>
          <?php
          $chiffre1= rand(1,9);
          $chiffre2= rand(1,9);
          $_SESSION['chiffre1']= $chiffre1;
          $_SESSION['chiffre2']= $chiffre2;


          echo "<img src=\"./image/nb/$chiffre1.jpg\" alt='Nombre 1'> + <img src=\"./image/nb/$chiffre2.jpg\" alt='Nombre 2'>=";
          ?>
        </strong></td>
        <td><input type="text" class="champ" name="captcha" /></td>
      </tr>
    </table>
    <td><input type="submit" class="bouton" value="Valider" /></td>
    <?php
  }else{
    $resultat=$_SESSION['chiffre1']+$_SESSION['chiffre2'];
    unset($_SESSION['chiffre1']);
    unset($_SESSION['chiffre2']);
    $_SESSION['captcha']=$_POST['captcha'];
    $salt = "48@!alsd";
    $password = $_POST['mdp'];
    $passwordMD5 = md5(md5($password).$salt);
    if($resultat==$_POST['captcha']){
      if($personneManager->verifLoginMdp($_POST['login'],$passwordMD5)){
        $_SESSION['userconnecte']=$_POST['login'];
        $_SESSION['admin']=$personneManager->estAdmin($_POST['login']);
        echo "<img src='./image/valid.png' alt='Image validation'> Vous avez bien été connecté !<br /><br />";
        echo "Redirection dans 2 secondes.";
        header("Refresh:2,url='./index.php?page=0'");
        if(isset($_SESSION['echec'])){
          header("Refresh:2,url='./index.php?page=0'");
          unset($_SESSION['echec']);

        }

      }
      else{
        $_SESSION['echec']=true;
        header("Refresh:0,url='./index.php?page=9'");
      }
    }
    else{
      $_SESSION['mauvaiscaptcha']=1;
      header("Refresh:0,url='./index.php?page=9'");
    }
  }
