<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employe.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare employe object
$employe = new Employe($db);
 
// set ID property of record to read
$employe->idEmploye = isset($_GET['idEmploye']) ? $_GET['idEmploye'] : die();

//$employe->num_article = $data->num_article;

//var_dump($employe->idEmploye);
//var_dump($employe->num_article);

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$employe->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of employe to be edited
$employe->voir_un_seul();
 
if($employe->idEmploye!=null){
    // create array
    $employe_arr = array(
        "idEmploye" =>  $employe->idEmploye,
        "nom" => $employe->nom,
        "login" => $employe->login,
        "mdp" => $employe->mdp,
        "idLocalisation" => $employe->idLocalisation,
        "prenom" => $employe->prenom,
		"adresse" => $employe->adresse,
		"codePostal" => $employe->codePostal,
		"libelleVille" => $employe->libelleVille,
		"nom_secteur" => $employe->nom_secteur,
		"libelleTypeEmploye" => $employe->libelleTypeEmploye,
        "nom_labo" => $employe->nom_labo
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($employe_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user employe does not exist
    echo json_encode(array("message" => "the employe does not exist."));
}
?>