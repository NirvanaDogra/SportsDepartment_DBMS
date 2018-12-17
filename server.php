<?php


$fname = $_POST['fname'];

$lname = $_POST['lname'];
$gender = $_POST['gender'];
$USN = $_POST['USN'];
$branch = $_POST['branch'];
$tournament = $_POST['tournament'];
$dateStart = $_POST['dateStart'];
$dateend = $_POST['dateend'];
$pos = $_POST['pos'];
$sem = $_POST['sem'];
$sport = $_POST['sport'];



// foreach( $name as $key => $n ) {
//    print "The name is ".$n." and email is ".$email[$key].", thank you\n";
//  }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="CREATE TABLE Persons6 (   
    FirstName varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    Gender varchar(3) NOT NULL,
    USN varchar(10) PRIMARY KEY,
    Sports varchar(10) NOT NULL,
    Tournament varchar(40),    
    Position int,
    semester int,
    branch varchar(10)
);";



if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully now adding values";
} else{}
// sql to create table
// foreach( $fname as $key => $n ) {
//     //print "The name is ".$n." and email is ".$email[$key].", thank you\n";
//     $sql="INSERT INTO MyGuests VALUES ('$n', '$lname[$key]', '$gender[$key]', '$USN[$key]', '$sport[$key]'', 
//     '$tournament[$key]', '$dateStart[$key]', '$dateend[$key]', '$pos[$key]', '$sem[$key]');";


if(gettype($name)=='array'){
    for($key=0; $key <6; $key++)
    {
        $val1=(int)$pos[$key];
        $val2=(int)$sem[$key];
        $sql="INSERT INTO Persons6 VALUES ('$fname[$key]', '$lname[$key]', '$gender[$key]', '$USN[$key]', '$sport[$key]', 
        '$tournament[$key]', $val1, $val2, '$branch[$key]');";
    
    
        if ($conn->query($sql) === TRUE) {
            echo "Inserted values\n";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}
else{
    echo("<h1>helllo<h2>");
    $val1=(int)$pos;
        $val2=(int)$sem;
    $sql="INSERT INTO Persons6 VALUES ('$fname', '$lname', '$gender', '$USN', '$sport', 
    '$tournament', $val1, $val2, '$branch');";


    if ($conn->query($sql) === TRUE) {
        echo "Inserted values\n";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} 

    $sql = "SELECT FirstName, LastName, Gender FROM persons6";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "First name: " . $row["FirstName"]. " - Last name: " . $row["LastName"]. "- Gender:" . $row["Gender"]. "<br>";
        }
    } else {
        echo "0 results";
    }

$conn->close();
?>