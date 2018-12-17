<!-- <?php
$sportName = $_POST['sportName'];

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



$sql = "SELECT FirstName, LastName, Gender FROM persons5 WHERE Sports='$sportName'";
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

$sportName = $_POST['sportName'];
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Sport</th><th>First name</th><th>Last name</th><th>USN</th><th>Tournament</th><th>Positon</th></tr>";

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
    $stmt = $conn->prepare("SELECT Sports,FirstName, LastName, USN, Tournament, Position FROM persons6 WHERE Sports='$sportName'"); 
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