<?php
// Database connection details
$servername = "localhost"; // Change to your server
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "users_db"; // Database name

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
        $name=$_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "Passwords do not match!";
            exit();
        }

        $sql = "INSERT INTO users (name,email, password) VALUES (:name,:email, :password)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);

        // Execute and check if insertion was successful
        if ($stmt->execute()) {
            echo "User registered successfully!";
            // Redirect to login page or dashboard
            header("Location: home.html");
            exit();
        } else {
            echo "Error occurred during registration!";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>
