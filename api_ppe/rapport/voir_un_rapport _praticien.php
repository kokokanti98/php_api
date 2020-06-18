<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/rapport.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$rapport = new Rapport($db);

// set ID property of record to read
$rapport->numero_praticien = isset($_GET['numero_praticien']) ? $_GET['numero_praticien'] : die();
 
// query products
$stmt = $rapport->voir_tous_pra_rapport();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $rapports_arr=array();
    $rapports_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $rapport_item=array(
            "id_rapport" => $id_rapport,
            "nom" => $nom,
            "prenom" => $prenom,
            "date_rapport" => $date_rapport,
            "motif" => $motif,
            "bilan" => $bilan,
            "nom_commercial" => $nom_commercial,
			"qte_offerte" => $qte_offerte,
			"numero_praticien" => $numero_praticien
        );
 
       	if($id_rapport!=null){
			array_push($rapports_arr["records"], $rapport_item);
		}
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($rapports_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No rapport found.")
    );
}