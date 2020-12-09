<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once '../../config/database.php';
include_once '../../objects/admin.php';
 
$database = new Database();

$connection = $database->getConnection();

$admin_obj = new Admin($connection);
 

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->name) && !empty($data->email) && !empty($data->password)){
      
       $admin_obj->name = $data->name;
       $admin_obj->email = $data->email;
       $admin_obj->password = password_hash($data->password, PASSWORD_DEFAULT);

       $email_data = $admin_obj->check_email();

       if(!empty($email_data)){
         // some data we have - insert should not go
         http_response_code(500);
         echo json_encode(array(
           "status" => 0,
           "message" => "Admin already exists, try another email address"
         ));
       }else{
         if($admin_obj->create_admin()){

           http_response_code(200);
           echo json_encode(array(
             "status" => 1,
             "message" => "admin has been created"
           ));
         }else{

           http_response_code(500);
           echo json_encode(array(
             "status" => 0,
             "message" => "Failed to save Admin"
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