<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/famille.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare famille object
$famille = new famille($db);
 
// set ID property of record to read
$famille->id_famille = isset($_GET['id_famille']) ? $_GET['id_famille'] : die();

//$famille->num_article = $data->num_article;

var_dump($famille->id_famille);
//var_dump($famille->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$famille->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of famille to be edited
$famille->voir_un_seul();
 
if($famille->id_famille!=null){
    // create array
    $famille_arr = array(
            "id_famille" => $famille->id_famille,
			"code_famille" => $famille->code_famille,
            "nom_famille" => $famille->nom_famille
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($famille_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user famille does not exist
    echo json_encode(array("message" => "the famille does not exist."));
}
?>