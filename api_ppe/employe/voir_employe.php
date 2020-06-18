<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employe.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$employe = new Employe($db);
 
// query products
$stmt = $employe->voir_tous();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $employes_arr=array();
    $employes_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $employe_item=array(
            "idEmploye" => $idEmploye,
            "idLocalisation" => $idLocalisation,
            "login" => $login,
            "mdp" => $mdp,
            "nom" => $nom,
            "prenom" => $prenom,
            "adresse" => $adresse,
            "codePostal" => $codePostal,
            "libelleVille" => $libelleVille,
            "nom_secteur" => $nom_secteur,
            "idLocalisation" => $idLocalisation,
            "idTypeEmploye" => $idTypeEmploye,
            "num_secteur" => $num_secteur,
            "nom_labo" => $nom_labo
        );
 
       	if($idEmploye!=null){
			array_push($employes_arr, $employe_item);
		}
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($employes_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No employe found.")
    );
}