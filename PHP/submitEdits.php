<?php 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["editid"];
        $firstname = $_POST["editfname"];
        $lastname = $_POST["editlname"];

        $numid = $_POST["editnumberid"];
        $numidlength = count($numid);
        $phonenumber = $_POST["editphonenumber"];
        $phonelength = count($phonenumber);
        //$newphonenumber = $_POST["neweditphonenumber"];

        $emailid = $_POST["editemailid"];
        $emailidlength = count($emailid);
        $email = $_POST["editemail"];
        $emaillength = count($email);
        //$newemail = $_POST["neweditemail"];

        $sql = "UPDATE second_phonebook 
                    SET firstname='$firstname', lastname='$lastname'
                    WHERE id = '$id'";
        if($conn->query($sql) === TRUE){
        $y=0;
        $z=0;
            for($x = 0; $x < $numidlength; $x++) {
                $phonenumbersql = "UPDATE phone_numbers
                                    SET number = '$phonenumber[$y]'
                                    WHERE id = '$numid[$x]'";
                $conn->query($phonenumbersql);
                $y++;
                
            }
 
            foreach($emailid as $emailidvalue) {
                    $emailsql = "UPDATE emails 
                                SET email = '$email[$z]'
                                WHERE id = '$emailidvalue'";
                    $conn->query($emailsql);
                    $z++;
            }

            echo "Update Successful";
        } else {
            echo "Error: " . $sql . "<br/>" . $phonenumbersql . "<br/>" . $emailsql . "<br/>" . $conn->error; 
        }
    
    }

?>