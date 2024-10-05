
<?php
include_once 'connection.php'; // Include your Database class file

// Check if the script is being accessed via a web server
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instantiate database and user object
    $database = new Connection();
    $db = $database->connect();
    $user = new User($db);


    // Input validation
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo 'All fields are required.';
        exit; // Stop execution if validation fails
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format.';
        exit; // Stop execution if validation fails
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
    // Optionally, you can handle the case when the script is accessed without a POST request
    echo 'Please submit the form.';
}
?>
