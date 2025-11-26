<?php  

if (isset($_GET['studentName'])) {
	echo "<h2>Student Name: " . $_GET['studentName']. "</h2>";
}

if (isset($_GET['yearLevel'])) {
	echo "<h2>Year Level: " . $_GET['yearLevel'] . "</h2>";
}
?>