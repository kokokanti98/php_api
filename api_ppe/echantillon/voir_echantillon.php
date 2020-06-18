<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/echantillon.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$echantillon = new echantillon($db);

// query products
$stmt = $echantillon->voir_tous();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $echantillons_arr=array();
    $echantillons_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $echantillon_item=array(
            "id_echantillon" => $id_echantillon,
			"nom" => $nom,
			"prenom" => $prenom,
			"num_praticien" => $num_praticien,
			"id_rapport" => $id_rapport,
			"nom_commercial" => $nom_commercial,
            "qte_offerte" => $qte_offerte
        );
 
       	if($id_echantillon!=null){
			array_push($echantillons_arr["records"], $echantillon_item);
		}
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($echantillons_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No echantillon found.")
    );
}