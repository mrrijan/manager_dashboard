header.php
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Fixed Navbar */
        .navbar {
            background: #007bff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Ensures it stays above sidebar */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Body padding to prevent content from being hidden behind navbar */
        body {
            padding-top: 56px; /* Adjust based on navbar height */
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }
        .container-fluid{
            padding-left : 280px;
        }
        #todosChart {
        max-width: 300px !important;
        max-height: 300px !important;
        margin: 0 auto; /* Center it */
    }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="d-flex">
            <span class="navbar-text me-3 text-white">
                Welcome, <strong><?= isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "User"; ?></strong>
            </span>
            <a href="../actions/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

