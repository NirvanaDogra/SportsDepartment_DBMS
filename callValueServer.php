<!-- <?php


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
?> -->


<!DOCTYPE html>
<html>
<body>

<?php

// $fname = $_POST['fname'];

// $lname = $_POST['lname'];
// $gender = $_POST['gender'];
// $USN = $_POST['USN'];
// $branch = $_POST['branch'];
// $tournament = $_POST['tournament'];
// $dateStart = $_POST['dateStart'];
// $dateend = $_POST['dateend'];
// $pos = $_POST['pos'];
// $sem = $_POST['sem'];
// $sport = $_POST['sport'];

echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>First name</th><th>Last name</th><th>Gender</th><th>USN</th><th>Sport</th><th>Tournament</th><th>Semester</th><th>Positon</th><th>Branch</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM persons6"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 

</body>
</html>