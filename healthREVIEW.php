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

// If we have $_POST (submitted form) data.
if (isset($_POST['user_id'], $_POST['heartrate'], $_POST['bloodo2'], $_POST['boodpressure'], $_POST['weight']))
{
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);;
    $heartrate = mysqli_real_escape_string($db, $_POST['heartrate']);
    $bloodo2 = mysqli_real_escape_string($db, $_POST['bloodo2']);
    $boodpressure = mysqli_real_escape_string($db, $_POST['boodpressure']);
    $weight = mysqli_real_escape_string($db, $_POST['weight']);

    // Check IF we have data of the user then UPDATE, else INSERT.
    $exist_user_data = mysqli_fetch_row(mysqli_query($db, 'Select COUNT(*) from healt_data WHERE user_id="'. $user_id . '"')) > 0;
    if ($exist_user_data) {
        $sql = "UPDATE healt_data SET heartrate='$heartrate', bloodo2='$bloodo2', boodpressure='$boodpressure', weight='$weight' WHERE user_id='$user_id'";
        if (mysqli_query($db, $sql)) {
            echo "Records added successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }  else  {
        // Attempt insert query execution
        $sql = "INSERT INTO healt_data (user_id, heartrate, bloodo2, boodpressure, weight) 
            VALUES ('$user_id', '$heartrate', '$bloodo2', '$boodpressure', '$weight')";
        if (mysqli_query($db, $sql)) {
            echo "Records added successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
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
    <p>
        <a href="healthADD.php">Add health data</a>
    </p>
</div>



</body>
</html>
