<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/localisation.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare localisation object
$localisation = new localisation($db);
 
// set ID property of record to read
$localisation->idLocalisation = isset($_GET['idLocalisation']) ? $_GET['idLocalisation'] : die();

//$localisation->num_article = $data->num_article;

var_dump($localisation->idLocalisation);
//var_dump($localisation->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$localisation->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of localisation to be edited
$localisation->voir_un_seul();
 
if($localisation->idLocalisation!=null){
    // create array
    $localisation_arr = array(
            "idLocalisation" => $localisation->idLocalisation,
			"codePostal" => $localisation->codePostal,
            "libelleVille" => $localisation->libelleVille
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($localisation_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user localisation does not exist
    echo json_encode(array("message" => "the localisation does not exist."));
}
?>