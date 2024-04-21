<?php
session_start();

// Check if the user is authenticated, otherwise redirect to login
if (!isset($_SESSION['authenticated_gsm']) && !isset($_SESSION['authenticated_upload'])) {
    header('Location: login_upload.php');
    exit();
}

// Logout logic for the current page only
if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['authenticated_gsm']);
    unset($_SESSION['authenticated_upload']);
    header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to the current page
    exit();
}


// Handle file upload
$uploadSuccess = false; // Initialize the upload success flag

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        $uploadSuccess = true;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>GSM DIGITAL REPOSITORY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
 
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="Image/MIT_Logo.png" alt="Logo" height="50">
            GSM DIGITAL REPOSITORY
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="View Uploaded Files/login.php">View Uploaded Data</a>
                </li>
                <li class="nav-item">
                    <form method="post">
                        <button class="btn btn-link nav-link" type="submit" name="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <form class="upload-form" action="upload.php" method="POST" enctype="multipart/form-data">
            
            <div class="logo">
                <img src="Image/MIT_Logo.png" alt="Logo">
            </div>
            <h1>GSM DIGITAL REPOSITORY</h1>
            <div class="drag-drop-area">
                <input class="file-input" type="file" name="fileToUpload" id="fileToUpload" multiple>
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Browse Files to Upload</p>
            </div>
            <button class="submit-button" type="submit" name="submit">Upload Files</button><br><br>
            <!-- Display success message if upload was successful -->
        <?php if ($uploadSuccess) : ?>
            <p class="upload-success">File uploaded successfully!</p>
        <?php endif; ?>
            
        </form>     

    </div>

    <script>
        const dragDropArea = document.querySelector('.drag-drop-area');

        dragDropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragDropArea.classList.add('dragover');
        });

        dragDropArea.addEventListener('dragleave', () => {
            dragDropArea.classList.remove('dragover');
        });

        dragDropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragDropArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            // Handle the dropped files here
        });
    </script>
</body>

</html>