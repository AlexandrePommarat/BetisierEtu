<?php
class Citation {
  private $cit_num;
  private $cit_lib;
  private $per_num;
  private $per_num_valide;
  private $per_num_etu;
  private $cit_libelle;
  private $cit_date;
  private $cit_valide;
  private $cit_date_depo;



  public function __construct($valeurs = array()){
    if (!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'cit_num': $this->setCitNum($valeur);
            break;
        case 'cit_lib': $this->setCitNom($valeur);
            break;
        case 'per_num': $this->setPerNum($valeur);
            break;
        case 'per_num_val': $this->setPerNumVal($valeur);
            break;
        case 'per_num_etu': $this->setPerNumEtu($valeur);
            break;
        case 'cit_libelle': $this->setCitLib($valeur);
            break;
        case 'cit_date': $this->setCitDate($valeur);
            break;
        case 'cit_valide':$this->setCitValide($valeur);
            break;
        case 'cit_date_depo':$this->setCitDateDepo($valeur);
            break;
      }
    }
  }

  public function getCitLib(){
    return $this->cit_lib;
  }
  public function setCitLib($cit_lib){
    $this->cit_lib = $cit_lib;
  }
  public function getCitNum(){
    return $this->cit_num;
  }
  public function setCitNum($cit_num){
    $this->cit_num = $cit_num;
  }
  public function getPerNum(){
    return $this->per_num;
  }
  public function setPerNum($per_num){
    $this->per_num = $per_num;
  }
  public function getPerNumVal(){
    return $this->per_num_valide;
  }
  public function setPerNumVal($per_num_valide){
    $this->per_num_valide = $per_num_valide;
  }
  public function getPerNumEtu(){
    return $this->per_num_etu;
  }
  public function setPerNumEtu($per_num_etu){
    $this->per_num_etu = $per_num_etu;
  }
  public function getCitDate(){
    return $this->cit_date;
  }
  public function setCitDate($cit_date){
    $this->cit_date = $cit_date;
  }
  public function getCitValide(){
    return $this->cit_valide;
  }
  public function setCitValide($cit_valide){
    $this->cit_valide = $cit_valide;
  }
  public function getCitDateDepo(){
    return $this->cit_date_depo;
  }
  public function setCitDateDepo($cit_date_depo){
    $this->cit_date_depo = $cit_date_depo;
  }
}

?>
