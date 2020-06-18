<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/secteur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare secteur object
$secteur = new secteur($db);
 
// set ID property of record to read
$secteur->id_secteur = isset($_GET['id_secteur']) ? $_GET['id_secteur'] : die();

//$secteur->num_article = $data->num_article;

var_dump($secteur->id_secteur);
//var_dump($secteur->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$secteur->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of secteur to be edited
$secteur->voir_un_seul();
 
if($secteur->id_secteur!=null){
    // create array
    $secteur_arr = array(
            "id_secteur" => $secteur->id_secteur,
            "nom_secteur" => $secteur->nom_secteur
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($secteur_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user secteur does not exist
    echo json_encode(array("message" => "the secteur does not exist."));
}
?>