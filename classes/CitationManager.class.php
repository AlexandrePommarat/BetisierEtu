<?php
class CitationManager{
  private $db;
  public function __construct($db){
    $this->db = $db;//recupere la connexion
  }

  /**
  * Permet de retourner toutes les citations de la base
  */
  public function getAllCitations(){
    $listeCitations=array();

    $sql='SELECT cit_num, per_num, cit_libelle, cit_date FROM citation c
    WHERE cit_valide=1 and cit_date_valide IS NOT NULL
    ORDER BY cit_date desc';

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($citation = $requete->fetch(PDO::FETCH_OBJ)){
      $listeCitations[]=new Citation($citation);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return  $listeCitations;
  }
  /**
  * cette fonction permet de retourner la moyenne d'une citation à partir de son identifiant
  */
  public function getMoyenneByIdCit($id){


    $sql="SELECT round(AVG(vot_valeur),2) as vot_val FROM vote
    WHERE cit_num=$id"; // le "vot_val" va servir pour le return

    $requete = $this->db->prepare($sql);
    $requete->execute();

    $vote = $requete->fetch(PDO::FETCH_OBJ);
    return $vote->vot_val;//vote est le tableau renvoyé par sql. On selectionne alros la colonne que l'on a appellé vot_val dans la requete.

  }

  /*
  * Retourne le nombre de citations qui sont validé par admin
  */
  public function getNbreCitationValide(){

    $sql="SELECT COUNT(*) as nb_citations FROM citation c
    WHERE cit_valide=1 and cit_date_valide IS NOT NULL";

    $requete = $this->db->query($sql);
    $ligne=$requete->FETCH(PDO::FETCH_OBJ);

    return $ligne->nb_citations; // ligne est le tableau renvoyer par sql. on selectionne la colonne que l'on a appele nb_citations dans la requete

  }

  /*
  * Retourne le nombre de citations en attende de validation
  */
  public function getNbreCitationEnAttente(){

    $sql="SELECT COUNT(*) as nb_citations FROM citation c
    WHERE cit_valide=0 and cit_date_valide IS NULL";

    $requete = $this->db->query($sql);
    $ligne=$requete->FETCH(PDO::FETCH_OBJ);

    return $ligne->nb_citations; // ligne est le tableau renvoyer par sql. on selectionne la colonne que l'on a appele nb_citations dans la requete

  }
  /*
  * Retourne les citations en attente
  */
  public function getCitationEnAttente(){
    $listeCitations=array();

    $sql='SELECT cit_num, per_num, cit_libelle, cit_date FROM citation c
    WHERE cit_valide=0 AND cit_date_valide IS NULL
    ORDER BY cit_date desc';

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($citation = $requete->fetch(PDO::FETCH_OBJ)){
      $listeCitations[]=new Citation($citation);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return  $listeCitations;
  }

  /*
  * Permet de vailder une citation
  */
  public function validerCitations($numero,$date){
    $sql="UPDATE citation
        SET cit_date_valide='".$date."' , cit_valide=1
        WHERE $numero=cit_num";

    $requete = $this->db->prepare($sql);
    $requete->execute();

  }
  /*
  * Permet l'ajout d'une citation
  */
  public function ajouterCitation($per_num,$per_num_valide,$per_num_etu,$cit_libelle,$cit_date,$cit_valide,$cit_date_valide,$cit_date_depo){
    $sql="INSERT INTO citation (per_num,per_num_valide,per_num_etu,cit_libelle,cit_date,cit_valide,cit_date_valide,cit_date_depo)
    VALUES ( :per_num,:per_num_valide,:per_num_etu,:cit_libelle,:cit_date,:cit_valide,:cit_date_valide,:cit_date_depo )";

    $requete = $this->db->prepare($sql);
    $requete->bindValue(':per_num',$per_num);
    $requete->bindValue(':per_num_valide',$per_num_valide);
    $requete->bindValue(':per_num_etu',$per_num_etu);
    $requete->bindValue(':cit_libelle',$cit_libelle);
    $requete->bindValue(':cit_date',$cit_date);
    $requete->bindValue(':cit_valide',$cit_valide);
    $requete->bindValue(':cit_date_valide',$cit_date_valide);
    $requete->bindValue(':cit_date_depo',$cit_date_depo);
    $requete->execute();
  }

  /*
  * Permet d'écraser une citation par rapport à son numéro
  */
  public function deleteCitationByCitNum($numero){
    $sql="DELETE FROM citation
    where cit_num=$numero";
    $req = $this->db->prepare($sql);
    $req->execute();
  }

  /*
  * Permet d'écraser toutes les citations qu'un étudiant précis a déposé
  */
  public function deleteCitationByEtuId($numero){
    $sql="DELETE FROM citation
    where per_num_etu=$numero";
    $req = $this->db->prepare($sql);
    $req->execute();
  }

  /*
  * Permet d'ecraser toutes les citations d'un salarié
  */
  public function deleteCitationBySalNum($numero){
    $sql="DELETE FROM citation
    where per_num=$numero";
    $req = $this->db->prepare($sql);
    $req->execute();
  }

  /**
  * Permet de retourner les numéros de citations d'un salarié
  */
  public function getCitNumBySalNum($sal_num){
    $listeCitations=array();
    $sql="SELECT cit_num FROM citation
    where per_num=$sal_num";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($citation = $requete->fetch(PDO::FETCH_OBJ)){
      $listeCitations[]=new Citation($citation);
    } //création nouvelle instance de produit -> $produits---> $valeurs

    $requete-> closeCursor();
    return  $listeCitations;
  }

}
