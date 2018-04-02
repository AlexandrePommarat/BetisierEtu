<?php
class SalarieManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }



  //permet de renvoyer le numero du professeur ainsi que le numero de sa fonction à partir de son id de personne
  public function getTelProfFonNumById($id){
      $sql="SELECT sal_telprof, fon_num FROM salarie WHERE per_num=$id";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      $salarie = $requete->fetch(PDO::FETCH_OBJ);
      $infosalarie=new Salarie($salarie);

       $requete-> closeCursor();
       return $infosalarie;
  }

  //permet de récupérer le numéro des professeurs
  public function getPerNumProf(){
    $listeSalarie=array();
    $sql="SELECT per_num FROM salarie WHERE fon_num=7";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($salarie = $requete->fetch(PDO::FETCH_OBJ)){
      $listeSalarie[]=new Personne($salarie);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return  $listeSalarie;
  }

  public function getFonctionById($id){
    $sql="SELECT fon_libelle FROM fonction WHERE fon_num=$id";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $fonction = $requete->fetch(PDO::FETCH_OBJ);

     return $fonction->fon_libelle;
  }

  /*
  * Permet l'ajoute d'un salarié
  */
  public function addSalarie($salarie){

        $sql="INSERT INTO salarie (per_num,sal_telprof,fon_num) VALUES ( :per_num,:sal_telprof,:fon_num)";

        $requete = $this->db->prepare($sql);

        $requete->bindValue(':per_num',$salarie->getPerNum());
        $requete->bindValue(':sal_telprof',$salarie->getSalTelProf());
        $requete->bindValue(':fon_num',$salarie->getFonNum());
        $requete->execute();

      }

  /*
  * Efface un salarié par rapport à son identifiant
  */
  public function deleteSalarieBySalNum($sal_num){
    $sql="DELETE FROM salarie
          where per_num=$sal_num";

    $req = $this->db->prepare($sql);
    $req->execute();
  }

  /*
  * Permet de mettre à jour un salarié
  */
  public function updateSalarie($per_num, $sal_telprof,$fon_num){
    $sql="UPDATE salarie
          set sal_telprof='".$sal_telprof."',
           fon_num='".$fon_num."'
          where per_num=$per_num";


    $requete = $this->db->prepare($sql);
    $requete->execute();
  }
}
