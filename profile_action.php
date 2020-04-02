<?php include 'db_connect.php' ;
    
    $name = "";
    $username = "";
    $email = "";
    

    /* i need to extract data from the form 
        and store those values in these two variables
    */

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Grab the form variables stored int he POST global variable i.e the POST REQUEST object
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $table_name = 'users';

            //Write code here which adds them as a new record to my database
            $sql_stmt = " INSERT INTO " . $table_name . "(name, username, email) VALUES ('" . $name . "' , '" . $username . "' , '" . $email . "' )";
            
            // echo($sql_stmt); //Check if my statement is correct

            if ($conn->query($sql_stmt) === TRUE) {
                echo("Your profile is updated successfully");
            }
            else {
                echo "Error" . $sql_stmt . "<br><br>" . $conn->error;
            }

            $conn->close();
        }

?>
<a href="profile.php">Return to profile</a>