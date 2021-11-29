<?php
require_once "class_Database.php";
class User extends Database {
    
    //acquired properties on register
    protected $firstname;
    protected $lastname;
    protected $email;
    private   $password;
    //derived properties
    private   $userID;
    
    //other properties
    protected $DOB; //date of birth
    protected $gender; // 0 for male, 1 for female
    protected $profilePictureID; 

    function __construct($firstname,$lastname,$email,$password){
        // echo "USER : Constructor!<br>";
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->email     = $email;
        $this->password  = $password;                 
    }

    // create User methods
    protected function createUser($firstname,$lastname){
        echo "User : In createUser<br>";
        echo "userID :   $this->userID <br>";
        echo "email :    $this->email<br>";
        echo "password : $this->password <br>";
        // sanitize input
        $firstname = $this->cleanVar($firstname, $conn);
        $lastname  = $this->cleanVar($lastname, $conn);
        $email     = $this->cleanVar($this->email, $conn);

        $this->generateUserID($firstname,$lastname);      
        $conn = Database::connect();
        // uper case first letter
        $firstname = ucfirst($firstname);
        $lastname  = ucfirst($lastname);

        $userID   =  $this->userID;
        $email    =  $this->email;
        $password =  $this->password;
        // Hashed password to make it secure
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Inserting user details into users and userdetails tables
        $queryUsers         = "INSERT INTO users (user_id,email,password)";
        $queryUserdetails   = "INSERT INTO userdetails (user_id,firstname,lastname)";
        $queryUsers        .= "VALUES ('$userID','$email','$hashedPassword')";
        $queryUserdetails  .= "VALUES ('$userID','$firstname','$lastname')";
        $resultUsers        = mysqli_query($conn, $queryUsers);
        $resultUserdetails  = mysqli_query($conn, $queryUserdetails);
        // checking if the query not failed
        if(!$resultUsers || !$resultUserdetails){
            die('Query failed ' . mysqli_error($conn));
        }else{
            // echo 'success <br>';
        }
        Database::disconnect($conn);  
    }

    public static function loginUser($username,$password){
        //echo "USER : LoginUser!<br>";
        //This function will allow an existing user to log in, based on input username and input password. 
        //will essentially involve checking if the input password and the hashed password from the database, match. 
        //Should return TRUE if the login was successful, or FALSE otherwise. 
        $conn = Database::connect();
        $doesPasswordMatch = FALSE;
        $userdetails = [];
        // selecting user details from users and userdetails table
        $query = "SELECT * FROM users, userdetails WHERE 
        users.user_id='$username' AND userdetails.user_id ='$username'
        OR email='$username' AND users.user_id = userdetails.user_id";
        // result of the query
        $result = mysqli_query($conn, $query);
        
        if(!$result){
            die('Query failed ' . mysqli_error($conn));
        }else{
            //  fetching a result row as an associative array
            $userdetails = mysqli_fetch_assoc($result);
            $userPassword = $userdetails['password'];
            // verify that given hash matches the user password
            if(password_verify($password, $userPassword)){
                // password match 
                $doesPasswordMatch = TRUE;
            }
         }
       Database::disconnect($conn);  
       // return associative array with login status and user details
       return array("isLoggedIn" => $doesPasswordMatch, "userdetails"=>$userdetails);
    }
    

    // gernarating user id
    protected function generateUserID($firstname,$lastname){
        echo "User : In generateUsername<br>";
        $str1 = substr($firstname, 0, 2); // first 2 letters of firstname
        $str1 .= substr($lastname, 0, 3); // first 3 letters of lastname
        $string = strtolower($str1); // making lowercase
        
        $isUserIDUnique = FALSE;
        $idx = 0;
        while ($isUserIDUnique == FALSE){
            $userID = $string . rand(0,9); // appending a random digit.
            $userID .= rand(0,9); // appending a random digit.
            
            $isUserIDUnique = $this->checkIfUserIDUnique($userID);
            $idx++;
            
            if($idx >100){
                echo "No unique user ID could be generated!";
                break;
            }
        }
        
        $this->userID = $userID;
        
    }
    
    protected function checkIfUserIDUnique($userID){
    /* write a function that checks on the database to see if the generated userID is unique. The function should return TRUE if generated userID is indeed unique, or FALSE otherwise. 
    */  
         $userID = $this->userID;
         // connecting to the database
         $conn = Database::connect();
    
        // Select user id from users table
        $query = "SELECT * FROM users WHERE user_id = '$userID'";
         // querying the database
        $result = mysqli_query($conn, $query);
        $userID = mysqli_num_rows($result);
         
         if(!$result){
             die('Query failed ' . mysqli_error($conn));
         }
         Database::disconnect($conn);
         return $userID;
    }

        
    // Database methods
    // adding user into database
    protected function addUserEntryinDB(){
        $firstname = $this->firstname;
        $lastname  = $this->lastname;
        $this->createUser($firstname,$lastname); 
    }

    public function saveUser(){
           $this->addUserEntryinDB();
           header("Location: login.php");
           exit();
    }
    
    protected function updateUserPassword(){
    // function to update password 
    }

    // Check if account exists
    public function isAccountExists($email){
        // connecting to the database
        $conn = Database::connect();
        // Select email from users table
        $query = "SELECT * FROM users WHERE email = '$email'";
        // querying the database
        $result = mysqli_query($conn, $query);
        $checkEmail = mysqli_num_rows($result);
        
        if(!$result){
            die('Query failed ' . mysqli_error($conn));
        }
        Database::disconnect($conn);
        return $checkEmail;
      }
}//end class

?>
