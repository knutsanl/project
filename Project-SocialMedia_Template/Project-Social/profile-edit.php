<?php
require_once "classes/class_Profile.php";
/* On this page, you will allow the current logged in user to update their respective data in the 'userDetails' table on the database. 

The changes that they can do will include, changing their names, Date of Birth, Gender, Profile picture. 

You are free to decide how you will implement this. 



*/


?>

<!DOCTYPE html>
    <html>
    <head>
        <title> edit profile </title>
    </head>
    <body>
        <h3> Update your profile info </h3>
        <form id="updateProfile">
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br>
            <label for="DOB">Date of birth:</label><br>
            <input type="text" id="DOB" name="DOB"><br>
            <input type="radio" id="male" name="gender" value="Male">
            <label for="male"> Male </label><br>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female"> Female </label> <br><br>
            <!-- Here I need to add for profile picture-->
            <input type="submit" value="submit">
        </form>

    

    </body>
</html>
