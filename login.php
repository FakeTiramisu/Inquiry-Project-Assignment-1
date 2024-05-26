<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login Page">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="nits">
    <title>Login</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
<?php
session_start();

function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitise_input($_POST['username']);
    $password = sanitise_input($_POST['password']);

    // Hardcoded credentials (for demonstration purposes only)
    $valid_username = "manager";
    $valid_password = "password123";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["login"] = true;
        header("location: manage.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<div class="container">
    <h1>Login</h1>
    <form method="post" action="login.php">
        <fieldset>
            <legend>Login Credentials</legend>
            <p><label for="username">Username:</label>
            <input type="text" name="username" id="username" required></p>
            <p><label for="password">Password:</label>
            <input type="password" name="password" id="password" required></p>
            <input type="submit" value="Login">
        </fieldset>
    </form>
    <?php
    if ($error !== "") {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
</div>
</body>
</html>
