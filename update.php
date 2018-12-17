
<!DOCTYPE html>
<html>
    <title> Update date Base</title>
<body>

<?php

$UpdateVar = $_POST['UpdateVar'];
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
    $stmt = $conn->prepare("SELECT * FROM persons6 WHERE USN='$UpdateVar'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }

    $stmt = $conn->prepare("DELETE FROM persons6 WHERE USN='$UpdateVar'"); 
    $stmt->execute();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 

<form action="server.php" method="post">
	<tr>
		<td>------ First Name ----------</td>
		<td>------ Last Name ------    </td>
		<th>-- Gender --</th>
		<th>------------- USN ----------</th>
		<th>Branch ----   </th>
		<th>------Sport ------ ------------- </th>
		<th>------tournament------   </th>
		<th>------ Start date ------   </th>
		<th>------ END date ------   </th>
    </tr><br>
    
	<tr>
		<td><input type="text" name="fname"></td>
		<td><input type="text" name="lname" value="first Name"></td>		
		<select name=gender>
				<option value="M" >Male</option>
				<option value="F" >Femal</option>				
		</select>
		<td><input type="text" name="USN"></td>
		<select name=branch>
				<option value="CSE" >CSE</option>
				<option value="ME" >ME</option>
				<option value="EIE" >EIE</option>
				<option value="Telecom" >Telecom</option>							
		</select>
		<td><input type="text" name="sport"></td>
		<td><input type="text" name="tournament"></td>
		<td><input type="text" name="dateStart"></td>
		<td><input type="text" name="dateend"></td>
		<select name=pos>
				<option value="1" >1</option>
				<option value="2" >2</option>
				<option value="3" >3</option>											
		</select>
		<select name=sem>
				<option value="1" >1</option>
				<option value="2" >2</option>
				<option value="3" >3</option>
				<option value="4" >4</option>
				<option value="5" >5</option>
				<option value="6" >6</option>
				<option value="7" >7</option>
				<option value="8" >8</option>											
		</select>
    </tr>
    <input type="submit">
</form>

</body>
</html>