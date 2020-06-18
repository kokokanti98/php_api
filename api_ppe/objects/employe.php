<?php
class Employe{
 
    // database connection and table name
    private $conn;
    private $table_name = "employe";
 
    // object properties
    public $idEmploye;
    public $idTypeEmploye;
    public $idLocalisation;
    public $idTypeVehicule;
    public $num_labo;
    public $num_secteur;
    public $num_specialite;
    public $coeff_notorie;
    public $nom;
    public $prenom;
    public $adresse;
    public $login;
    public $mdp;
    public $dateEmbauche;
    public $dateModifFicheE;
    public $cptActif;
    public $codePostal;
    public $libelleVille;
    public $nom_secteur;
    public $nom_labo;
    public $libelleTypeEmploye;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT idEmploye,localisation.idLocalisation,login,mdp,nom,prenom,adresse,codePostal,libelleVille,nom_secteur,libelleTypeEmploye,nom_labo,employe.idLocalisation,employe.num_secteur,employe.idTypeEmploye 
		FROM employe JOIN localisation ON employe.idLocalisation = localisation.idLocalisation 
		LEFT JOIN secteur ON employe.num_secteur = secteur.id_secteur LEFT JOIN laboratoire ON employe.num_labo = laboratoire.id_labo 
		LEFT JOIN typeemploye ON employe.idTypeEmploye = typeemploye.idTypeEmploye";
 
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
					idTypeEmploye=:idTypeEmploye, 
					idLocalisation=:idLocalisation, 
					num_labo=:num_labo, 
					num_secteur=:num_secteur, 
					num_specialite=:num_specialite, 
					coeff_notorie=:coeff_notorie, 
					nom=:nom, 
					prenom=:prenom, 
					adresse=:adresse, 
					login=:login, 
					mdp=:mdp, 
					dateEmbauche=:dateEmbauche";
 
		// prepare query
		//var_dump($query);
		$stmt = $this->conn->prepare($query);
 
 
		// bind values
		$stmt->bindParam(":idTypeEmploye", $this->idTypeEmploye);
		$stmt->bindParam(":idLocalisation", $this->idLocalisation);
		$stmt->bindParam(":num_labo", $this->num_labo);
		$stmt->bindParam(":num_secteur", $this->num_secteur);
		$stmt->bindParam(":num_specialite", $this->num_specialite);
		$stmt->bindParam(":coeff_notorie", $this->coeff_notorie);
		$stmt->bindParam(":nom", $this->nom);
		$stmt->bindParam(":prenom", $this->prenom);
		$stmt->bindParam(":adresse", $this->adresse);
		$stmt->bindParam(":login", $this->login);
		$stmt->bindParam(":mdp", $this->mdp);
		$stmt->bindParam(":dateEmbauche", $this->dateEmbauche);
 
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
					idTypeEmploye=:idTypeEmploye, 
					idLocalisation=:idLocalisation, 
					num_labo=:num_labo, 
					num_secteur=:num_secteur, 
					num_specialite=:num_specialite, 
					coeff_notorie=:coeff_notorie, 
					nom=:nom, 
					prenom=:prenom, 
					adresse=:adresse, 
					login=:login, 
					mdp=:mdp, 
					dateEmbauche=:dateEmbauche
				WHERE
					idEmploye = :idEmploye";
 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->idTypeEmploye=htmlspecialchars(strip_tags($this->idTypeEmploye));
		$this->idLocalisation=htmlspecialchars(strip_tags($this->idLocalisation));
		$this->num_labo=htmlspecialchars(strip_tags($this->num_labo));
		$this->num_secteur=htmlspecialchars(strip_tags($this->num_secteur));
		$this->num_specialite=htmlspecialchars(strip_tags($this->num_specialite));
		$this->coeff_notorie=htmlspecialchars(strip_tags($this->coeff_notorie));
		$this->nom=htmlspecialchars(strip_tags($this->nom));
		$this->prenom=htmlspecialchars(strip_tags($this->prenom));
		$this->adresse=htmlspecialchars(strip_tags($this->adresse));
		$this->login=htmlspecialchars(strip_tags($this->login));
		$this->mdp=htmlspecialchars(strip_tags($this->mdp));
		$this->dateEmbauche=htmlspecialchars(strip_tags($this->dateEmbauche));
		$this->idEmploye=htmlspecialchars(strip_tags($this->idEmploye));
 
		// bind values
		$stmt->bindParam(":idTypeEmploye", $this->idTypeEmploye);
		$stmt->bindParam(":idLocalisation", $this->idLocalisation);
		$stmt->bindParam(":num_labo", $this->num_labo);
		$stmt->bindParam(":num_secteur", $this->num_secteur);
		$stmt->bindParam(":num_specialite", $this->num_specialite);
		$stmt->bindParam(":coeff_notorie", $this->coeff_notorie);
		$stmt->bindParam(":nom", $this->nom);
		$stmt->bindParam(":prenom", $this->prenom);
		$stmt->bindParam(":adresse", $this->adresse);
		$stmt->bindParam(":login", $this->login);
		$stmt->bindParam(":mdp", $this->mdp);
		$stmt->bindParam(":dateEmbauche", $this->dateEmbauche);
		$stmt->bindParam(":idEmploye", $this->idEmploye);
 
		// execute the query
		if($stmt->execute()){
			return true;
		}
 
		return false;
	}
	// delete un utilisateur
	function supprimer(){
 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE idEmploye = ?";
 
		// prepare query
		$stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->idEmploye=htmlspecialchars(strip_tags($this->idEmploye));
 
		// bind id of record to delete
		$stmt->bindParam(1, $this->idEmploye);
 
		// execute query
		if($stmt->execute()){
			return true;
		}
 
		return false;     
	}
		// used when filling up the update chat form
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT idEmploye,localisation.idLocalisation,login,mdp,nom,prenom,adresse,codePostal,libelleVille,nom_secteur,libelleTypeEmploye,nom_labo 
		FROM employe JOIN localisation ON employe.idLocalisation = localisation.idLocalisation 
		LEFT JOIN secteur ON employe.num_secteur = secteur.id_secteur LEFT JOIN laboratoire ON employe.num_labo = laboratoire.id_labo 
		LEFT JOIN typeemploye ON employe.idTypeEmploye = typeemploye.idTypeEmploye WHERE idEmploye = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->idEmploye);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		// set values to object properties
		$this->idEmploye = $row['idEmploye'];
		$this->idLocalisation = $row['idLocalisation'];
		$this->login = $row['login'];
		$this->mdp = $row['mdp'];
		$this->nom = $row['nom'];
		$this->prenom = $row['prenom'];
		$this->adresse = $row['adresse'];
		$this->codePostal = $row['codePostal'];
		$this->libelleVille = $row['libelleVille'];
		$this->nom_secteur = $row['nom_secteur'];
		$this->libelleTypeEmploye = $row['libelleTypeEmploye'];
		$this->nom_labo = $row['nom_labo'];
	}
}
?>