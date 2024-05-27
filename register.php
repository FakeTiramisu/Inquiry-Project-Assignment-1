<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Register | Careers Management Portal | YNC Finance Group">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   content="Charmaigne Mamaril">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Register | Careers Management Portal | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("header.inc");
require_once("settings.php");
require_once("lib/password.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitise_input($_POST['username']);
    $password = sanitise_input($_POST['password']);
    $confirm_password = sanitise_input($_POST['confirm_password']);

    // Server-side validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } else {
        // Validate username format
        if (!preg_match("/^[a-zA-Z0-9_]{5,}$/", $username)) {
            $errors[] = "Username must be at least 5 characters long and contain only letters, numbers, and underscores.";
        }

        // Validate password and confirmation match
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }

        // Validate password strength
        if (!preg_match("/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
            $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter and one number.";
        }
    }

    if (empty($errors)) {
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$connection) {
            $errors[] = "Error connecting to database: " . mysqli_connect_error();
        } else {
            $username_check_query = "SELECT * FROM managers WHERE username = ?";
            $stmt = mysqli_prepare($connection, $username_check_query);
            if ($stmt === false) {
                $errors[] = "Failed to prepare statement (username check): " . mysqli_error($connection);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $errors[] = "Username '$username' is already taken.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $insert_query = "INSERT INTO managers (username, password) VALUES (?, ?)";
                    $stmt = mysqli_prepare($connection, $insert_query);
                    if ($stmt === false) {
                        $errors[] = "Failed to prepare statement (insert): " . mysqli_error($connection);
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
                        mysqli_stmt_execute($stmt);

                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            $_SESSION["message"] = "Registration successful! You can now log in.";
                            header("Location: login.php");
                            exit();
                        } else {
                            $errors[] = "Error during registration (execute): " . mysqli_error($connection);
                        }
                    }
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($connection);
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
        <h2> Register now to gain access to:</h2>
        <ul class="job_info2">
        <li>Expressions of Interests</li>
        <li>Expression of Interest Applications</li>
        <li>Existing Job listings</li>
        </ul>

    <h3>If you're already registered -  </h3>
    <h3>Please click below to log into the careers management portal</h3>
    <br>
        <a class="button" href="login.php"> Log in</a>
</div>

    
    <div class="jobs_mainpanel">
    <h1 class="jobs_title">New Manager Registration</h1>
    <h2>Create user log in details to access YNC Careers Management Portal</h2>
    <?php
    if (!empty($errors)) {
        echo '<ul class="errors">';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    }
    ?>
    <form method="post" action="register.php">
        <h4>Username:</h4>
        <input type="text" name="username" id="username" required pattern="[a-zA-Z0-9_]{5,}">
    
        <h4>Password:</h4>
        <input type="password" name="password" id="password" required>
        <br>
        <h4>Confirm Password:</h4>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br><br>
        <input type="submit" value="Register" class="button">
    </form>
  </div>
</div>
<?php include_once "footer.inc";?>
</body>
</html>
