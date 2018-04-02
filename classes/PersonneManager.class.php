<?php
class PersonneManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  //ressort le nom et le prénom par rapport à l'id mis en parametre
  public function getNomPreById($id){

    $sql="SELECT per_nom, per_prenom FROM personne WHERE per_num=$id";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $personne = $requete->fetch(PDO::FETCH_OBJ);
    $NomPrenom=new Personne($personne);


    $requete-> closeCursor();
    return $NomPrenom;
  }

  //Cette fonction permet de ressortir le mail et le numero de telephone d'une personne par rapport à son id
  public function getMailTelById($id){
    $sql="SELECT per_mail,per_tel FROM personne WHERE per_num=$id";
    $requete = $this->db->prepare($sql);
    $requete->execute();

    $personne = $requete->fetch(PDO::FETCH_OBJ);
    $MailTel=new Personne($personne);

    $requete-> closeCursor();
    return  $MailTel;
  }

  //ressort tout les prénoms nom et id de la base personne
  public function getPreNomId(){
    $listePersonnes=array();
    $sql="SELECT per_num, per_nom, per_prenom FROM personne";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($personne = $requete->fetch(PDO::FETCH_OBJ)){
      $listePersonnes[]=new Personne($personne);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return  $listePersonnes;
  }

  public function getNbrePersonne(){

    $sql="SELECT COUNT(*) as nb_personne FROM personne";

    $requete = $this->db->query($sql);
    $ligne=$requete->FETCH(PDO::FETCH_OBJ);

    return $ligne->nb_personne; // ligne est le tableau renvoyer par sql. on selectionne la colonne que l'on a appele nb_personne dans la requete

  }

  //cette fonction permet de vérifier si le login et le mot de passe sont présent dans la base
  public function verifLoginMdp($login, $pwd){
    $sql="SELECT per_login, per_pwd FROM personne WHERE '".$login."'=per_login AND '".$pwd."'=per_pwd";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $resultat = $requete->fetch();

    if(empty($resultat)){
      return false;
    }
    else{
      return true;
    }
  }


  //Cette fonction permet de retourner si le login saisie pour ajouter une perosnne existe déja
  public function getLoginExistant($id){
    $sql="SELECT COUNT(*) as nb_login FROM personne where per_login='".$id."'";

    $requete = $this->db->query($sql);
    $ligne=$requete->FETCH(PDO::FETCH_OBJ);

    return $ligne->nb_login;

  }

  public function getIdByLogin($login){
    $sql="SELECT per_num FROM personne where per_login='".$login."'";

    $requete = $this->db->query($sql);
    $ligne=$requete->FETCH(PDO::FETCH_OBJ);

    return $ligne->per_num;

  }


  //Cette fonction permet d'ajouter une personne à la base
  public function addPersonne($personne){
      $sql="INSERT INTO personne (per_nom,per_prenom,per_tel,per_mail,per_admin,per_login,per_pwd) VALUES ( :per_nom,:per_prenom,:per_tel,:per_mail,:per_admin,:per_login,:per_pwd )";
      $requete = $this->db->prepare($sql);
      $requete->bindValue(':per_nom',$personne->getPerNom());
      $requete->bindValue(':per_prenom',$personne->getPerPrenom());
      $requete->bindValue(':per_tel',$personne->getPerTel());
      $requete->bindValue(':per_mail',$personne->getPerMail());
      $requete->bindValue(':per_admin',0);
      $requete->bindValue(':per_login',$personne->getPerLogin());
      $requete->bindValue(':per_pwd',$personne->getPerPwd());
      $requete->execute();

    }

    //nécessaire dans la page ajoutercitation
    public function getPerNomByNum($id){
      $sql="SELECT per_nom FROM personne WHERE per_num=$id";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      $pernom = $requete->fetch(PDO::FETCH_OBJ);

       return $pernom->per_nom;
    }
    //permet de définir si la personne est un admin
    public function estAdmin($login){
        $sql="SELECT per_num as estAdmin FROM personne WHERE per_login='".$login."' AND per_admin=1";

        $requete = $this->db->prepare($sql);
        $requete->execute();

        $admin = $requete->fetch(PDO::FETCH_OBJ);
        if(empty($admin)){
          return false;
        }
        else{
          return true;
        }
    }

    /**
    * Permet de retourner toutes les personnes de la base sauf celle qui est connecté
    */
    public function getAllPersSaufConnecte($login){
      $listePersonnes=array();
      $sql="SELECT per_num, per_nom, per_prenom FROM personne WHERE per_login!='".$login."'";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while($personne = $requete->fetch(PDO::FETCH_OBJ)){
        $listePersonnes[]=new Personne($personne);
      } //création nouvelle instance de produit -> $produits---> $valeurs

      $requete-> closeCursor();
      return  $listePersonnes;
    }

    /*
    * Permet de détruire une personne par rapport à son ID
    */
    public function deletePersonneById($numero){
      $sql="DELETE FROM personne
      where per_num=$numero";
      $req = $this->db->prepare($sql);
      $req->execute();
    }

    /*
    *  Permet de retourner une personne par rapport à son id
    */
    public function getPersonneByNum($per_num){
      $sql="SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login FROM personne
            where per_num=$per_num";
      $requete = $this->db->prepare($sql);
      $requete->execute();

      $ligne=$requete->FETCH(PDO::FETCH_OBJ);
      return  $ligne;
    }

    /*
    * Permet de mettre à jour une personne
    */
    public function updatePersonne($per_num, $per_nom, $per_prenom, $per_tel, $per_mail, $per_login, $per_mdp){
      $sql="UPDATE personne
            set per_nom='".$per_nom."',
             per_prenom='".$per_prenom."',
             per_tel='".$per_tel."',
             per_mail='".$per_mail."',
             per_login='".$per_login."',
             per_pwd='".$per_mdp."'
            where per_num='".$per_num."'";
      $requete = $this->db->prepare($sql);
      $requete->execute();
    }

  }
