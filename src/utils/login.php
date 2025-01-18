<?php
session_start();


if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {

    header('Location: index.php');
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "electronic_voting";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT userID, password, role FROM citizen WHERE Name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {


            $_SESSION['authenticated'] = true;
            $_SESSION['user_id'] = $user['userID'];


            if ($user['role'] === 'admin') {
                header('Location: /Electronic_Voting/admin/citizendata.php');
                exit;
            }


            header('Location: index.php');
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "No such user found.";
    }
}


// Registration Logic
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $CNIC = $_POST['CNIC'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Gender = $_POST['Gender'];
    $role = "user";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO citizen (userId , name , email, role , PhoneNumber, Gender , password) VALUES ('$CNIC', '$name', '$email' , '$role' , '$PhoneNumber' , '$Gender' , '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Registration successful! You can now log in.";

        header('Location: index.php');
        exit;
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<body>

    <div class="mainwrap">
        <div class="wrapper">
            <div class="card-switch">
                <label class="switch">
                    <input type="checkbox" class="toggle">
                    <span class="slider"></span>
                    <span class="card-side"></span>
                    <div class="flip-card__inner">
                        <!-- Log in form -->
                        <div class="flip-card__front">
                            <div class="title">Log in</div>
                            <form class="flip-card__form" method="POST" action="">
                                <input class="flip-card__input" name="username" placeholder="Username" type="text" required>
                                <input class="flip-card__input" name="password" placeholder="Password" type="password" required>
                                <?php
                                if (isset($error_message)) {
                                    echo "<p style='color:red;'>$error_message</p>";
                                }
                                ?>
                                <button class="flip-card__btn" name="login">Let`s go!</button>
                            </form>
                        </div>

                        <!-- Sign up form -->
                        <div class="flip-card__back">
                            <div class="title">Sign up</div>
                            <form class="flip-card__form" method="POST" action="">
                                <input class="flip-card__input" name="name" placeholder="Name" type="text" required>
                                <input class="flip-card__input" name="email" placeholder="Email" type="email" required>
                                <input class="flip-card__input" name="password" placeholder="Password" type="password" required>
                                <input class="flip-card__input" name="CNIC" placeholder="CNIC" type="text" required>
                                <input class="flip-card__input" name="PhoneNumber" placeholder="PhoneNumber" type="text" required>
                                <input class="flip-card__input" name="Gender" placeholder="Gender" type="text" required>

                                <?php
                                if (isset($success_message)) {
                                    echo "<p style='color:green;'>$success_message</p>";
                                }
                                if (isset($error_message)) {
                                    echo "<p style='color:red;'>$error_message</p>";
                                }
                                ?>
                                <button class="flip-card__btn" name="register">Confirm!</button>
                            </form>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>

</body>


<style>
    .mainwrap {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
    }

    .wrapper {

        --input-focus: #2d8cf0;
        --font-color: #323232;
        --font-color-sub: #666;
        --bg-color: #fff;
        --bg-color-alt: #666;
        --main-color: #323232;

    }


    .switch {
        transform: translateY(-200px);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        width: 50px;
        height: 20px;
    }

    .card-side::before {
        position: absolute;
        content: 'Log in';
        left: -70px;
        top: 0;
        width: 100px;
        text-decoration: underline;
        color: var(--font-color);
        font-weight: 600;
    }

    .card-side::after {
        position: absolute;
        content: 'Sign up';
        left: 70px;
        top: 0;
        width: 100px;
        text-decoration: none;
        color: var(--font-color);
        font-weight: 600;
    }

    .toggle {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        box-sizing: border-box;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--bg-colorcolor);
        transition: 0.3s;
    }

    .slider:before {
        box-sizing: border-box;
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        border: 2px solid var(--main-color);
        border-radius: 5px;
        left: -2px;
        bottom: 2px;
        background-color: var(--bg-color);
        box-shadow: 0 3px 0 var(--main-color);
        transition: 0.3s;
    }

    .toggle:checked+.slider {
        background-color: var(--input-focus);
    }

    .toggle:checked+.slider:before {
        transform: translateX(30px);
    }

    .toggle:checked~.card-side:before {
        text-decoration: none;
    }

    .toggle:checked~.card-side:after {
        text-decoration: underline;
    }

    /* card */

    .flip-card__inner {
        width: 300px;
        height: 350px;
        position: relative;
        background-color: transparent;
        perspective: 1000px;
        /* width: 100%;
    height: 100%; */
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .toggle:checked~.flip-card__inner {
        transform: rotateY(180deg);
    }

    .toggle:checked~.flip-card__front {
        box-shadow: none;
    }

    .flip-card__front,
    .flip-card__back {
        padding: 20px;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        background: lightgrey;
        gap: 20px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
    }

    .flip-card__back {
        width: 100%;
        transform: rotateY(180deg);
    }

    .flip-card__form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .title {
        margin: 20px 0 20px 0;
        font-size: 25px;
        font-weight: 900;
        text-align: center;
        color: var(--main-color);
    }

    .flip-card__input {
        width: 250px;
        height: 40px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        background-color: var(--bg-color);
        box-shadow: 4px 4px var(--main-color);
        font-size: 15px;
        font-weight: 600;
        color: var(--font-color);
        padding: 5px 10px;
        outline: none;
    }

    .flip-card__input::placeholder {
        color: var(--font-color-sub);
        opacity: 0.8;
    }

    .flip-card__input:focus {
        border: 2px solid var(--input-focus);
    }

    .flip-card__btn:active,
    .button-confirm:active {
        box-shadow: 0px 0px var(--main-color);
        transform: translate(3px, 3px);
    }

    .flip-card__btn {
        margin: 20px 0 20px 0;
        width: 120px;
        height: 40px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        background-color: var(--bg-color);
        box-shadow: 4px 4px var(--main-color);
        font-size: 17px;
        font-weight: 600;
        color: var(--font-color);
        cursor: pointer;
    }
</style>

</body>

</html>