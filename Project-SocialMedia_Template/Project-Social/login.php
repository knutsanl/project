<?php // login page
    
/* In this page, the user should be able to login into their respective profile. 

Step 1 : 
Here you should create a form for the user login. 
The form should have 2 input fields, 1 button and 1 checkbox:
1. username
2. password
3. Login button
4. Remember me checkbox

Upon clicking on the login button, the data should be sent to the backend for basic validation and the login process. 

Validation : Check that no fields are left empty. Else prompt the user to fill all the fields. 

Step 2 : 

If the input data is ok, use the User class to login the user.
Essentially, you should add a method in the User class to Login the user. 
The method should compare the input password with the password stored in the database for this user with this specific username. 

Step 3 : 
If the password matches, allow the user to login :
1. Display a successful message to inform the user he/she is now logged in. 
2. Display a link that redirects the user to his/her profile. 

Step 4 : 
Additionally, start a session. Store the relevant parameters in the session, such as :
1. username
2. name
3. surname
4. loginStatus, should be TRUE if login was successful
5. ip address
6. useragent
You can store more data if you wish. 

Step 5 : 
If the 'Remember Me' checkbox was checked, set a cookie that stores the login status of the user, such that if he/she closes the browser and restarts it, and open the login page, he/she would be automatically logged in, without having to enter his/her username and password. Ideally, the login form should be hidden. 
HINT: the cookie should store the same data as the session. 

Step 6: 
If the user is logged in, everytime they navigate to the login.php page, they should not see the login form. Only the display message that says that they are logged in and the link that would redirect them to their profile, should be visible.
HINT : use session to do this. 
You could also consider putting the login form in a function such as displayLoginForm() that readily displays the login form when called. 

*/


?>