<?php include 'db_connect.php' ;
    
    $name = "";
    $address = "";
    $email = "";
    $contact = "";
    $description = "";

    /* i need to extract data from the form 
        and store those values in these two variables
    */

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Grab the form variables stored int he POST global variable i.e the POST REQUEST object
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['number'];
            $description = $_POST['description'];
            $picture = $_POST['picture'];
            $table_name = 'profile';

            //Write code here which adds them as a new record to my database
            $sql_stmt = " INSERT INTO " . $table_name . "(name, address, email, contact, description, picture) VALUES ('" . $name . "' , '" . $address . "' , '" . $email . "' , '" . $contact . "' , '" . $description . "' , '" . $picture . "')";
            
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