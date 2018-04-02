<?php
class FonctionManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  /**
  *Cette fonction permet de retourner tout les libellé des différentes fonctions que peut avoir un salarié
  */
  public function getAllFonction(){
    $listeFonction = array(); //tableau d'objets

    $sql = 'SELECT fon_num, fon_libelle FROM fonction';

    $requete = $this->db->prepare($sql);
    $requete->execute();


    while($fonction = $requete->fetch(PDO::FETCH_OBJ)){
      $listeFonction[]=new Fonction($fonction);
    } 

    $requete-> closeCursor();
    return $listeFonction;
  }

}
