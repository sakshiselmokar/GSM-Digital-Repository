<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #d1d1d1;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            margin-top: 100px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4 text-center">Data Login</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="../index.php" >Back to Home</a>
        </div>
        <p class="mt-3 text-center">&copy; <?php echo date("Y"); ?> MIT Aurangabad. All rights reserved.</p>
    </div>

    <?php
    if (isset($_POST['login'])) {
        require_once '../conf.php'; // Include the database configuration

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute a query to fetch user's hashed password
        $query = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify password and redirect accordingly
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['authenticated_gsm'] = true;
            $_SESSION['user_id_gsm'] = $user_id;

            header('Location: view_files.php'); // Redirect to authenticated page
            exit();
        } else {
            echo "<p class='mt-3 text-danger text-center'>Invalid username or password.</p>";
        }
    }
    ?>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>