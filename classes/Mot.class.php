<?php
class Mot {
  private $mot_id;
  private $mot_interdit;


  public function __construct($valeurs = array()){
    if (!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'mot_id': $this->setMotId($valeur);
            break;
        case 'mot_interdit': $this->setMotId($valeur);
            break;
      }
    }
  }

  public function getMotId(){
    return $this->mot_id;
  }
  public function setMonId($mot_id){
    $this->mot_id = $mot_id;
  }
  public function getMotInterdit(){
    return $this->mot_interdit;
  }
  public function setMotInterdit($mot_interdit){
    $this->mon_interdit = $mon_interdit;
  }
}
?>
