<?php
global $db;
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
$user = $_SESSION['user'];

?>
<form action="healthREVIEW.php" method="post">
    <p>
        <label for="weight">weight:</label>
        <input type="text" name="weight" id="weight">
    </p>
	<input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?>">
    <input type="submit" value="Submit">
</form>
