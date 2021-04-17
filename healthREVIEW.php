<?php
global $db;
include('functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$user = $_SESSION['user'];

// If we have $_POST (submitted form) data.
if (isset($_POST['user_id'], $_POST['heartrate'], $_POST['bloodo2'], $_POST['boodpressure'], $_POST['weight']))
{
    $user_id = e($_POST['user_id']);;
    $heartrate = e($_POST['heartrate']);
    $bloodo2 = e($_POST['bloodo2']);
    $boodpressure = e($_POST['boodpressure']);
    $weight = e($_POST['weight']);

    // Check IF we have data of the user then UPDATE, else INSERT.
    if (existUserData($user_id)) {
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

$healthInfo = getUserHealthById($user);
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
