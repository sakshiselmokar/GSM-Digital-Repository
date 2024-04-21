<!DOCTYPE html>
<html>
<head>
    <title>Registration For Data Upload</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Registration Page</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </form>
    </div>
    
    <?php
    if (isset($_POST['register'])) {
        require_once '../conf.php'; // Include the database configuration
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute a query to insert new user
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "<p class='mt-3 text-success'>Registration successful. Please <a href='login.php'>login</a>.</p>";
        } else {
            echo "<p class='mt-3 text-danger'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
    ?>
    
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
