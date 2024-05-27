<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Register | Careers Management Portal | YNC Finance Group">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   content="Charmaigne Mamaril">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title> Careers Management Portal | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

session_start();
include("header.inc");
include("menu.inc");

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit("Direct access through URL detected. Script execution aborted.");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {        
        echo '<div class="container2">';
        echo '<h1>Manager Query Results</h1>';
        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db);
        
        if (!$connection) {
            echo '<p>Error connecting to database.</p>';
            exit();
        }

        function display_table($result) {
            echo "<table border=\"1\">\n";
            echo "<tr>
                    <th>EOInumber</th>
                    <th>Job Reference Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Street Address</th>
                    <th>Suburb/Town</th>
                    <th>State</th>
                    <th>Date of Birth</th>
                    <th>Postcode</th>
                    <th>Gender</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Status</th>
                  </tr>\n";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['EOInumber']}</td>
                        <td>{$row['Job_Reference_number']}</td>
                        <td>{$row['First_name']}</td>
                        <td>{$row['Last_name']}</td>
                        <td>{$row['Street_address']}</td>
                        <td>{$row['Suburb_town']}</td>
                        <td>{$row['State']}</td>
                        <td>{$row['Date_of_birth']}</td>
                        <td>{$row['Postcode']}</td>
                        <td>{$row['Gender']}</td>
                        <td>{$row['Email_address']}</td>
                        <td>{$row['Phone_number']}</td>
                        <td>{$row['Skills']}</td>
                        <td>{$row['Other_skills']}</td>
                        <td>{$row['Status']}</td>
                      </tr>\n";
                    }
                    echo "</table>\n";
                    // Add the return button below the table
                    echo '<br><br><a class="button" href="manage.php"> Return to Portal</a>';
                }

        if (isset($_POST["button1"])) {
            $query = "SELECT * FROM eoi";
            $result = mysqli_query($connection, $query);
            if ($result) {
                display_table($result);
                mysqli_free_result($result);
            } else {
                echo '<p>Something is wrong with the query.</p>';
            }
        }

        if (isset($_POST["button2"]) && isset($_POST["jID"])) {
            $jID = sanitise_input($_POST["jID"]);
            $query = "SELECT * FROM eoi WHERE Job_reference_number = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $jID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result) {
                display_table($result);
                mysqli_free_result($result);
            } else {
                echo '<p>Something is wrong with the query.</p>';
            }
            mysqli_stmt_close($stmt);
        }

        if (isset($_POST["button3"])) {
            $Fname = sanitise_input($_POST["Fname"]);
            $Lname = sanitise_input($_POST["Lname"]);
            
            if (!empty($Fname) && !empty($Lname)) {
                $query = "SELECT * FROM eoi WHERE First_name = ? AND Last_name = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "ss", $Fname, $Lname);
            } elseif (!empty($Fname)) {
                $query = "SELECT * FROM eoi WHERE First_name = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $Fname);
            } elseif (!empty($Lname)) {
                $query = "SELECT * FROM eoi WHERE Last_name = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $Lname);
            } else {
                echo '<p>Please enter at least a first name or last name.</p>';
                exit();
            }
            
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result) {
                display_table($result);
                mysqli_free_result($result);
            } else {
                echo '<p>Something is wrong with the query.</p>';
            }
            mysqli_stmt_close($stmt);
        }

        if (isset($_POST["button4"]) && isset($_POST["jID"])) {
            $jID = sanitise_input($_POST["jID"]);
            $delete_query = "DELETE FROM eoi WHERE Job_reference_number = ?";
            $stmt = mysqli_prepare($connection, $delete_query);
            mysqli_stmt_bind_param($stmt, "s", $jID);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo '<p>Records deleted successfully.</p>';
            } else {
                echo '<p>No records found for deletion.</p>';
            }
            mysqli_stmt_close($stmt);

            // Display remaining records
            $query = "SELECT * FROM eoi";
            $result = mysqli_query($connection, $query);
            if ($result) {
                display_table($result);
                mysqli_free_result($result);
            } else {
                echo '<p>Something is wrong with the query.</p>';
            }
        }

        if (isset($_POST["button5"]) && isset($_POST["EOInumber"]) && isset($_POST["status"])) {
            $EOInumber = sanitise_input($_POST["EOInumber"]);
            $status = sanitise_input($_POST["status"]);
            $query = "UPDATE eoi SET Status = ? WHERE EOInumber = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "si", $status, $EOInumber);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo '<p>Status updated successfully.</p>';
            } else {
                echo '<p>No records found for updating.</p>';
            }
            mysqli_stmt_close($stmt);

            // Display updated records
            $query = "SELECT * FROM eoi";
            $result = mysqli_query($connection, $query);
            if ($result) {
                display_table($result);
                mysqli_free_result($result);
            } else {
                echo '<p>Something is wrong with the query.</p>';
            }
        }

        if (isset($_POST["button6"])) {
            session_unset();
            session_destroy();
            header("location: logout.php");
            exit();
        }

        mysqli_close($connection);
        echo "</div>";
    } else {
        echo '

        <div class="jobs_container">
            <div class="jobs_header">
                <h1 class="jobs_headertitle">Careers Management Portal</h1>
            </div>
            <div class="jobs_sidepanel">
                <h1 class="jobs_title">Portal Search</h1>
                <br>
                <form method="post" action="manage.php">
                    <input type="submit" name="button1" value="List all EOI" class="button"/>
                </form>
                <br>
                <br>
                <h2>Search EOIs by job reference number</h2>
                <form method="post" action="manage.php">
                    <p><label for="jID">Job reference number</label><br><br>
                    <input type="text" name="jID" id="jID" minlength="0" maxlength="5" placeholder="Enter Job Ref. Number" required pattern="#[A-Z]{2}[0-9]{2}" />
                    <br><br>
                    <input type="submit" name="button2" value="Show all EOI for Reference number" class="button"/>
                </form>
                <hr>
                <h2>Search EOIs by applicant name</h2>
                <form method="post" action="manage.php">
                    <p><label for="Fname">First name:</label>
                    <input type="text" name="Fname" id="Fname" pattern="[A-Za-z]+" maxlength="20"/>
                    <label for="Lname">Last name:</label>
                    <input type="text" name="Lname" id="Lname" pattern="[A-Za-z]+" maxlength="20"/>
                    <br><br>
                    <input type="submit" name="button3" value="Show all EOIs for this applicant" class="button">
                </form>
                <br> 
                <br> 
                <hr>
                <br>
                <br>
                <form method="post" action="logout.php">
                    <input type="submit" name="button6" value="Log Out" class="button">
                </form>
            </div>
            <div class="jobs_mainpanel">
                <h1 class="jobs_title">EOI Update Panel</h1>
                <h2>Delete all EOIs for job reference number</h2>
                <form method="post" action="manage.php">
                    <p><label for="jID">Job reference number</label><br><br>
                    <input type="text" name="jID" id="jID" minlength="0" maxlength="5" placeholder="Enter Job Ref. Number" required pattern="#[A-Z]{2}[0-9]{2}" />
                    <br><br>
                    <input type="submit" name="button4" value="Delete all EOIs for Reference number" class="button"/>
                </form>
                <hr>
                <h2>Change EOI Status</h2>
                <form method="post" action="manage.php">
                    <p><label for="EOInumber">EOI number</label><br>
                    <input type="text" name="EOInumber" id="EOInumber" required pattern="[0-9]+" />
                    <p><label for="status">EOI Status:</label><br>
                    <select name="status" id="status" required>
                        <option value="">Select status</option>
                        <option value="New">New</option>
                        <option value="Reviewed">Reviewed</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <br><br>
                    <input type="submit" name="button5" value="Change status" class="button">
                </form>
            </div>
        </div>';
    }
}
?>
<?php include_once "footer.inc";?>
</body>
</html>
