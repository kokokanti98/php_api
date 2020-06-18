<?php
class Medicament{
 
    // database connection and table name
    private $conn;
    private $table_name = "medicament";
 
    // object properties
    public $id_medicament;
    public $code;
    public $num_famille;
    public $nom_commercial;
    public $composition;
    public $effets;
    public $contre_indication;
    public $prix_echantillon;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT code,nom_commercial,nom_famille,composition,effets,contre_indication,prix_echantillon 
		FROM medicament INNER JOIN famille ON medicament.num_famille = famille.id_famille";
 
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
					code=:code, 
					num_famille=:num_famille, 
					nom_commercial=:nom_commercial, 
					composition=:composition, 
					effets=:effets, 
					contre_indication=:contre_indication, 
					prix_echantillon=:prix_echantillon";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":code", $this->code);
		$stmt->bindParam(":num_famille", $this->num_famille);
		$stmt->bindParam(":nom_commercial", $this->nom_commercial);
		$stmt->bindParam(":composition", $this->composition);
		$stmt->bindParam(":effets", $this->effets);
		$stmt->bindParam(":contre_indication", $this->contre_indication);
		$stmt->bindParam(":prix_echantillon", $this->prix_echantillon);
 
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
					code=:code, 
					num_famille=:num_famille, 
					nom_commercial=:nom_commercial, 
					composition=:composition, 
					effets=:effets, 
					contre_indication=:contre_indication, 
					prix_echantillon=:prix_echantillon
				WHERE
					id_medicament = :id_medicament";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_medicament=htmlspecialchars(strip_tags($this->id_medicament));
		$this->code=htmlspecialchars(strip_tags($this->code));
		$this->num_famille=htmlspecialchars(strip_tags($this->num_famille));
		$this->nom_commercial=htmlspecialchars(strip_tags($this->nom_commercial));
		$this->composition=htmlspecialchars(strip_tags($this->composition));
		$this->effets=htmlspecialchars(strip_tags($this->effets));
		$this->contre_indication=htmlspecialchars(strip_tags($this->contre_indication));
		$this->prix_echantillon=htmlspecialchars(strip_tags($this->prix_echantillon));
 
		// bind values
		$stmt->bindParam(":id_medicament", $this->id_medicament);
		$stmt->bindParam(":code", $this->code);
		$stmt->bindParam(":num_famille", $this->num_famille);
		$stmt->bindParam(":nom_commercial", $this->nom_commercial);
		$stmt->bindParam(":composition", $this->composition);
		$stmt->bindParam(":effets", $this->effets);
		$stmt->bindParam(":contre_indication", $this->contre_indication);
		$stmt->bindParam(":prix_echantillon", $this->prix_echantillon);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_medicament = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->id_medicament=htmlspecialchars(strip_tags($this->id_medicament));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_medicament);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// voir seul ar id ou 
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT code,nom_commercial,nom_famille,composition,effets,contre_indication,prix_echantillon 
		FROM medicament INNER JOIN famille ON medicament.num_famille = famille.id_famille WHERE code = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->code);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->code = $row['code'];
		$this->nom_commercial = $row['nom_commercial'];
		$this->nom_famille = $row['nom_famille'];
		$this->composition = $row['composition'];
		$this->effets = $row['effets'];
		$this->contre_indication = $row['contre_indication'];
		$this->contre_indication = $row['prix_echantillon'];
	}
}
?>