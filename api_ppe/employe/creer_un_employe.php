<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/employe.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employe = new Employe($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->idTypeEmploye) &&
    !empty($data->idLocalisation) &&
    !empty($data->num_labo) &&
    !empty($data->num_secteur) &&
    !empty($data->num_specialite) &&
    !empty($data->coeff_notorie) &&
    !empty($data->nom) &&
    !empty($data->prenom) &&
    !empty($data->adresse) &&
    !empty($data->login) &&
    !empty($data->mdp) &&
    !empty($data->dateEmbauche) 
){
 
    // set product property values
	$employe->idTypeEmploye = $data->idTypeEmploye;
    $employe->idLocalisation = $data->idLocalisation;
    $employe->num_labo = $data->num_labo;
    $employe->num_secteur = $data->num_secteur;
    $employe->num_specialite = $data->num_specialite;
    $employe->coeff_notorie = $data->coeff_notorie;
    $employe->nom = $data->nom;
    $employe->prenom = $data->prenom;
    $employe->adresse = $data->adresse;
    $employe->login = $data->login;
    $employe->mdp = $data->mdp;
    $employe->dateEmbauche = $data->dateEmbauche;
 
    // create the product
    if($employe->creer()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
		//var_dump($data->id_parleur);
		//var_dump($data->phrase);
		//var_dump($data->numero_employe);
		//var_dump($data->date_envoie);
        echo json_encode(array("message" => "employe was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
		var_dump($data->idTypeEmploye);
		var_dump($data->idLocalisation);
		var_dump($data->num_labo);
		var_dump($data->num_secteur);
		var_dump($data->num_specialite);
		var_dump($data->coeff_notorie);
		var_dump($data->nom);
		var_dump($data->prenom);
		var_dump($data->adresse);
		var_dump($data->login);
		var_dump($data->mdp);
		var_dump($data->dateEmbauche);
        echo json_encode(array("message" => "Unable to create employe."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	var_dump($data->idLocalisation);
	var_dump($data->num_labo);
	//var_dump($data->numero_employe);
	//var_dump($data->date_envoie);
    echo json_encode(array("message" => "Unable to create employe. Data is incomplete."));
}
?>