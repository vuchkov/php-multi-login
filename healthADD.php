<?php
global $db;
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
$user = $_SESSION['user'];

// Check IF the user has healt_data THEN load $data ELSE fill an empty array.
$exist_user_data = mysqli_fetch_row(mysqli_query($db, 'Select COUNT(*) from healt_data WHERE user_id="'. $user['id'] . '"')) > 0;
if ($exist_user_data) {
    $data = mysqli_fetch_assoc(mysqli_query($db, 'SELECT * FROM healt_data WHERE user_id="' . $user['id'] . '" LIMIT 1'));
} else {
    $data = [
        'heartrate' => '0',
        'bloodo2' => '0',
        'boodpressure' => '0',
        'weight' => '0',
        'user_id' => $user['id']
    ];
}
?>
<form action="healthREVIEW.php" method="post">
    <p>
        <label for="heartrate">Heartrate:</label>
        <input type="text" name="heartrate" id="heartrate" value="<?= $data['heartrate'] ?>">
    </p>
    <p>
        <label for="bloodo2">Blood Oxigen:</label>
        <input type="text" name="bloodo2" id="bloodo2" value="<?= $data['bloodo2'] ?>">
    </p>
    <p>
        <label for="boodpressure">Blood Pressure:</label>
        <input type="text" name="boodpressure" id="boodpressure" value="<?= $data['boodpressure'] ?>">
    </p>
    <p>
        <label for="weight">Weight:</label>
        <input type="text" name="weight" id="weight" value="<?= $data['weight'] ?>">
    </p>
	<input type="hidden" name="user_id" id="user_id" value="<?= $data['user_id'] ?>">
    <input type="submit" value="Submit">
</form>
