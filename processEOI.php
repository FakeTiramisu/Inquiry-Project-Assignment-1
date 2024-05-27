<!--Note: Remove comment tags for php header link-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="EOI Form Submission">
    <meta name="keywords" content="PHP, MySQL, HTML">
    <meta name="author" content="Yoojin Ahn">
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <title>Application Confirmation</title>
</head>
<body>
    <h1>Application Confirmation</h1>
    <!-- Process PHP file -->
    <?php
    //define variables and set to empty values
    $refNum = $firstname = $lastname = $dob = $gender = $address = $suburb = "";
    $state = $postcode = $email = $phone = $otherSkills = "";

    $errMsg="";

    //Job Reference Number
    if(isset($_POST["reference"])){
        $refNum = $_POST["reference"];
    }
    else{
        $errMsg = "Reference Number is required.";
        header("location: apply.php");
    }

    //Firstname
    if(isset($_POST["firstname"])){
        $firstname = $_POST["firstname"];
    }
    else{
        $errMsg = "Firstname is required.";
        header("location: apply.php");  
    }

    //Lastname
    if(isset($_POST["lastname"])){
        $lastname = $_POST["lastname"];
    }
    else{
        $errMsg = "Lastname is required.";
        header("location: apply.php");  
    }

    //Date of Birth
    if(isset($_POST["dateofbirth"])){
        $dob = $_POST["dateofbirth"];
    }
    else{
        $errMsg = "Date of Birth is required.";
        header("location: apply.php");  
    }

    //Gender
    if(isset($_POST["gender"])){
        $gender = $_POST["gender"];
    }
    else{
        $errMsg = "Gender is required.";
        header("location: apply.php");  
    }

    //Address
    if(isset($_POST["address"])){
        $address = $_POST["address"];
    }
    else{
        $errMsg = "Address is required.";
        header("location: apply.php");  
    }

    //Suburb
    if(isset($_POST["suburb"])){
        $suburb = $_POST["suburb"];
    }
    else{
        $errMsg = "Suburb is required.";
        header("location: apply.php");  
    }

    //State
    if(isset($_POST["state"])){
        $state = $_POST["state"];
    }
    else{
        $errMsg = "State is required.";
        header("location: apply.php");  
    }

    //Postcode
    if(isset($_POST["postcode"])){
        $postcode = $_POST["postcode"];
    }
    else{
        $errMsg = "Postcode is required.";
        header("location: apply.php");  
    }
    //Email
    if(isset($_POST["email"])){
        $email = $_POST["email"];
    }
    else{
        $errMsg = "Email is required.";
        header("location: apply.php");  
    }
    //Phone
    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
    }
    else{
        $errMsg = "Phone is required.";
        header("location: apply.php");  
    }
    //Skills
    $skills="";
    if(isset($_POST["skills1"])) $skills = $skills ."Problem Solving, ";
    if(isset($_POST["skills2"])) {
        $skills .= "Teamwork, ";
    }
    if(isset($_POST["skills3"])) {
        $skills .= "Communication, ";
    }
    if(isset($_POST["skills4"])) {
        $skills .= "Leadership, ";
    }

    //Other Skills
    if(isset($_POST["OSkills"])){
        $otherSkills = $_POST["OSkills"];
    }
    else{
        $errMsg = "Other Skill is required.";
        header("location: apply.php");  
    }
    
    //Function that sanitizes data
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $refNum = sanitise_input($refNum);
    $firstname = sanitise_input($firstname);
    $lastname = sanitise_input($lastname);
    $dob = sanitise_input($dob);
    $gender = sanitise_input($gender);
    $address = sanitise_input($address);
    $suburb = sanitise_input($suburb);
    $state = sanitise_input($state);
    $postcode = sanitise_input($postcode);
    $email = sanitise_input($email);
    $phone = sanitise_input($phone);
    $otherSkills = sanitise_input($otherSkills);

    //Format Validation
    if(!preg_match("/^[a-zA-Z0-9]{5}$/", $refNum)){
        $errMsg .= "<p>Reference Number: Only 5-digit alphanum allowed</p>";
    }
    if(!preg_match("/^[a-zA-Z]{1,20}$/", $firstname)){
        $errMsg .= "<p>Firstname: Only 20 alphabetic-letters allowed</p>";
    }
    if(!preg_match("/^[a-zA-Z]{1,20}$/", $lastname)){
        $errMsg .= "<p>Lastname: Only 20 alphabetic-letters allowed</p>";
    }
    //Calculate Age
    $thisYear = date("Y");
    $thisMonth = date("F");
    $dob_year = date('Y', strtotime($dob));
    $dob_month = date('F', strtotime($dob));
    $age = $thisYear-$dob_year;
    if($age < 15 || $age > 80){
        if($dob_month > $thisMonth){
            $errMsg .= "<p>Must be age between 15 to 80</p>";
        }
    }
    if($gender==""){
        $errMsg .= "<p>Gender is required</p>";
    }
    if(!preg_match("/^[a-zA-Z0-9-\/ ]{1,40}$/", $address)){
        $errMsg .= "<p>Invalid address</p>";
    }
    if(!preg_match("/^[a-zA-Z0-9-\/ ]{1,40}$/", $suburb)){
        $errMsg .= "<p>Invalid suburb</p>";
    }
    
    //Create an array of states
    $stateArray = array("VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT");

    //State and postcode matching
    if(!(in_array($state, $stateArray))) {
        $errMsg .= "<p>Invalid state</p>";
    }
    if(!preg_match("/^[\d]{4}$/", $postcode)){
        $errMsg .= "<p>Invalid postcode</p>";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errMsg .= "<p>Invalid email</p>";
    }
    if(!preg_match("/^[0-9 ]{8,12}$/", $phone)){
        $errMsg .= "<p>Invalid phone number</p>";
    }
    if($skills != "" && $otherSkills == ""){
        $errMsg .= "<p>Other Skills: Required</p>";
    }
    //Check whether there any error messages
    if($errMsg!="") {
        echo"<p>$errMsg</p>";
        echo "<p>Please go back to Application Page to submit the form again.</p>";
    }
    else{
        echo "<p>Thank you $firstname $lastname, your booking has been confirmed! <br>
        Below are your application details: <br>
        Reference #$refNum <br>
        DOB: $dob <br>
        Gender: $gender <br>
        Address: $address $suburb, $state, $postcode <br>
        Email: $email <br>
        Contact Number: $phone <br>
        Skills: $skills <br>
        Other Skills: $otherSkills  </p>"; 

        //Database Integration 
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user,$pwd,$sql_db);
            //Check if connection is successful
        if($conn){ 
            //SQL command
            $query = "INSERT INTO `eoi`(`Job_Reference_number`, `First_name`, `Last_name`, `Date_of_birth`, `Gender`, `Street_address`, `Suburb_town`, `State`, `Postcode`, `Email_address`, `Phone_number`, `Skills`, `Other_skills`) 
            VALUES ('$refNum','$firstname','$lastname','$dob','$gender','$address','$suburb','$state','$postcode','$email','$phone','$skills','$otherSkills')";
            
            //execute query and store result pointer
            $result = mysqli_query($conn, $query);
                
            //Check if execution successful
            if(!$result) {
                //echo "<p class=\"wrong\">Somethin is wrong with ", $query, "</p>";
                echo "<p>Confirmation unsuccessful. Please try again.</p>";
            } else{
                //Display the retrieved records
                //echo "<p class=\"ok\">Succesfully added New Card record</p>";
                echo "<p>Confirmation Successful. Thank you!</p>";
            }
            //Close database connection
            mysqli_close($conn);
        } else{
            //Display error message
            die ("<p>Database connection failure</p>") ; 
        }                  
    }
    ?>
    </body>
</html>
