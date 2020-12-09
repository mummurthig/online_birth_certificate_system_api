<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/applications.php';
 
// instantiate database and applications object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$applications = new Applications($db);
 
// initialize object
$applications->UserID = isset($_GET['UserID']) ? $_GET['UserID'] : die();

$stmt = $applications->my_applications();

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // applicationss array
    $applicationss_arr=array();
    $applicationss_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $applications_item=array(
            "ID" => $ID,
            "ApplicationID" => $ApplicationID,            
            "DateofBirth" => $DateofBirth,
            "Gender" => $Gender,
            "PlaceofBirth" => $PlaceofBirth,
            "NameofFather" => $NameofFather,
            "PermanentAdd" => $PermanentAdd,
            "PostalAdd" => $PostalAdd,
            "MobileNumber" => $MobileNumber,
            "Email" => $Email,
            "Remark" => $Remark,
            "Status" => $Status,
            "UpdationDate" => $UpdationDate
        );
 
        array_push($applicationss_arr["records"], $applications_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show applicationss data in json format
    echo json_encode($applicationss_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no applicationss found
    echo json_encode(
        array("message" => "No applicationss found.")
    );
}