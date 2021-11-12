<?php
require_once "class_Database.php";

class Profile extends Database{
   protected $UserID, $isLoggedIn;

    function __construct($userID, $isLoggedIn){
         $this->userID = $userID; //$userID is collected from the session
         $this->isLoggedIn = $isLoggedIn;//isLoggedIn collected from session

    }
    
   /* function displayPerson($UserID){
        $connection = Database::connect()
        

    $query = 'SELECT * FROM userdetails WHERE user_id=1';
    $result = mysqli_query($connection, $query);
    print_r($result);
        Database::disconnect($connection);
    }
   */
    function displayProfile(){
        //Runs retrieveUserDetails method 
      $this->retrieveUserDetails();

        //Write code to display assoc array
    
     /*  $connection = Database::connect();
       
   if(!$result){
                die('User data retrieval failed' . mysqli_error($connection));
            }else{
                echo "user data retrieved <br><br>";
            }*/
            Database::disconnect($connection);  
    }
    //Change format to store in assoc array to display
    function retrieveUserDetails($UserID){
        $connection = Database::connect();
            echo "Denne funket";
            //gets info from DB. || Change users to userdetails when DB is filled
            $query = 'SELECT * FROM users WHERE user_id=$userID';
            
            //result stores data from query
            $result = mysqli_query($connection, $query);

            if(!$result){
                die('User data retrieval failed' . mysqli_error($connection));
            }else{
                echo "user data retrieved <br><br>";
            }
            print_r($result);
            Database::disconnect($connection);  
    }
     function displayEditProfileButton(){
       $connection = Database::connect();

        Database::disconnect($connection);
    }
     function displayAddFriendButton(){
        $connection = Database::connect($connection);

        Database::disconnect($connection);
    }
     function displayDeleteFriendButton(){
        $connection = Database::connect();

        Database::disconnect($connection);
    }
     function updateUserDetails($firstname, $lastname, $DOB, $gender, $profilePicture){
        $connection = Database::connect();
        
       /*
        $query  = 'INSERT INTO userdetails (firstname, lastname, DOB, gender, profilePicture)';
        $query .= "VALUES ('$firstname_cleaned', '$lastname_cleaned', '$DOB_cleaned', '$gender_cleaned', '$profilePicture_cleaned')"; 
        $result = mysqli_query($connection, $query);


        if(!$result){
            die('User details were not updated' . mysqli_error($connection));
        }else{
            echo "user details updated <br><br>";
        }
        disconnect($connection);  
*/ 
        Database::disconnect($connection);
    } 

}


//displayPerson($UserID);



// class definition for Profile goes in here

/*

initial properties :
userID
isLoggedIn

acquired properties :
firstname 
lastname
email
DOB (date of birth)
gender
profilePictureID

Methods to include :
-constructor
to assign values into the userID and isLoggedIn properties. 

-displayProfile()
calls retrievesUserDetails($userID) displays data on profile. 

- retrieveUserDetails()
make query to database to retrieve the userDetails based on the userID and login status(property isLoggedIn)
SELECT * FROM userdetails WHERE user
- displayEditProfilebutton()
displays a form button that says 'Edit Profile'. Upon clicking, should navigate to profile-edit.php page.  

- displayAddFriendButton()
displays a form button that says 'Add friend'. Upon clicking, should call the Add Friend method from the 'Friends' class. 

- displayDeleteFriendButton()
displays a form button that says 'Deletefriend'. Upon clicking, should call the Delete Friend method from the 'Friends' class.

- updateUserDetails()
Make a query to update user data on database. 



*/




?>