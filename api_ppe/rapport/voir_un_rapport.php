<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/rapport.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare rapport object
$rapport = new Rapport($db);
 
// set ID property of record to read
$rapport->id_rapport = isset($_GET['id_rapport']) ? $_GET['id_rapport'] : die();

//$rapport->num_article = $data->num_article;

var_dump($rapport->id_rapport);
//var_dump($rapport->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$rapport->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of rapport to be edited
$rapport->voir_un_seul();
 
if($rapport->id_rapport!=null){
    // create array
    $rapport_arr = array(
            "id_rapport" => $rapport->id_rapport,
            "nom" => $rapport->nom,
            "prenom" => $rapport->prenom,
            "date_rapport" => $rapport->date_rapport,
            "motif" => $rapport->motif,
            "bilan" => $rapport->bilan
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($rapport_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user rapport does not exist
    echo json_encode(array("message" => "the rapport does not exist."));
}
?>