<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta name="description" content="YNC Finance Software | Do Your Finance Right">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   cotent="Charmaigne Mamaril">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>PHP Enhancements | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <?php include_once "header.inc";?>
    <main>
        <article class="resource">
            <h2>Enhancement 1: Manager Registration Page with server side validation </h2>
            <p>Created a manager registration page with server-side validation requiring a unique username and a password rule, and stored this information in a table. <br>
            This was done by utilizing a password compatability library, which was implemented through the addition of a password.php file. <br>
            The use of a libary was made to ensure that our application could use the latest and most secure password hashing algorithms provided by PHP, even if we were to work <br>
            with an older version of PHP that doesn't natively support these algorithms. 
    
            </p>
            <a class="button" href="register.php">Go to the Enhancement</a>
            <p>Resources for Registration Page/Password Validation Information</p>
            <a class="button" target="_blank" href="https://github.com/ircmaxell/password_compat">Resource 1</a>

        </article>
        <article class="resource">
            <h2>Enhancement 2: Controlled access to manage.php by checking username and password.</h2>
            <p>Controlled access to manage.html by checking the username and password through the addition of a login page. 
            Users are automatically redirected to login.php if: </p>
            <ul class="job_info2">
            <li> An attempt to access manage.php through direct URL is detected</li> 
</ul>


            <p>Furthermore, access to manage.php is restricted for a period of time  after three or more invalid/unsuccessful login attempts.<br> 
            Password validation was again aided by utilizing a password compatibility library, which was implemented through the addition of a password.php file. <br>
            As explained in detail above, this was to improve compatibility and enhance security of the application by leveraging more modern cryptographic standards.
            </p>
            <a class="button" href="manage.php">Go to the Enhancement</a>
            <p>Resources for the Controlled access to manage & Password Validation</p>
            <a class="button" target="_blank" href="https://github.com/ircmaxell/password_compat">Resource 1</a>
        </article>
        <article class="resource">
            <h2>Enhancement 3: Logout page</h2>
            <p>
            Created a logout page with a link from the management webpage. Ensured the management site could not be accessed directly using its URL after logging out.
            </p>                                                                    
            <a class="button" href="manage.php"> Go to Enhancement</a>
            <p>Resources used to create logout page</p>   
            <a class="button" target="_blank" href="https://css-tricks.com/snippets/css/complete-guide-grid/">Resource 1</a>
        </article>
    </main>
    <hr>
    <?php include_once "footer.inc";?>
</body>
</html>

