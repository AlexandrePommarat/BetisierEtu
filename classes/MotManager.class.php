<?php
class MotManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  /**
  * Permet de déterminer si un mot est interdit ou non
  */
  public function estInterdit($mot){

    $sql = "SELECT mot_interdit from mot where mot_interdit='".$mot."'";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $interdit = $requete->fetch(PDO::FETCH_OBJ);
    if(empty($interdit)){
      return false;
    }
    else{
      return true;
    }
}
  }
