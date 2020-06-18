<?php
class Echantillon{
 
    // database connection and table name
    private $conn;
    private $table_name = "echantillon";
 
    // object properties
    public $id_echantillon;
	public $num_medicament;
    public $num_rapport;
	public $num_praticien;
	public $qte_offerte;
	public $nom;
	public $prenom;
	public $id_rapport;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_echantillon,nom,prenom,num_praticien,id_rapport,nom_commercial,qte_offerte FROM echantillon 
		JOIN medicament ON echantillon.num_medicament = medicament.id_medicament 
		LEFT JOIN employe ON echantillon.num_praticien = employe.idEmploye 
		LEFT JOIN rapport_visite ON echantillon.num_rapport = rapport_visite.id_rapport";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
				//creer un utilisateur
	function creer(){
 

		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					num_medicament=:num_medicament,
					num_rapport=:num_rapport,
					num_praticien=:num_praticien,
					qte_offerte=:qte_offerte";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":num_medicament", $this->num_medicament);
		$stmt->bindParam(":num_rapport", $this->num_rapport);
		$stmt->bindParam(":num_praticien", $this->num_praticien);
		$stmt->bindParam(":qte_offerte", $this->qte_offerte);
 
		// execute query
		if($stmt->execute()){
		    var_dump($query);
			return true;
		}
        var_dump($query);
		return false;    
	}
				//fonction pour mise a jour
	function mise_a_jour(){
 
		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					num_medicament=:num_medicament,
					num_rapport=:num_rapport,
					num_praticien=:num_praticien,
					qte_offerte=:qte_offerte
				WHERE
					id_echantillon = :id_echantillon";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_echantillon=htmlspecialchars(strip_tags($this->id_echantillon));
		$this->num_medicament=htmlspecialchars(strip_tags($this->num_medicament));
		$this->num_rapport=htmlspecialchars(strip_tags($this->num_rapport));
		$this->num_praticien=htmlspecialchars(strip_tags($this->num_praticien));
		$this->qte_offerte=htmlspecialchars(strip_tags($this->qte_offerte));
 
		// bind values
		$stmt->bindParam(":id_echantillon", $this->id_echantillon);
		$stmt->bindParam(":num_medicament", $this->num_medicament);
		$stmt->bindParam(":num_rapport", $this->num_rapport);
		$stmt->bindParam(":num_praticien", $this->num_praticien);
		$stmt->bindParam(":qte_offerte", $this->qte_offerte);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_echantillon = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_echantillon=htmlspecialchars(strip_tags($this->id_echantillon));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_echantillon);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_echantillon,nom,prenom,num_praticien,id_rapport,nom_commercial,qte_offerte FROM echantillon 
		JOIN medicament ON echantillon.num_medicament = medicament.id_medicament 
		LEFT JOIN employe ON echantillon.num_praticien = employe.idEmploye 
		LEFT JOIN rapport_visite ON echantillon.num_rapport = rapport_visite.id_rapport WHERE id_echantillon = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_echantillon);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_echantillon = $row['id_echantillon'];
		$this->nom = $row['nom'];
		$this->prenom = $row['prenom'];
		$this->num_praticien = $row['num_praticien'];
		$this->id_rapport = $row['id_rapport'];
		$this->nom_commercial = $row['nom_commercial'];
		$this->qte_offerte = $row['qte_offerte'];
	}
}
?>