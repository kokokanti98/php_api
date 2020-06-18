<?php
class Rapport{
 
    // database connection and table name
    private $conn;
    private $table_name = "rapport_visite";
 
    // object properties
    public $id_rapport;
    public $numero_praticien;
    public $date_rapport;
    public $bilan;
    public $motif;
    public $nom;
    public $prenom;
	public $nom_commercial;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_rapport,nom,prenom,date_rapport,motif,bilan,nom_commercial FROM echantillon 
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
					numero_praticien=:numero_praticien, 
					date_rapport=:date_rapport, 
					bilan=:bilan, 
					motif=:motif";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":numero_praticien", $this->numero_praticien);
		$stmt->bindParam(":date_rapport", $this->date_rapport);
		$stmt->bindParam(":bilan", $this->bilan);
		$stmt->bindParam(":motif", $this->motif);
 
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
					id_rapport=:id_rapport, 
					numero_praticien=:numero_praticien, 
					date_rapport=:date_rapport, 
					bilan=:bilan, 
					motif=:motif
				WHERE
					id_rapport = :id_rapport";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_rapport=htmlspecialchars(strip_tags($this->id_rapport));
		$this->numero_praticien=htmlspecialchars(strip_tags($this->numero_praticien));
		$this->date_rapport=htmlspecialchars(strip_tags($this->date_rapport));
		$this->bilan=htmlspecialchars(strip_tags($this->bilan));
		$this->motif=htmlspecialchars(strip_tags($this->motif));
 
		// bind values
		$stmt->bindParam(":id_rapport", $this->id_rapport);
		$stmt->bindParam(":numero_praticien", $this->numero_praticien);
		$stmt->bindParam(":date_rapport", $this->date_rapport);
		$stmt->bindParam(":bilan", $this->bilan);
		$stmt->bindParam(":motif", $this->motif);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_rapport = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_rapport=htmlspecialchars(strip_tags($this->id_rapport));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_rapport);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// used when filling up the update chat form
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_rapport,nom,prenom,date_rapport,motif,bilan FROM echantillon 
		JOIN medicament ON echantillon.num_medicament = medicament.id_medicament 
		LEFT JOIN employe ON echantillon.num_praticien = employe.idEmploye 
		LEFT JOIN rapport_visite ON echantillon.num_rapport = rapport_visite.id_rapport WHERE id_rapport = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_rapport);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_rapport = $row['id_rapport'];
		$this->nom = $row['nom'];
		$this->prenom = $row['prenom'];
		$this->date_rapport = $row['date_rapport'];
		$this->motif = $row['motif'];
		$this->bilan = $row['bilan'];
	}
	public function voir_tous_echantillon_rapport(){
        //select all data
        $query = "SELECT id_rapport,nom,prenom,date_rapport,motif,bilan,nom_commercial,qte_offerte FROM echantillon 
		JOIN medicament ON echantillon.num_medicament = medicament.id_medicament 
		LEFT JOIN employe ON echantillon.num_praticien = employe.idEmploye 
		LEFT JOIN rapport_visite ON echantillon.num_rapport = rapport_visite.id_rapport WHERE id_rapport = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_rapport);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
 
        return $stmt;
    }
		public function voir_tous_pra_rapport(){
        //select all data
        $query = "SELECT id_rapport,nom,prenom,date_rapport,motif,bilan,nom_commercial,qte_offerte,numero_praticien FROM echantillon 
		JOIN medicament ON echantillon.num_medicament = medicament.id_medicament 
		LEFT JOIN employe ON echantillon.num_praticien = employe.idEmploye 
		LEFT JOIN rapport_visite ON echantillon.num_rapport = rapport_visite.id_rapport WHERE numero_praticien = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->numero_praticien);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
 var_dump($query);
        return $stmt;
    }
}
?>