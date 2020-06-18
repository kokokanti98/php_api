<?php
class famille{
 
    // database connection and table name
    private $conn;
    private $table_name = "famille";
 
    // object properties
    public $id_famille;
	public $code_famille;
    public $nom_famille;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT id_famille,code_famille,nom_famille FROM `famille`";
 
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
					id_famille=:id_famille,
					code_famille=:code_famille,
					nom_famille=:nom_famille";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":id_famille", $this->id_famille);
		$stmt->bindParam(":code_famille", $this->code_famille);
		$stmt->bindParam(":nom_famille", $this->nom_famille);
 
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
					id_famille=:id_famille,
					code_famille=:code_famille,
					nom_famille=:nom_famille
				WHERE
					id_famille = :id_famille";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_famille=htmlspecialchars(strip_tags($this->id_famille));
		$this->code_famille=htmlspecialchars(strip_tags($this->code_famille));
		$this->nom_famille=htmlspecialchars(strip_tags($this->nom_famille));
 
		// bind values
		$stmt->bindParam(":id_famille", $this->id_famille);
		$stmt->bindParam(":code_famille", $this->code_famille);
		$stmt->bindParam(":nom_famille", $this->nom_famille);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_famille = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_famille=htmlspecialchars(strip_tags($this->id_famille));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_famille);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT id_famille,code_famille,nom_famille FROM `famille` WHERE id_famille = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_famille);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->id_famille = $row['id_famille'];
		$this->code_famille = $row['code_famille'];
		$this->nom_famille = $row['nom_famille'];
	}
}
?>