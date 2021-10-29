<?php //Registration Page. 

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
Check that the length of the input password is atleast 8 characters long. The input in the 'password' field should match the input in the 'confirm password' field, else prompt the user. 

c. Check if account exists:
Using the input email, check if the latter already exists on the database. If it is, prompt the user to use a different email. 
HINT : You could add a static method in the user class definition to do that. The method should only take 1 argument as input, which is the input email from the field. 

Step 3 : Account creation
If validation was successful, create a new user on the database. Use the user class object to do that. 

Step 4 : Display a redirect link to the login page, where the user can now login into their newly created account. 


*/

?>