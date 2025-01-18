<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election System</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php
    session_start();




    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        include '../src/utils/login.php';
        exit;
    }




    require_once '../src/utils/navbar.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    switch ($page) {
        case 'home':
            include '../src/home.php';
            break;
        case 'citizens':
            include '../src/citizen.php';
            break;
        case 'voters':
            include '../src/voterspage.php';
            break;
        case 'elections':
            include '../src/electionspage.php';
            break;
        case 'results':
            include '../src/resultspage.php';
            break;
        default:
            include '../src/home.php';
    }

    ?>

</body>

</html>