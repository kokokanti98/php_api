<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/echantillon.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$echantillon = new echantillon($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$echantillon->id_echantillon = $data->id_echantillon;
 
// set product property values
$echantillon->num_medicament = $data->num_medicament;
$echantillon->num_rapport = $data->num_rapport;
$echantillon->num_praticien = $data->num_praticien;
$echantillon->qte_offerte = $data->qte_offerte;
 
// update the product
if($echantillon->mise_a_jour()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "echantillon was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update echantillon."));
}
?>