<?php
/*

This is the page to compose a new message or reply to a received message

Step 1 
In case of composing a new message : 
Make a form that contains:
1. A select field named, 'Recipient'. The select field should contain the list of friends of the current logged in user. HINT : You can use a dynamic select field to do that. 
2. A text field for the message body. Make it big enough for a decently sized message. The size is upto you. 
3. A send button, that upon clicking, sends a query to the database where a new entry is added to the 'message' table in the database. 

Step 2
In case of replying to a received message
The Recipient field should be pre-filled to the Received message's sender. 
This is the case when you do step 4 in message-inbox.php

Step 3
Ensure that the user cannot send an empty message. Some validation is required on the input message. 

*/



?>