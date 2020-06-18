<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/medicament.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$medicament = new medicament($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$medicament->id_medicament = $data->id_medicament;
 
// set product property values
$medicament->code = $data->code;
$medicament->num_famille = $data->num_famille;
$medicament->nom_commercial = $data->nom_commercial;
$medicament->composition = $data->composition;
$medicament->effets = $data->effets;
$medicament->contre_indication = $data->contre_indication;
$medicament->prix_echantillon = $data->prix_echantillon;
 
// update the product
if($medicament->mise_a_jour()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "medicament was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update medicament."));
}
?>