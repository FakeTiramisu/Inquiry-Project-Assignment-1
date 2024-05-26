<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Management" />
    <meta name="keywords" content="HTML, CSS, PHP" />
    <meta name="author" content="nits" />
    <title>Job Application Management</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
<?php
function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

session_start();
include("header.inc");
include("menu.inc");

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

    if (isset($_POST["button3"]) && isset($_POST["Fname"]) && isset($_POST["Lname"])) {
        $Fname = sanitise_input($_POST["Fname"]);
        $Lname = sanitise_input($_POST["Lname"]);
        $query = "SELECT * FROM eoi WHERE First_name = ? AND Last_name = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $Fname, $Lname);
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
    
    <div class ="jobs_container">
    <div class="jobs_header">
    <h1 class="jobs_headertitle">Careers Management Portal</h1>
    </div>
        <div class="jobs_sidepanel">
        <h1 class="jobs_title">Portal Search</h1>
        <fieldset>
            <legend>List all EOIs:</legend>
            <form method="post" action="manage.php">
                <input type="submit" name="button1" value="List all EOI"/>
            </form>
        </fieldset>

        <fieldset>
        <legend>List according to job reference number:</legend>
        <form method="post" action="manage.php">
            <p><label for="jID">Job reference number</label>
            <input type="text" name="jID" id="jID" minlength="0" maxlength="5" placeholder="Must be valid Job number" required pattern="#[A-Z]{2}[0-9]{2}" />
            <input type="submit" name="button2" value="List all EOI for Reference number"/>
        </form>
    </fieldset>

        <fieldset>
            <legend>List EOIs by applicant name:</legend>
            <form method="post" action="manage.php">
                <p><label for="Fname">First name:</label>
                <input type="text" name="Fname" id="Fname" pattern="[A-Za-z]+" maxlength="20" required/>
                <label for="Lname">Last name:</label>
                <input type="text" name="Lname" id="Lname" pattern="[A-Za-z]+" maxlength="20" required/>
                <br><br>
                <input type="submit" name="button3" value="List all EOIs for this applicant">
            </form>
        </fieldset>

         <fieldset>
            <legend>Logout</legend>
            <form method="post" action="manage.php">
                <input type="submit" name="button6" value="Logout">
            </form>
        </fieldset>
        </div>

      


        <div class="jobs_mainpanel">
        <h1 class="jobs_title">Update EOI panel</h1>
        
        

        <fieldset>
            <legend>Delete all EOIs for job reference number:</legend>
            <form method="post" action="manage.php">
                <p><label for="jID">Job reference number</label>
                <input type="text" name="jID" id="jID" minlength="0" maxlength="5" placeholder="Must be valid Job number" required pattern="#[A-Z]{2}[0-9]{2}" />
                <input type="submit" name="button4" value="Delete all EOIs for Reference number"/>
            </form>
        </fieldset>

        <fieldset>
            <legend>Change status of an EOI</legend>
            <form method="post" action="manage.php">
                <p><label for="EOInumber">EOI number</label>
                <input type="text" name="EOInumber" id="EOInumber" required pattern="[0-9]+" />
                <p><label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="">Select status</option>
                    <option value="New">New</option>
                    <option value="Reviewed">Reviewed</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <input type="submit" name="button5" value="Change status">
            </form>
        </fieldset>

       
    </div>
    </div>
    ';
}
?>
</body>
</html>
