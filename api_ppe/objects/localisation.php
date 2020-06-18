<?php
class Localisation{
 
    // database connection and table name
    private $conn;
    private $table_name = "localisation";
 
    // object properties
    public $idLocalisation;
	public $codePostal;
    public $libelleVille;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT idLocalisation,codePostal,libelleVille FROM `localisation`";
 
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
					idLocalisation=:idLocalisation,
					codePostal=:codePostal,
					libelleVille=:libelleVille";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":idLocalisation", $this->idLocalisation);
		$stmt->bindParam(":codePostal", $this->codePostal);
		$stmt->bindParam(":libelleVille", $this->libelleVille);
 
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
					idLocalisation=:idLocalisation,
					codePostal=:codePostal,
					libelleVille=:libelleVille
				WHERE
					idLocalisation = :idLocalisation";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->idLocalisation=htmlspecialchars(strip_tags($this->idLocalisation));
		$this->codePostal=htmlspecialchars(strip_tags($this->codePostal));
		$this->libelleVille=htmlspecialchars(strip_tags($this->libelleVille));
 
		// bind values
		$stmt->bindParam(":idLocalisation", $this->idLocalisation);
		$stmt->bindParam(":codePostal", $this->codePostal);
		$stmt->bindParam(":libelleVille", $this->libelleVille);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE idLocalisation = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->idLocalisation=htmlspecialchars(strip_tags($this->idLocalisation));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->idLocalisation);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT idLocalisation,codePostal,libelleVille FROM `localisation` WHERE idLocalisation = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->idLocalisation);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->idLocalisation = $row['idLocalisation'];
		$this->codePostal = $row['codePostal'];
		$this->libelleVille = $row['libelleVille'];
	}

	//voir une seul par nom pour recuperer l'id'
	function voir_un_seul_nom(){
 
		// query to read single record
		$query = "SELECT idLocalisation,codePostal,libelleVille FROM `localisation` WHERE libelleVille = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->libelleVille);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->idLocalisation = $row['idLocalisation'];
		$this->codePostal = $row['codePostal'];
		$this->libelleVille = $row['libelleVille'];
	}
}
?>