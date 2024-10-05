
<?php
include_once 'connection.php'; // Include your Database class file

// Check if the script is being accessed via a web server
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instantiate database and user object
    $database = new Connection();
    $db = $database->connect();

    if ($db) {
        $user = new User($db); // Pass the database connection to User class

        // Input validation
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo 'All fields are required.';
            exit;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format.';
            exit;
        }

        // Set user properties
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->twofa_code = rand(100000, 999999); // Generate a simple 2FA code

        // Create the user
        if ($user->create()) {
            echo 'User registered successfully.';
        } else {
            echo 'User registration failed.';
        }
    } else {
        echo 'Database connection failed.';
    }
} else {
    echo 'Please submit the form.';
}
?>
