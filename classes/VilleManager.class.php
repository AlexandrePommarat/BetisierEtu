<?php
class VilleManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  //permet de retourner le nom de la ville de l'etudiant à partir de son numéro
  public function getVilNomByIdPers($id){
    $sql="SELECT vil_nom FROM ville v
    INNER JOIN departement d On v.vil_num=d.vil_num
    INNER JOIN etudiant e ON e.dep_num=d.dep_num
    WHERE per_num=$id";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $ville = $requete->fetch(PDO::FETCH_OBJ);
    return $ville->vil_nom;
  }

  /*
  * Retourne toutes les villes présentes dans la base
  */
  public function getAllVilles(){
    $listeVilles = array(); //tableau d'objets

    $sql = 'SELECT vil_num, vil_nom FROM ville';

    $requete = $this->db->prepare($sql);
    $requete->execute();


    while($ville = $requete->fetch(PDO::FETCH_OBJ)){
      $listeVilles[]=new Ville($ville);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return $listeVilles;
  }

  /*
  * Permet l'ajout d'une ville
  */
  public function addVille($ville){
    $vil_nom=$ville->getVilNom();
    $sql="SELECT vil_nom FROM ville WHERE vil_nom='".$vil_nom."'";
    $req = $this->db->prepare($sql);
    $req->execute();

    $resultat = $req->fetch();
    if(empty($resultat)){
      $sql="INSERT INTO ville (vil_nom) VALUES ( :vil_nom )";

      $requete = $this->db->prepare($sql);
      $requete->bindValue(':vil_nom',$vil_nom);
      $requete->execute();
      return true;

    }
    else{
      return false;
    }
  }

    /*
    *  Permet la suppression d'une ville
    */
    public function deleteVille($ville){
      $sql="DELETE FROM ville where vil_num=$ville";

      $req = $this->db->prepare($sql);
      $req->execute();

    }
}

?>
