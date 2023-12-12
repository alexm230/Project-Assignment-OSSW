<?php
//Database connection parameters
$servername = "127.0.0.1"; //Localhost ip
$username = "alex"; //Database username
$password = "alex"; //Database password
$dbname = "troubleshoot"; //Database name

//Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

//Check if the connection to the database was successful
if ($conn->connect_error) {
	//Terminates the script and displays an error message
    die("Connection failed: " . $conn->connect_error);
}

//Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get values from the submitted form and escape the real_escape_string() function
    //which preventing SQL injection attacks and syntax errors
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $problem = $conn->real_escape_string($_POST['problem']);
    //Ref. (PHP Mysqli real_escape_string() function)

    //Insert the values into the database
    $sql = "INSERT INTO user_information (name, address, contact, problem) VALUES ('$name', '$address', '$contact', '$problem')";

    //Check if the SQL query was unsuccessful
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="websiteStyles.css"> <!-- Link to an external stylesheet for styling -->
    <title>Welcome</title>
</head>
<body>
    <div class="container">
        <?php
            //Display a welcome message with the user's name And print the query for the user
            echo "<h1>Welcome, $name!</h1>"; 
            echo "<h2>We will look at the query below shortly:<br/></h2>"; //Corrected the closing tag here
            echo "<p> Query: $problem </p>"; //Added a semicolon at the end
        ?>
        <p>Thanks for choosing "We Fix It".</p>
    </div>
</body>
</html>

<!-- PHP Mysqli real_escape_string() function 
Available at: https://www.w3schools.com/php/func_mysqli_real_escape_string.asp 
(Accessed: 10 December 2023).  
PHP Mysqli functions. Available at: 
https://www.w3schools.com/php/php_ref_mysqli.asp (Accessed: 12 December 2023) 
HTML tutorial. Available at: 
https://www.w3schools.com/html/default.asp (Accessed: 12 December 2023) -->
