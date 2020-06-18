<?php
class specialite{
 
    // database connection and table name
    private $conn;
    private $table_name = "specialite";
 
    // object properties
    public $id_specialite;
    public $nom_specialite;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_specialite,nom_specialite FROM `specialite`";
 
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
					id_specialite=:id_specialite,
					nom_specialite=:nom_specialite";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":id_specialite", $this->id_specialite);
		$stmt->bindParam(":nom_specialite", $this->nom_specialite);
 
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
					nom_specialite=:nom_specialite
				WHERE
					id_specialite = :id_specialite";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
		$this->nom_specialite=htmlspecialchars(strip_tags($this->nom_specialite));
 
		// bind values
		$stmt->bindParam(":id_specialite", $this->id_specialite);
		$stmt->bindParam(":nom_specialite", $this->nom_specialite);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_specialite = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_specialite=htmlspecialchars(strip_tags($this->id_specialite));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_specialite);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_specialite,nom_specialite FROM `specialite` WHERE id_specialite = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_specialite);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_specialite = $row['id_specialite'];
		$this->nom_specialite = $row['nom_specialite'];
	}
}
?>