<?php
class DivisionManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  /**
  *Cette fonction permet de retourner tout les libellé des différentes fonctions que peut avoir un salarié
  */
  public function getAllDivisions(){
    $listeDivision = array(); //tableau d'objets

    $sql = 'SELECT div_num, div_nom FROM division';

    $requete = $this->db->prepare($sql);
    $requete->execute();


    while($division = $requete->fetch(PDO::FETCH_OBJ)){
      $listeDivision[]=new Division($division);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return $listeDivision;
  }
}
