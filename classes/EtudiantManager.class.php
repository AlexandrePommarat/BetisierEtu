<?php
class EtudiantManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  /*
  * Cette fonction permet de déterminer si une personne est un étudiant ou non
  */
  public function EstUnEtudiant($id){
      $sql="SELECT e.per_num FROM personne p INNER JOIN etudiant e on e.per_num=p.per_num WHERE e.per_num=$id";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      $etudiant = $requete->fetch(PDO::FETCH_OBJ);
      return $etudiant;
  }

  /*
  * Permet de retourner un département par rapport à son ID
  */
  public function getDepartementById($id){
    $sql="SELECT dep_nom FROM departement d INNER JOIN etudiant e on e.dep_num=d.dep_num where per_num=$id";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $departement = $requete->fetch(PDO::FETCH_OBJ);
    return $departement->dep_nom;
  }

  /*
  * Permet l'ajout d'un étudiant
  */
  public function addEtudiant($etudiant){

        $sql="INSERT INTO etudiant (per_num,dep_num,div_num) VALUES ( :per_num,:dep_num,:div_num)";

        $requete = $this->db->prepare($sql);

        $requete->bindValue(':per_num',$etudiant->getPerNum());
        $requete->bindValue(':dep_num',$etudiant->getDepNum());
        $requete->bindValue(':div_num',$etudiant->getDivNum());
        $requete->execute();

      }

  /*
  * Permet de retourner un Etudiant par rapport à son Département
  */
  public function getEtudiantByDep($dep_num){
    $sql="SELECT per_num FROM etudiant WHERE '".$dep_num."'=dep_num";

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

  /*
  * Permet d'écraser un étudiant par rapport à son ID
  */
  public function deleteEtudiantById($numero){
    $sql="DELETE FROM etudiant
    where per_num=$numero";
    $req = $this->db->prepare($sql);
    $req->execute();
  }

  /*
  * Permet de mettre à jour un étudiant
  */
  public function updateEtudiant($per_num, $dep_num,$div_num){
    $sql="UPDATE etudiant
          set per_num='".$per_num."',
           dep_num='".$dep_num."',
           div_num='".$div_num."'
          where per_num=$per_num";


    $requete = $this->db->prepare($sql);
    $requete->execute();
  }
}
