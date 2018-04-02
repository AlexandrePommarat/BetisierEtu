<?php
class DepartementManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }
  /**
  * Retourne tout les départements
  */
  public function getAllDepartements(){
    $listeDepartement = array(); //tableau d'objets

    $sql = 'SELECT dep_num, dep_nom, vil_num FROM departement';

    $requete = $this->db->prepare($sql);
    $requete->execute();


    while($departement = $requete->fetch(PDO::FETCH_OBJ)){
      $listeDepartement[]=new Departement($departement);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return $listeDepartement;
  }

  /*
  * Permet de retourner des départements appartenant à une ville précise
  */
  public function getDepNumByVilNum($vil_num){
    $listeDepartement = array();
    $sql="SELECT dep_num from departement where vil_num=$vil_num";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($departement = $requete->fetch(PDO::FETCH_OBJ)){
      $listeDepartement[]=new Departement($departement);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return $listeDepartement;

  }
}
