<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once '../../config/database.php';
include_once '../../objects/applications.php';
 
$database = new Database();

$connection = $database->getConnection();

$applications = new Applications($connection);
 

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->UserID) && !empty($data->DateofBirth) && !empty($data->Gender) && !empty($data->FullName)  && !empty($data->Email) && !empty($data->MobileNumber)  && !empty($data->PermanentAdd)){

       $applications->UserID = $data->UserID;
       $rand_application_id = rand(000000000, 999999999);
       $applications->ApplicationID = $rand_application_id;
       $applications->DateofBirth = $data->DateofBirth;
       $applications->Gender = $data->Gender;
       $applications->FullName = $data->FullName;
       $applications->PlaceofBirth = $data->PlaceofBirth;
       $applications->NameofFather = $data->NameofFather;
       $applications->PermanentAdd = $data->PermanentAdd;
       $applications->PostalAdd = $data->PostalAdd;
       $applications->MobileNumber = $data->MobileNumber;
       $applications->Email = $data->Email;     
       
       
       
       $email_data = $applications->check_email();

       if(!empty($email_data)){
         // some data we have - insert should not go
         http_response_code(500);
         echo json_encode(array(
           "status" => 0,
           "message" => "User already exists, try another email address"
         ));
       }else{
         
       if($applications->add_new_application()){

        http_response_code(200);
        echo json_encode(array(
          "status" => 1,
          "message" => "New application has been created"
        ));
      }else{

        http_response_code(500);
        echo json_encode(array(
          "status" => 0,
          "message" => "Failed to save user"
        ));
      }

       }
      



    }else{
      http_response_code(500);
      echo json_encode(array(
        "status" => 0,
        "message" => "All data needed"
      ));
    }
}else{

  http_response_code(503);
  echo json_encode(array(
    "status" => 0,
    "message" => "Access Denied"
  ));
}
?>