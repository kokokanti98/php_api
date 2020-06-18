<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/specialite.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare specialite object
$specialite = new specialite($db);
 
// set ID property of record to read
$specialite->id_specialite = isset($_GET['id_specialite']) ? $_GET['id_specialite'] : die();

//$specialite->num_article = $data->num_article;

var_dump($specialite->id_specialite);
//var_dump($specialite->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$specialite->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of specialite to be edited
$specialite->voir_un_seul();
 
if($specialite->id_specialite!=null){
    // create array
    $specialite_arr = array(
            "id_specialite" => $specialite->id_specialite,
            "nom_specialite" => $specialite->nom_specialite
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($specialite_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user specialite does not exist
    echo json_encode(array("message" => "the specialite does not exist."));
}
?>