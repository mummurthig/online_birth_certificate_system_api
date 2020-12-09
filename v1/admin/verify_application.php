<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/applications.php';
 
// instantiate database and applications object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$applications = new Applications($db);
 
// get id of applications to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of applications to be edited
$applications->ID = $data->ID;

// set applications property values
$applications->Remark = $data->Remark;
$applications->Status = $data->Status;
$date = date("Y/m/d");
$applications->UpdationDate = $date;

 
// update the applications
if($applications->verify_application()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "applications was updated."));
}
 
// if unable to update the applications, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update applications."));
}
?>