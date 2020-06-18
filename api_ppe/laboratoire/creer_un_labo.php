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
include_once '../objects/laboratoire.php';
 
$database = new Database();
$db = $database->getConnection();
 
$laboratoire = new laboratoire($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->id_labo) &&
	!empty($data->nom_labo)
){
 
    // set product property values
	$laboratoire->id_labo = $data->id_labo;
	$laboratoire->nom_labo = $data->nom_labo;
 
    // create the product
    if($laboratoire->creer()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
		//var_dump($data->id_parleur);
		//var_dump($data->phrase);
		//var_dump($data->numero_laboratoire);
		//var_dump($data->date_envoie);
        echo json_encode(array("message" => "laboratoire was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create laboratoire."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	//var_dump($data->code);
	//var_dump($data->num_famille);
	//var_dump($data->nom_commercial);
	//var_dump($data->composition);
	//var_dump($data->effets);
	//var_dump($data->contre_indication);
	//var_dump($data->prix_echantillon);
    echo json_encode(array("message" => "Unable to create laboratoire. Data is incomplete."));
}
?>