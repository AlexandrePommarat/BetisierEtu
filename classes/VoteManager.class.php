<?php
class VoteManager{
  private $db;
    public function __construct($db){
      $this->db = $db;//recupere la connexion
    }

//cette fonction permet de vérifier si une citation a déja était noté par un étudiant
public function verifVoteCitation($per_num, $cit_num){
  $sql="SELECT per_num, cit_num FROM vote WHERE '".$per_num."'=per_num AND '".$cit_num."'=cit_num";

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
* Permet l'ajout d'un vote
*/
public function addVote($vote){

      $sql="INSERT INTO vote (cit_num,per_num,vot_valeur) VALUES ( :cit_num,:per_num,:vot_valeur)";

      $requete = $this->db->prepare($sql);

      $requete->bindValue(':cit_num',$vote->getCitNum());
      $requete->bindValue(':per_num',$vote->getPerNum());
      $requete->bindValue(':vot_valeur',$vote->getVotVal());
      $requete->execute();

    }

    /**
    * Permet de retirer tout les votes d'un étudiant
    */
    public function deleteVoteByEtuId($numero){
      $sql="DELETE FROM vote
      where per_num=$numero";
      $req = $this->db->prepare($sql);
      $req->execute();
    }

    /*
    * Permet de retirer tout les votes d'une citation
    */
    public function deleteVoteByCitId($citnum){

      $sql="DELETE FROM vote
      where cit_num=$citnum";
      $req = $this->db->prepare($sql);
      $req->execute();
    }

}
