<?php
class Connection {
    private $host = 'localhost';
    private $db_name = 'user-information';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
    public $twofa_code;

    // Constructor receives the PDO connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (username, email, password, twofa_code) 
                  VALUES (:username, :email, :password, :twofa_code)';
        $stmt = $this->conn->prepare($query);

       
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Hash the password
        $this->twofa_code = htmlspecialchars(strip_tags($this->twofa_code));

      
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':twofa_code', $this->twofa_code);

        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

