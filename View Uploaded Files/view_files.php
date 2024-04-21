<?php
session_start();

// Check if the user is authenticated, otherwise redirect to login
if (!isset($_SESSION['authenticated_gsm']) && !isset($_SESSION['authenticated_upload'])) {
    header('Location: login.php'); // or 'login_upload.php'
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>GSM Digital Repository Data</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">GSM Digital Repository</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_files.php">View Uploaded Files <span class="sr-only">(current)</span> </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" class="form-inline my-2 my-lg-0">
                            <button type="submit" class="btn btn-link nav-link" name="logout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <form class="form-inline mb-3" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search for a file">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">SR No</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">File Size</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fileDirectory = '../add/';
                    $files = scandir($fileDirectory);
                    $serialNumber = 0;

                    // Get search query from the URL
                    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..' && strpos($file, $searchQuery) !== false) {
                            $serialNumber++;
                            $filePath = $fileDirectory . $file;
                            $timestamp = date("Y-m-d ", filemtime($filePath));
                            $fileSizeBytes = filesize($filePath);
                            $fileSizeFormatted = formatBytes($fileSizeBytes);
                            echo "<tr>
                                    <td>$serialNumber</td>
                                    <td>$file</td>
                                    <td>$timestamp</td>
                                    <td>$fileSizeFormatted</td>
                                    <td><a href=\"$filePath\" class=\"btn btn-success\" target=\"_blank\">View PDF</a></td>
                                  </tr>";
                        }
                    }

                    // Function to format bytes into human-readable format
                    function formatBytes($bytes, $precision = 2) {
                        $units = array('B', 'KB', 'MB', 'GB', 'TB');
                        $bytes = max($bytes, 0);
                        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                        $pow = min($pow, count($units) - 1);
                        $bytes /= (1 << (10 * $pow));
                        return round($bytes, $precision) . ' ' . $units[$pow];
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Auto-refresh script -->
    <script>
        // Reload the page every 10 seconds (10000 milliseconds)
        setInterval(function() {
            location.reload();
        }, 10000); // 10000 milliseconds = 10 seconds
    </script>
</body>
</html>
