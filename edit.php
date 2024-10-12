<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the user data to edit
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
    $conn = null;
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background-color: #555; Dark background */
            color: #f1f1f1; /* Light text color */
        }
        .form-container {
            background-color: #1e1e1e; /* Slightly lighter dark background for form */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #f1f1f1; /* Light heading */
        }
        .form-control {
            background-color: #2c2c2c;
            color: #f1f1f1;
            border: 1px solid #3a3a3a;
        }
        .form-control:focus {
            background-color: #333;
            color: #fff;
            border-color: #555;
        }
        label {
            color: #ccc; /* Softer color for labels */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="form-container col-md-6">
            <h2 class="text-center mb-4">Edit User</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
