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
include_once '../objects/rapport.php';
 
$database = new Database();
$db = $database->getConnection();
 
$rapport = new Rapport($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->numero_praticien) &&
    !empty($data->date_rapport) &&
    !empty($data->bilan) &&
    !empty($data->motif) 
){
 
    // set product property values
	$rapport->numero_praticien = $data->numero_praticien;
    $rapport->date_rapport = $data->date_rapport;
    $rapport->bilan = $data->bilan;
    $rapport->motif = $data->motif;
 
    // create the product
    if($rapport->creer()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
		//var_dump($data->id_parleur);
		//var_dump($data->phrase);
		//var_dump($data->numero_rapport);
		//var_dump($data->date_envoie);
        echo json_encode(array("message" => "rapport was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
		var_dump($data->idTyperapport);
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
        echo json_encode(array("message" => "Unable to create rapport."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	var_dump($data->idLocalisation);
	var_dump($data->num_labo);
	//var_dump($data->numero_rapport);
	//var_dump($data->date_envoie);
    echo json_encode(array("message" => "Unable to create rapport. Data is incomplete."));
}
?>