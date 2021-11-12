<?php
// Start the session
session_start();

require_once "class_Database.php";
class User extends Database {
    
    //acquired properties on register
    protected $firstname;
    protected $lastname;
    protected $email;
    private $password;
    //derived properties
    private $userID;
    
    //other properties
    protected $DOB; //date of birth
    protected $gender; // 0 for male, 1 for female
    protected $profilePictureID; 

    
    function __construct($firstname,$lastname,$email,$password){
        
        // echo "USER : Constructor!<br>";
        
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        
                        
    }
    // create User methods
    protected function createUser($firstname,$lastname){
        echo "User : In createUser<br>";
        
        $this->generateUserID($firstname,$lastname);
                
        echo "userID : $this->userID <br>";
        echo "email : $this->email<br>";
        echo "password : $this->password <br>";
        
    }
    
    public static function loginUser($username,$password){
        //echo "USER : LoginUser!<br>";
        //This function will allow an existing user to log in, based on input username and input password. 
        //will essentially involve checking if the input password and the hashed password from the database, match. 
        //Should return TRUE if the login was successful, or FALSE otherwise. 
        $conn = Database::connect();
        // reading from database
        $query = "SELECT * FROM users, userdetails WHERE 
        users.user_id='$username' AND userdetails.user_id ='$username'
        OR email='$username' AND users.user_id = userdetails.user_id";
        // result of the query
        $result = mysqli_query($conn, $query);
        // check success of the result and
        // checking if have we have result
        if($result && mysqli_num_rows($result) > 0){
            //  fetching a result row as an associative array
            $userData = mysqli_fetch_assoc($result);
            $userPassword = $userData['password'];
            // verify that given hash matches the user password
            if(password_verify($password, $userPassword)){
                // setting session variables
                 $_SESSION['user_id']   = $userData['user_id'];
                 $_SESSION['email']     = $userData['email'];
                 $_SESSION['firstname'] = $userData['firstname'];
                 $_SESSION['lastname']  = $userData['lastname'];
                 $_SESSION['useragent']  =  $_SERVER['HTTP_USER_AGENT'];
                 $_SESSION['ip']        = $_SERVER['REMOTE_ADDR'];
                 $_SESSION['isLogedIn'] = TRUE;
                 
                echo $_SESSION['user_id'] . '<br>';
                echo $_SESSION['email'] . '<br>';
                echo 'Your first name is '.$_SESSION['firstname'] . '<br>';
                echo 'Your last name is '. $_SESSION['lastname'] . '<br>';
                echo 'Your user agent is '. $_SESSION['useragent'] . '<br>';
                echo $_SESSION['ip']; 
                }else{
                    // if password does not match
                    echo "<span style='color:red;display:block;margin-left:42%;padding-top:100px;'>Wrong password! Please try again</span>";
            }
        }else{
            echo "<span style='color:red;display:block;margin-left:42%;padding-top:100px;'>Not a valid user name or email address</span>";
        }
        Database::disconnect($conn);  
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
        
    }

        
    // Database methods
    protected function addUserEntryinDB(){
        $conn = Database::connect();
        // uper case first letter
        $firstname = ucfirst($this->firstname);
        $lastname = ucfirst($this->lastname);
        // Hashed password to make it secure
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->generateUserID($firstname,$lastname);
        // Inserting user details into the database
        $query = "INSERT INTO users (user_id,email,password)";
        $query2 = "INSERT INTO userdetails (user_id,firstname,lastname)";
        $query .= "VALUES ('$this->userID','$this->email','$hashed_password')";
        $query2 .= "VALUES ('$this->userID','$firstname','$lastname')";
        $result = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);
        // checking if the query success
        if(!$result || !$result2){
            die('User creation failed ' . mysqli_error($conn));
        }else{
            echo 'New user created <br>';
        }
        Database::disconnect($conn);
    }
    
    protected function updateUserPassword(){
    // function to update password 
    }

    // Check if account exists
     public function isAccountExists($email){
        // connecting to the database
        $conn = Database::connect();
        $checkUserEmail = $email;
        // Query the database if the email already exist
        $query = "SELECT * FROM users WHERE email = '$checkUserEmail'";
        // querying the database
        $result = mysqli_query($conn, $query);
        
        if(!$result){
            die('User creation failed ' . mysqli_error($conn));
        }else{
            // Get number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                echo "<span style='color:red;display:block;margin-left:40%;padding-top:100px;'>Email already exists please use a different email</span>";
            }else{
                $this->addUserEntryinDB();
                header("Location: login.php");
            }
        }
        Database::disconnect($conn);
        
      }
}//end class

?>

