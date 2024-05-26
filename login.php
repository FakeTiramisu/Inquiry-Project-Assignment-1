<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Log In | Careers Management Portal | YNC Finance Group">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   content="Charmaigne Mamaril">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Log In | Careers Management Portal | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
session_start();
include("header.inc");
include("menu.inc");
require_once("settings.php");


// Include the password_compat library for older PHP versions
require_once("lib/password.php");

$errors = [];
$login_attempts = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($login_attempts >= 3) {
        $errors[] = "Too many invalid login attempts. Please try again later.";
    } else {
        $username = sanitise_input($_POST['username']);
        $password = sanitise_input($_POST['password']);

        if (empty($username) || empty($password)) {
            $errors[] = "All fields are required.";
        } else {
            $connection = @mysqli_connect($host, $user, $pwd, $sql_db);

            if (!$connection) {
                $errors[] = "Error connecting to database.";
            } else {
                $query = "SELECT * FROM managers WHERE username = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $username;
                        $_SESSION['login_attempts'] = 0;
                        header("Location: manage.php");
                        exit();
                    } else {
                        $errors[] = "Invalid username or password.";
                        $_SESSION['login_attempts'] = ++$login_attempts;
                    }
                } else {
                    $errors[] = "Invalid username or password.";
                    $_SESSION['login_attempts'] = ++$login_attempts;
                }

                mysqli_stmt_close($stmt);
            }

            mysqli_close($connection);
        }
    }
}

function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>


<div class="jobs_container">

     <div class="jobs_header">
                <h1 class="jobs_headertitle">Careers Management Portal</h1>
            </div>

    <div class="jobs_sidepanel">
    <h1 class="jobs_title">Careers Management Portal</h1>
        <h3> Use this portal to manage </h3> 
        <ul class="job_info2">
        <li>Expressions of Interests</li>
        <li>Expression of Interest Applications</li>
        <li>Existing Job listings</li>
        </ul>

        <h3> If not already registered for the Careers Management Portal </h3>
        <h3>Please click below to register </h3>
        <a class="button" href="register.php"> Register</a>
</div>

    
    <div class="jobs_mainpanel">
    <h1 class="jobs_title">Sign into YNC Careers Management Portal</h1>
    <?php
    if (!empty($errors)) {
        echo '<ul class="errors">';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    }
    ?>
    <form method="post" action="login.php">
        <h4>Username:</h4>
        <input type="text" name="username" id="username" required pattern="[a-zA-Z0-9_]{5,}">
        <h4>Password:</h4>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Login" class="button">
    </form>
</div>
</div>
<?php include_once "footer.inc";?>
</body>
</html>
