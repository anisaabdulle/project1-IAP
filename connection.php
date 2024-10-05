<?php
class connection {
  private $host= 'local host';
  private $db_name= 'user-information';
  private $username='root';
  private $password= 'password';
  public $conn ;

  public function connect() {
    $this->conn = null;

    try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
}
}

class user {
    private $conn;
    private $table= 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    public function _construct($db){
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (username, email, password) VALUES (:username, :email, :password)';
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Bind parameters
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
// Retrieve user details
public function read() {
    $query = 'SELECT * FROM ' . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;

}
}
