<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/medicament.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare medicament object
$medicament = new Medicament($db);
 
// set ID property of record to read
$medicament->code = isset($_GET['code']) ? $_GET['code'] : die();

//$medicament->num_article = $data->num_article;

var_dump($medicament->code);
//var_dump($medicament->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$medicament->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of medicament to be edited
$medicament->voir_un_seul();
 
if($medicament->code!=null){
    // create array
    $medicament_arr = array(
            "code" => $medicament->code,
            "nom_commercial" => $medicament->nom_commercial,
            "nom_famille" => $medicament->nom_famille,
            "composition" => $medicament->composition,
            "effets" => $medicament->effets,
			"contre_indication" => $medicament->contre_indication,
            "prix_echantillon" => $medicament->prix_echantillon
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($medicament_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user medicament does not exist
    echo json_encode(array("message" => "the medicament does not exist."));
}
?>