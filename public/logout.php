<?php

session_start();


session_unset();


session_destroy();


header('Location: ../src/utils/login.php');
exit;
