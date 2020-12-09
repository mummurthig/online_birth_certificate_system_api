<?php
// 'admin' object
class Admin
{

    // database connection and table name
    private $conn;
    private $table_name = "admin";

    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $created;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create new admin record
    public function create_admin()
    {

        $user_query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, password=:password";

        $stmt = $this
            ->conn
            ->prepare($user_query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute())
        {
            return true;
        }

        return false;
    }

    function check_email()
    {
        $email_query = "SELECT * from " . $this->table_name . " WHERE email = :email";
        $stmt = $this
            ->conn
            ->prepare($email_query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0)
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        }
        return false;
    }

    // check if given email exist in the database
    function admin_login()
    {

        // query to check if email exists
        $query = "SELECT id, name, created, password
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";

        // prepare the query
        $stmt = $this
            ->conn
            ->prepare($query);

        // sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if ($num > 0)
        {

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            $this->created = $row['created'];

            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }

    // update a admin record
    public function update_admin()
    {

        // if password needs to be updated
        $password_set = !empty($this->password) ? ", password = :password" : "";

        // if no posted password, do not update the password
        $query = "UPDATE " . $this->table_name . "
			SET				
				name = :name,
				email = :email
				{$password_set}
			WHERE id = :id";

        // prepare the query
        $stmt = $this
            ->conn
            ->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind the values from the form
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);

        // hash the password before saving to database
        if (!empty($this->password))
        {
            $this->password = htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        }

        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute())
        {
            return true;
        }

        return false;
    }
}

