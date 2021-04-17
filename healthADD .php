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

?>
