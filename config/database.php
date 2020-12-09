<?php
// used to get mysql database connection
class Database
{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "id15630938_sdsd";
    private $username = "id15630938_ss";
    private $password = "Mummurthi@12345";
    public $conn;

    // get the database connection
    public function getConnection()
    {

        $this->conn = null;

        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
