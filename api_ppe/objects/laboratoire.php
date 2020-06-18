<?php
class Laboratoire{
 
    // database connection and table name
    private $conn;
    private $table_name = "laboratoire";
 
    // object properties
    public $id_labo;
    public $nom_labo;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_labo,nom_labo FROM `laboratoire`";
 
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
					id_labo=:id_labo,
					nom_labo=:nom_labo";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":id_labo", $this->id_labo);
		$stmt->bindParam(":nom_labo", $this->nom_labo);
 
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
					nom_labo=:nom_labo
				WHERE
					id_labo = :id_labo";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_labo=htmlspecialchars(strip_tags($this->id_labo));
		$this->nom_labo=htmlspecialchars(strip_tags($this->nom_labo));
 
		// bind values
		$stmt->bindParam(":id_labo", $this->id_labo);
		$stmt->bindParam(":nom_labo", $this->nom_labo);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_labo = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_labo=htmlspecialchars(strip_tags($this->id_labo));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_labo);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_labo,nom_labo FROM `laboratoire` WHERE id_labo = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_labo);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_labo = $row['id_labo'];
		$this->nom_labo = $row['nom_labo'];
	}
}
?>