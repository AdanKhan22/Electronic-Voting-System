<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Add your CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .nav {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        .nav li {
            display: inline-block;
            margin: 10px;
        }

        .nav a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .nav a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Welcome to the Admin Panel</h1>
        <ul class="nav">
            <li><a href="citizendata.php">Manage Users</a></li>
            <li><a href="../src/resultspage.php">View Results</a></li>
            <li><a href="manage_elections.php">Manage Elections</a></li>
            <li><a href="audit.php">Audit Logs</a></li>
            <li><a href="../public/logout.php">Logout</a></li>
        </ul>
    </div>

</body>

</html>