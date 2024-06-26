<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta name="description" content="YNC Finance Software | Do Your Finance Right">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author"   cotent="Ned Tonks">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Apply | YNC Finance Group</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <?php include_once "header.inc";?>                           
    <div class="fieldset-content">
    <fieldset class="fieldset_main">
        <legend>Job application page</legend>
    <form id="application" method="post" action="processEOI.php" novalidate="novalidate">
        <p><label for="Rnumber">Job reference number</label>
            <input type="text" name="reference" id="Rnumber" minlength="5" maxlength="5" size="5" required="required" />
        </p>
        <p><label for="Fname">First name
            <input type="text" name="firstname" id="Fname" maxlength="20" required="required" pattern="[a-zA-Z]+"/>
        </label></p>
        <p><label for="Lname">Last name
            <input type="text" name="lastname" id="Lname" maxlength="20" required="required" pattern="[a-zA-Z]+"/>
        </label></p>
        <p><label for="DOB">Date of birth
            <input type="date" name="dateofbirth" id="DOB" required="required" />
        </label></p>
        <fieldset class="fieldset_gender">
            <legend>Gender:</legend>
            <label class="radio_button" for="Male">
                <input type="radio" name="gender" id="Male" value="Male" checked="checked" required="required" />Male
            </label>
            <label class="radio_button" for="Female">
                <input type="radio" name="gender" id="Female" value="Female" checked="checked" required="required" />Female
            </label>
            <label class="radio_button" for="Other">
                <input type="radio" name="gender" id="Other" value="Other" checked="checked" required="required"/>Other
            </label>
        </fieldset>
        <p><label for="Address">Street Address
            <input type="text" name="address" id="Address" maxlength="40" required="required"/>
        </label></p>
        <p><label for="Suburb">Suburb/town
            <input type="text" name="suburb" id="Suburb" maxlength="40" required="required"/>
        </label></p>
        <p><label for="State">State
            <select name="state" id="State">
                <option value="VIC" selected="selected">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
            </select>
        </label></p>
        <p><label for="Postcode">Postcode
            <input type="text" name="postcode" id="Postcode" pattern="\d{4}" maxlength="4" required="required" />
        </label></p>
        <p><label for="Email">Email address
            <input type="email" name="email" id="Email" placeholder="Enter your email" required="required"/>
        </label></p>
        <p><label for="Phone">Phone number
            <input type="tel" name="phone" id="Phone" pattern="[0-9]{8,10}" maxlength=10 required="required"/>
        </label></p>
        <p class="skill_list">Skill list <br/>
            <label for="skill1"><input type="checkbox" name="skills1" id="skill1" value="PS" required="required"/>Problem Solving</label>
            <label for="skill2"><input type="checkbox" name="skills2" id="skill2" value="Teamwork" />Teamwork</label>
            <label for="skill3"><input type="checkbox" name="skills3" id="skill3" value="Communication" />Communication</label>
            <label for="skill4"><input type="checkbox" name="skills4" id="skill4" value="Leadership" />Leadership</label>
       </p>
       <p><label for="OSkills">Other skills
        <input type="text" name="OSkills" id="OSkills"/>
       </label></p>
       <p>
        <input class="button" type="submit" value="Apply"/>
        <input class="button" type="reset" value="Reset" />
       </p>
       
    </form>
</fieldset>
</div>
<hr>
<?php include_once "footer.inc";?>
</body>
</html>
