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
        echo"<p>This is a test: Your ref number is $refNum</p>";
    }
    else{
        $errMsg = "Reference Number is required.";
        header("location: apply.php");
    }

    //Firstname
    if(isset($_POST["firstname"])){
        $firstname = $_POST["firstname"];
        echo"<p>This is a test: Your firstname is $firstname</p>";
    }
    else{
        $errMsg = "Firstname is required.";
        header("location: apply.php");  
    }

    //Lastname
    if(isset($_POST["lastname"])){
        $lastname = $_POST["lastname"];
        echo"<p>This is a test: Your last name is $lastname</p>";
    }
    else{
        $errMsg = "Lastname is required.";
        header("location: apply.php");  
    }

    //Date of Birth
    if(isset($_POST["dateofbirth"])){
        $dob = $_POST["dateofbirth"];
        echo"<p>This is a test: Your date of birth is $dob</p>";
    }
    else{
        $errMsg = "Date of Birth is required.";
        header("location: apply.php");  
    }

    //Gender
    if(isset($_POST["gender"])){
        $gender = $_POST["gender"];
        echo"<p>This is a test: Your gender is $gender</p>";
    }
    else{
        $errMsg = "Gender is required.";
        header("location: apply.php");  
    }

    //Address
    if(isset($_POST["address"])){
        $address = $_POST["address"];
        echo"<p>This is a test: Your address is $address</p>";
    }
    else{
        $errMsg = "Address is required.";
        header("location: apply.php");  
    }

    //Suburb
    if(isset($_POST["suburb"])){
        $suburb = $_POST["suburb"];
        echo"<p>This is a test: Your suburb is $suburb</p>";
    }
    else{
        $errMsg = "Suburb is required.";
        header("location: apply.php");  
    }

    //State
    if(isset($_POST["state"])){
        $state = $_POST["state"];
        echo"<p>This is a test: Your state is $state</p>";
    }
    else{
        $errMsg = "State is required.";
        header("location: apply.php");  
    }

    //Postcode
    if(isset($_POST["postcode"])){
        $postcode = $_POST["postcode"];
        echo"<p>This is a test: Your postcode is $postcode</p>";
    }
    else{
        $errMsg = "Postcode is required.";
        header("location: apply.php");  
    }
    //Email
    if(isset($_POST["email"])){
        $email = $_POST["email"];
        echo"<p>This is a test: Your email is $email</p>";
    }
    else{
        $errMsg = "Email is required.";
        header("location: apply.php");  
    }
    //Phone
    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
        echo"<p>This is a test: Your phone is $phone</p>";
    }
    else{
        $errMsg = "Phone is required.";
        header("location: apply.php");  
    }
    //Skills
    $skill="";
    if(isset($_POST["skills1"])) $skills .= "Problem Solving, ";
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
        echo"<p>This is a test: Your other skills is/are $otherSkills</p>";
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
        $errMsg = "Only 5-digit alphanum allowed";
    }
    if(!preg_match("/^[a-zA-Z]{20}$/", $firstname)){
        $errMsg = "Only 20 characters allowed";
    }
    if(!preg_match("/^[a-zA-Z]{20}$/", $lastname)){
        $errMsg = "Only 20 characters allowed";
    }
    //Calculate Age
    $thisYear = date("Y");
    $thisMonth = date("F");
    $birthYear = date("Y", $dob);
    $birthMonth = date("F", $dob);
    $age = $thisYear-$birthYear;
    if($age < 15 || $age > 80){
        if($birthMonth > $thisMonth){
            $errMsg = "Must be age between 15 to 80";
        }
    }
    if($gender==""){
        $errMsg = "Gender is required";
    }
    if(!preg_match("/^[a-zA-Z0-9-\/ ]{1,40}$/", $address)){
        $errMsg = "Invalid address";
    }
    if(!preg_match("/^[a-zA-Z0-9-\/ ]{1,40}$/", $suburb)){
        $errMsg = "Invalid suburb";
    }
    //State and postcode matching
    if($state != "VIC" || $state != "NSW" || $state != "QLD" || $state != "NT" || 
    $state != "WA" || $state != "SA" || $state != "TAS" || $state != "ACT") {
        $errMsg = "Invalid state";
    }
    if(!preg_match("/^[\d]{4}$/", $postcode)){
        $errMsg = "Invalid postcode";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errMsg = "Invalid email";
    }
    if(!preg_match("/^[0-9 ]{8,12}$/", $phone)){
        $errMsg = "Invalid suburb";
    }
    if($skills != "" && $otherSkills == ""){
        $errMsg = "Required";
    }

    //Check whether there any error messages
    if($errMsg!="") {
        echo"<p>$errMsg</p>";
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
        Other Skills: $otherSkills <br>
        Number of Travellers: $partySize</p>";                  
    }
    ?>

</body>
</html>
