<?php 
require_once "classes/class_User.php";
session_start();

//Registration Page. 
/*
Here you should create a form for user registration, where the user can create a new account. 
Step 1 
The form should have 5 input fields and 1 button :
1. First name
2. Surname
3. email
4. password
5. confirm password
6. Register button
Upon click, should send the data to the backend for validation 
Step 2 : Validation of data
a. Check that all input fields are not empty, else prompt the user to fill all fields.
b. Validation on password : 
Check that the length of the input password is atleast 8 characters long. 
The input in the 'password' field should match the input in the 'confirm password' field, else prompt the user. 
c. Check if account exists:
Using the input email, check if the latter already exists on the database. 
If it is, prompt the user to use a different email. 
HINT : You could add a static method in the user class definition to do that. 
The method should only take 1 argument as input, which is the input email from the field. 

Step 3 : Account creation
If validation was successful, create a new user on the database. Use the user class object to do that. 

Step 4 : Display a redirect link to the login page, where the user can now login into their newly created account. 
*/

// Keep input field value empty when loading the page 
$firstName = $surName = $email = $password = $confirmPassword = '';
// Array to update errors if there are errors. Keep the value empty and update it with error
$errors = ['firstname'=>'','surname'=>'','email'=>'','password'=>'','confirmpassword'=>'', 'emailExist'=>''];
// redirect to test.php
if(isset($_SESSION['isLoggedIn'])){
    if(!isset($_POST['submit'])){
        header('Location: test.php');
        exit();
      }
}

// check if the form has been submitted
if(isset($_POST['submit'])){
    $firstName        = $_POST['firstname'];
    $surName          = $_POST['surname'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $confirmPassword  = $_POST['confirmpassword'];
    $user = new User($firstName, $surName, $email, $password); 

    
    // Check that all input fields are not empty
    // Check if first name not empty 
    if(empty($firstName)){
        $errors['firstname'] = 'First Name can not be empty';
    }
    // Check Surname
    if(empty($surName)){
        $errors['surname'] =  'Surname can not be empty';
    }
    // Check email
    if(empty($email)){
        $errors['email'] = 'Email can not be empty';
    }else{
        // check if valid email address
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] =  'Enter valid email address';
        }
    }
    // Check password
    if(empty($password)){
        $errors['password'] = 'Password can not be empty';
    }elseif(strlen($password) < 8){
        $errors['password'] =  'Password can not be less than 8 characters';
    }elseif($password != $confirmPassword){
        $errors['confirmpassword'] = 'Password should match';
    }
    if(empty($confirmPassword)){
        $errors['confirmpassword'] = 'Confirm password can not be empty';
    }
     // check if there is an error by cycling through the array and perfome a call back
     if(array_filter($errors)){
        // echo 'error in the form';
    }else{
        if(!$user->isAccountExists($email)){
            $user->saveUser();
        }else{
            $errors['emailExist'] = 'Email already exists please use a different email';
        } 
    }
   
}// end of the POST check

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css?v=<?php echo time()?>">
    <title>Sign Up</title>
</head>
<body>
    <div id="main">
        <h1>Sign Up</h1>
    <!-- registeration form -->
        <form method="post">
            <span class="details">First Name</span> 
            <input type="text" name="firstname" placeholder="Enter your first name" value="<?php echo $firstName // saving the value that the user entered?>" autofocus>
            <span style="color:red;margin-top:5px;"><?php echo $errors['firstname']?></span>
            <span class="details">Surname</span> 
            <input type="text" name="surname" placeholder="Enter your last username" value="<?php echo $surName?>">
            <span style="color:red;margin-top:5px;"><?php echo $errors['surname']?></span>
            <span class="details">Email</span> 
            <input type="text" name="email" placeholder="Enter your email" value="<?php echo $email?>">
            <span style="color:red;margin-top:5px;"><?php echo $errors['email']; ?></span>
            <span style="color:red;margin-top:5px;margin-left:-5px;"><?php echo $errors['emailExist']; ?></span>
            <span class="details">Password </span> 
            <input type="password" name="password" placeholder="Enter password" value="<?php echo $password?>">
            <span style="color:red;margin-top:5px;"><?php echo $errors['password']?></span>
            <span class="details">Confirm Password</span> 
            <input type="password" name="confirmpassword" placeholder="confirm password" value="<?php echo $confirmPassword?>">
            <span style="color:red;margin-top:5px;"><?php echo $errors['confirmpassword']?></span>
            <span class="details"></span> 
            <button name="submit" style="cursor:pointer">Sign Up</button>
            <span>Already have an account?</span> 
            <button><a href="login.php">Sign in</a></button> 
            <!-- <input type="submit" name="submit" value="Sign Up"> -->
        </form>
    </div>
    
</body>
</html>
