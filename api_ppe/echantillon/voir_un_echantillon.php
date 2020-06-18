<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/echantillon.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare echantillon object
$echantillon = new echantillon($db);
 
// set ID property of record to read
$echantillon->id_echantillon = isset($_GET['id_echantillon']) ? $_GET['id_echantillon'] : die();

//$echantillon->num_article = $data->num_article;

var_dump($echantillon->id_echantillon);
//var_dump($echantillon->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$echantillon->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of echantillon to be edited
$echantillon->voir_un_seul();
 
if($echantillon->id_echantillon!=null){
    // create array
    $echantillon_arr = array(
            "id_echantillon" => $echantillon->id_echantillon,
			"nom" => $echantillon->nom,
			"prenom" => $echantillon->prenom,
			"num_praticien" => $echantillon->num_praticien,
			"id_rapport" => $echantillon->id_rapport,
			"nom_commercial" => $echantillon->nom_commercial,
            "qte_offerte" => $echantillon->qte_offerte
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($echantillon_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user echantillon does not exist
    echo json_encode(array("message" => "the echantillon does not exist."));
}
?>