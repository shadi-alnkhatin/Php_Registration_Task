<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="bg-secondary">
   
    <div class="container">
    <h1 class="mb-5 mt-5">Hi Admin </h1>

<?php 
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "users_db"; 
function deleteUser($id) {
    global $servername, $username, $password, $dbname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL to delete the user
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>User deleted successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting user</div>";
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

if (isset($_GET['delete_id'])) {
    $userIdToDelete = $_GET['delete_id'];
    deleteUser($userIdToDelete);
}



    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
    
            // Fetch the user data
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
        echo "<table class='table table-dark table-striped table-hover' >";
        echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Funcs</th> </tr></thead>";
        echo "<tbody>";
        
        // Loop through each user and display their data in table rows
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>"; 
            echo "<td>" . htmlspecialchars($user['name']) . "</td>"; 
            echo "<td>" . htmlspecialchars($user['email']) . "</td>"; 
            echo "<td>" . htmlspecialchars($user['password']) . "</td>"; 
            echo "<td>
            <a href='edit.php?id=" . htmlspecialchars($user['id']) . "' class='btn btn-primary'>Edit</a>
            <a href='dashboard.php?delete_id=" . htmlspecialchars($user['id']) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
          </td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No users found.";
    }        
            
        }
     catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  
    
    
?>

<a class="btn btn-danger" href="./login.html">Logout</a>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>