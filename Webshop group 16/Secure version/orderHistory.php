<?php
session_start();
require_once("connect.php");
$name = $_SESSION['CurrentUser'];
echo 'Logged in as ' . $_SESSION['CurrentUser'];
echo '<p><a href="index.php">Home</a>';
echo '<p><a href="logout.php?validation=' . $_SESSION["token"] . '">Click here to log out</a></p>';

$sql = "SELECT * FROM orderhistory where name='$name' ORDER BY orderId ";
$result = $conn->query($sql);

while($rows = $result->fetch_assoc()){
	$orderId = $rows['orderId'];
	$orderName = $rows['name'];
	$orderNbrB = $rows['nbrBanana'];
	$orderNbrC = $rows['nbrCookie'];
	$orderSum  = $rows['sumTotal'];
	echo '<table border="1"><tr><th>Order id</th><th>Name</th><th>Bananas</th><th>Cookies</th><th>Total price</th></tr><tr><th>' . $orderId . '</th><th>' . $orderName . '</th><th>' . $orderNbrB . '</th><th>' .$orderNbrC .'</th><th>'. $orderSum . '</tr></th>' ;
}

?>
