<?php

class Applications
{

    //database connection
    private $conn;
    private $table_name = "applications";

    // objects properties
    public $id;
    public $UserID;
    public $ApplicationID;
    public $DateofBirth;
    public $Gender;
    public $FullName;
    public $PlaceofBirth;
    public $NameofFather;
    public $PermanentAdd;
    public $PostalAdd;
    public $MobileNumber;
    public $Email;
    public $Remark;
    public $Status;
    public $UpdationDate;

    // constructor
    function __construct($db)
    {
        $this->conn = $db;
    }

    function add_new_application()
    {

        $query = "INSERT INTO " . $this->table_name . " 
        SET UserID=:UserID, ApplicationID=:ApplicationID, DateofBirth=:DateofBirth, Gender=:Gender, FullName=:FullName, PlaceofBirth=:PlaceofBirth,
        NameofFather=:NameofFather, PermanentAdd=:PermanentAdd, PostalAdd =:PostalAdd, MobileNumber=:MobileNumber, Email=:Email  ";

        $stmt = $this
            ->conn
            ->prepare($query);

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));
        $this->ApplicationID = htmlspecialchars(strip_tags($this->ApplicationID));
        $this->DateofBirth = htmlspecialchars(strip_tags($this->DateofBirth));
        $this->Gender = htmlspecialchars(strip_tags($this->Gender));
        $this->FullName = htmlspecialchars(strip_tags($this->FullName));
        $this->PlaceofBirth = htmlspecialchars(strip_tags($this->PlaceofBirth));
        $this->NameofFather = htmlspecialchars(strip_tags($this->NameofFather));
        $this->PermanentAdd = htmlspecialchars(strip_tags($this->PermanentAdd));
        $this->PostalAdd = htmlspecialchars(strip_tags($this->PostalAdd));
        $this->MobileNumber = htmlspecialchars(strip_tags($this->MobileNumber));
        $this->Email = htmlspecialchars(strip_tags($this->Email));


        $stmt->bindParam(":UserID", $this->UserID);
        $stmt->bindParam(":ApplicationID", $this->ApplicationID);
        $stmt->bindParam(":DateofBirth", $this->DateofBirth);
        $stmt->bindParam(":Gender", $this->Gender);
        $stmt->bindParam(":FullName", $this->FullName);
        $stmt->bindParam(":PlaceofBirth", $this->PlaceofBirth);
        $stmt->bindParam(":NameofFather", $this->NameofFather);
        $stmt->bindParam(":PermanentAdd", $this->PermanentAdd);
        $stmt->bindParam(":PostalAdd", $this->PostalAdd);
        $stmt->bindParam(":MobileNumber", $this->MobileNumber);
        $stmt->bindParam(":Email", $this->Email);
   

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }

    function all_applications()
    {

        // select all query
        $query = "SELECT ID, ApplicationID, DateofBirth, Gender ,FullName ,PlaceofBirth,NameofFather, PermanentAdd,
         PostalAdd, MobileNumber,  Email, Remark , Status ,UpdationDate  
         FROM 
           " . $this->table_name . " 
         ORDER BY
                ID";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function my_applications(){

        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " WHERE UserID = ? ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->UserID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    
   function check_email(){
     $email_query = "SELECT * from ".$this->table_name." WHERE Email = :Email";
   $stmt = $this->conn->prepare($email_query);
  $this->Email=htmlspecialchars(strip_tags($this->Email));
  $stmt->bindValue(":Email", $this->Email);
  $stmt->execute();
  $num = $stmt->rowCount();
  if($num>0){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);       
      return true;
  }
  return false;    
}

    function verified_applications(){

        // select all query
        $query = "SELECT ID, ApplicationID, DateofBirth, Gender ,FullName ,PlaceofBirth,NameofFather, PermanentAdd,
      PostalAdd, MobileNumber,  Email, Remark , Status ,UpdationDate  
      FROM 
        " . $this->table_name . " 
      WHERE Status = 'verified' ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function regicted_applications()
    {

        // select all query
        $query = "SELECT ID, ApplicationID, DateofBirth, Gender ,FullName ,PlaceofBirth,NameofFather, PermanentAdd,
        PostalAdd, MobileNumber,  Email, Remark , Status ,UpdationDate  
        FROM 
          " . $this->table_name . " 
        WHERE Status = 'regicted' ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function pending_applications()
    {

        // select all query
        $query = "SELECT ID, ApplicationID, DateofBirth, Gender ,FullName ,PlaceofBirth,NameofFather, PermanentAdd,
        PostalAdd, MobileNumber,  Email, Remark , Status ,UpdationDate  
        FROM 
          " . $this->table_name . " 
        WHERE Status = 'pending' ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function my_verified_applications()
    {

        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE Status = 'verified' AND UserID = ? ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->UserID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function my_regicted_applications()
    {

        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE Status = 'regicted' AND UserID = ? ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->UserID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function my_pending_applications()
    {

        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE Status = 'pending' AND UserID = ? ";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->UserID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function verify_application()
    {

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                Remark = :Remark,
                Status = :Status,
                UpdationDate = :UpdationDate                    
                WHERE
                    ID = :ID";

        // prepare query statement
        $stmt = $this
            ->conn
            ->prepare($query);

        // sanitize
        $this->Remark = htmlspecialchars(strip_tags($this->Remark));
        $this->Status = htmlspecialchars(strip_tags($this->Status));
        $this->UpdationDate = htmlspecialchars(strip_tags($this->UpdationDate));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // bind new values
        $stmt->bindParam(':Remark', $this->Remark);
        $stmt->bindParam(':Status', $this->Status);
        $stmt->bindParam(':UpdationDate', $this->UpdationDate);
        $stmt->bindParam(':ID', $this->ID);

        // execute the query
        if ($stmt->execute())
        {
            return true;
        }

        return false;
    }

}

?>
