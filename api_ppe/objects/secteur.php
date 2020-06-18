<?php
class secteur{
 
    // database connection and table name
    private $conn;
    private $table_name = "secteur";
 
    // object properties
    public $id_secteur;
    public $nom_secteur;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_secteur,nom_secteur FROM `secteur`";
 
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
					id_secteur=:id_secteur,
					nom_secteur=:nom_secteur";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":id_secteur", $this->id_secteur);
		$stmt->bindParam(":nom_secteur", $this->nom_secteur);
 
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
					nom_secteur=:nom_secteur
				WHERE
					id_secteur = :id_secteur";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_secteur=htmlspecialchars(strip_tags($this->id_secteur));
		$this->nom_secteur=htmlspecialchars(strip_tags($this->nom_secteur));
 
		// bind values
		$stmt->bindParam(":id_secteur", $this->id_secteur);
		$stmt->bindParam(":nom_secteur", $this->nom_secteur);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_secteur = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_secteur=htmlspecialchars(strip_tags($this->id_secteur));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_secteur);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_secteur,nom_secteur FROM `secteur` WHERE id_secteur = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_secteur);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_secteur = $row['id_secteur'];
		$this->nom_secteur = $row['nom_secteur'];
	}
}
?>