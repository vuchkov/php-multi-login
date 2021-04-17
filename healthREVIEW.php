<?php

global $db;
include('functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$user = $_SESSION['user'];

function getUserHealthById($user)
{
	global $db;
	$query = "SELECT * FROM healt_data WHERE user_id=" . $user['id'];
	$result = mysqli_query($db, $query);

	$healthInfo = mysqli_fetch_assoc($result);
	return $healthInfo;
} 

$healthInfo = getUserHealthById($user);

// If we have $_REQUEST (submitted form) data.
if (isset($_POST['user_id'], $_POST['weight']))
{
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);;
    $weight = mysqli_real_escape_string($db, $_POST['weight']);

    // Attempt insert query execution
    $sql = "INSERT INTO healt_data (weight, user_id) VALUES ('$weight', '$user_id')";
    if(mysqli_query($db, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
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
		<td><?= $user['firstname'] . ' ' . $user['lastname'] ?></td>
	</tr>
	<tr>
		<td>Heartrate:</td>
		<td><?= $healthInfo['heartrate'] ?? '0' ?> b/s</td>
	</tr>
        <tr>
		<td>Blood Oxigen:</td>
		<td><?= $healthInfo['bloodo2'] ?? '0' ?> %</td>
	</tr>
        <tr>
		<td>Blood Pressure:</td>
		<td><?= $healthInfo['boodpressure'] ?? '0' ?></td>
	</tr>
        <tr>
		<td>Weight:</td>
		<td><?= $healthInfo['weight'] ?? '0' ?> kg</td>
	</tr>
        <tr>
		<td>id:</td>
		<td><?= $healthInfo['user_id'] ?? '0' ?> ID</td>
	</tr>
</table>
	</div>




</body>
</html>
