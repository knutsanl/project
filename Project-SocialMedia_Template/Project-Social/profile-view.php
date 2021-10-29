<? // Profile - view
/*

Step 1 
Once a user signs in via the login page, start a session. Store the relevant parameters in the session, such as :
1. userID
2. name
3. surname
4. loginStatus, should be TRUE if login was successful
5. ip address
6. useragent

Step 2
Retrieve other relevant data from the database and store it in a JSON file named 'userDetail.json' in the data folder. 
The data you retrieve and store is upto you, You could for example store the name, birthdate, profile picture ID, Notifications, etc


Step 2 
Display a message that welcomes the user and Show his/her details in a Table(or any other formatted way).
Details to show:
1. Name, Surname
2. Birthdate, Gender
3. Profile picture, see step 3. 
Hint : While name and surname information can be retrieved from the Session itself, the other details will have to be retrieved from the database. Ideally, you could preload those data in the userDetail.json file, from which you can simply read from. 

Step 3: Retrieving the profile picture and notifications
Use the profile picture ID, to retrieve the correct profile picture and display it. 
If the user received a message, Show a line which says :"You have x messages", depending on the number of messages they have. 
If the user does not have any messages, hide that line. 

Step 4: Add a button, which says 'edit profile'. Upon clicking, redirect to profile-edit page. 

Step 5
The profile-view page can also be accessed from the friendlist page and the members page, when the user clicks on the 'View profile' button. In that case, display the respective user profile in viewer mode. Meaning, just display the profile picture, Name, Surname and a button which allows to either add the user as friend or remove them as friend if a friend relationship already exist. 

Step 6 
Last but crucial step, add logout button, which when clicked will destroy the session set in login.php(Step 1) including the session cookie. 
After destroying the session, redirect the user to the login.php page. HINT : use the php header function.

*/



?>