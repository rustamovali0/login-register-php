<?php
require_once './db.php';

class User extends DB {
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public $errorMessage = [];

    public function __construct($name, $email, $password, $confirm_password) {
        parent::__construct();

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->connect();
    }

    public function create() {
        try {
            // First, compare passwords before hashing
            if ($this->password !== $this->confirm_password) {
                throw new Exception("Passwords do not match.");
            }

            // Hash the password
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO `users` (name, email, password) VALUES (:name, :email, :password)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

            // Start session
            session_start();

            // Store user information in session variables
            $_SESSION['user_name'] = $this->name;
            $_SESSION['user_email'] = $this->email;
            header("Location: welcome.php");
            exit();

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM `users` WHERE email= :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Start session
                session_start();

                // Store user information in session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                header("Location: welcome.php");
                exit();
            } else {
                echo "Email or password is wrong.";
            }
        } catch (PDOException $e) {
            echo "Error message : " . $e->getMessage();
        }
    }

    public function emailExists($email): bool
    {
        try {
            $sql = "SELECT COUNT(*) AS count FROM `users` WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // If count is greater than 0, email exists in the database
            return $result['count'] > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}


?>
