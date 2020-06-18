<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employe.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$employe = new Employe($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$employe->idEmploye = $data->idEmploye;
 
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
 
// update the product
if($employe->mise_a_jour()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "employe was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update employe."));
}
?>