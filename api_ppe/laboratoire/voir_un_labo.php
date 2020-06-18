<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/laboratoire.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare laboratoire object
$laboratoire = new laboratoire($db);
 
// set ID property of record to read
$laboratoire->id_labo = isset($_GET['id_labo']) ? $_GET['id_labo'] : die();

//$laboratoire->num_article = $data->num_article;

var_dump($laboratoire->id_labo);
//var_dump($laboratoire->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$laboratoire->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of laboratoire to be edited
$laboratoire->voir_un_seul();
 
if($laboratoire->id_labo!=null){
    // create array
    $laboratoire_arr = array(
            "id_labo" => $laboratoire->id_labo,
            "nom_labo" => $laboratoire->nom_labo
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($laboratoire_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user laboratoire does not exist
    echo json_encode(array("message" => "the laboratoire does not exist."));
}
?>