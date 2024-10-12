<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";


    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully!";
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
       
        // Update user data
        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: dashboard.php?message=User+updated+successfully");
            exit();
        } else {
            echo "Error updating record.";
        }
 
    $conn = null;
} else {
    echo "Invalid request.";
}
?> 


