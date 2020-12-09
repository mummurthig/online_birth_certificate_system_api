<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create new user record
public function create_user(){

    $user_query = "INSERT INTO " . $this->table_name . "
   SET
         name=:name, phone=:phone, email=:email, address=:address, password=:password";

    $stmt = $this->conn->prepare($user_query);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->phone=htmlspecialchars(strip_tags($this->phone));  
    $this->email=htmlspecialchars(strip_tags($this->email));   
    $this->address=htmlspecialchars(strip_tags($this->address));   
    $this->password=htmlspecialchars(strip_tags($this->password));

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":phone", $this->phone);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":password", $this->password);    

    if($stmt->execute()){
      return true;
    }

    return false;
  }

function check_email(){
    $email_query = "SELECT * from ".$this->table_name." WHERE email = :email";
    $stmt = $this->conn->prepare($email_query);
    $this->email=htmlspecialchars(strip_tags($this->email));
    $stmt->bindValue(":email", $this->email);
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);       
        return true;
    }
    return false;    
}

// check if given email exist in the database
function user_login(){
 
    // query to check if email exists
    $query = "SELECT id, name,  phone, address, password
            FROM " . $this->table_name . "
            WHERE email = ? 
            LIMIT 0,1";
    // prepare the query
    $stmt = $this->conn->prepare( $query );
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
    // bind given email value
    $stmt->bindParam(1, $this->email);
    // execute the query
    $stmt->execute();
    // get number of rows
    $num = $stmt->rowCount();
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->phone = $row['phone'];
        $this->address = $row['address'];
        $this->password = $row['password'];
        
        return true;
    }

    return false;
}
 
// update a user record
public function update_user(){

	$password_set=!empty($this->password) ? ", password = :password" : "";

	$query = "UPDATE " . $this->table_name . "
			SET
				name = :name,
                phone = :phone,
                email = :email,
                address = :address
				{$password_set}
			WHERE id = :id";

	$stmt = $this->conn->prepare($query);

	$this->name=htmlspecialchars(strip_tags($this->name));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->address=htmlspecialchars(strip_tags($this->address));
	
	$stmt->bindParam(':name', $this->name);
	$stmt->bindParam(':phone', $this->phone);
	$stmt->bindParam(':email', $this->email);
	$stmt->bindParam(':address', $this->address);
	
	if(!empty($this->password)){
		$this->password=htmlspecialchars(strip_tags($this->password));
		$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password_hash);
	}
	
	$stmt->bindParam(':id', $this->id);
	
	if($stmt->execute()){
		return true;
	}

	return false;
}
}