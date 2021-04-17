<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// variable declaration
$firstname = "";
$lastname = "";
$username = "";
$email    = "";
$user = $_SESSION['user'];



function getUserHealthById($user){
        
	global $db;
	$query = "SELECT * FROM healt_data WHERE user_id=" . $user['id'];
	$result = mysqli_query($db, $query);

	$healthInfo = mysqli_fetch_assoc($result);
	return $healthInfo;
} 

$healthInfo = getUserHealthById($user);

$sql = "INSERT INTO healt_data (weight)
VALUES ('33')";

$user_id = mysqli_real_escape_string($db, $_REQUEST['user_id']);;
$weight = mysqli_real_escape_string($db, $_REQUEST['weight']);


// Attempt insert query execution
$sql = "INSERT INTO healt_data (weight, user_id) VALUES ('$weight', '$user_id')";
if(mysqli_query($db, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
 
// Close connection
mysqli_close($db);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Health info</h2>
	</div>
	<div class="content">
	<table>
	<tr>
		<td>Name:</td>
		<td><?PHP echo $user['firstname'].' '. $user['lastname']?></td>
	</tr>
	<tr>
		<td>Heartrate:</td>
		<td><?PHP echo $healthInfo['heartrate']?> b/s</td>
	</tr>
        <tr>
		<td>Blood Oxigen:</td>
		<td><?PHP echo $healthInfo['bloodo2']?> %</td>
	</tr>
        <tr>
		<td>Blood Pressure:</td>
		<td><?PHP echo $healthInfo['boodpressure']?></td>
	</tr>
        <tr>
		<td>Weight:</td>
		<td><?PHP echo $healthInfo['weight']?> kg</td>
	</tr>
        <tr>
		<td>id:</td>
		<td><?PHP echo $healthInfo['user_id']?> ID</td>
	</tr>
</table>
	</div>

        <form action="insert.php" method="post">
    <p>
        <label for="user_id">weight:</label>
        <input type="text" name="user_id" id="user_id">
    </p>
    <p>
        <label for="weight">weight:</label>
        <input type="text" name="weight" id="weight">
    </p>
    
    <input type="submit" value="Submit">
</form>


</body>
</html>
