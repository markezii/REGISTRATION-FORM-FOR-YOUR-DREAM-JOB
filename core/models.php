
<!-- Functions for interacting with the database -->

<?php 

require_once 'dbConfig.php';

function insertIntoStudentRecords($pdo,$first_name, $last_name, $gender, $yearLevel, $section, $adviser, $religion) {

	$sql = "INSERT INTO student_records (first_name,last_name,gender,year_level,section,adviser,religion) VALUES (?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$first_name, $last_name, $gender, $yearLevel, 
		$section, $adviser, $religion]);

	if ($executeQuery) {
		return true;	
	}
}

function seeAllStudentRecords($pdo) {
	$sql = "SELECT * FROM student_records";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getStudentByID($pdo, $student_id) {
	$sql = "SELECT * FROM student_records WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$student_id])) {
		return $stmt->fetch();
	}
}

function updateAStudent($pdo, $student_id, $first_name, $last_name, 
	$gender, $year_level, $section, $adviser, $religion) {

	$sql = "UPDATE student_records 
				SET first_name = ?, 
					last_name = ?, 
					gender = ?, 
					year_level = ?, 
					section = ?, 
					adviser = ?, 
					religion = ? 
			WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	
	$executeQuery = $stmt->execute([$first_name, $last_name, $gender, 
		$year_level, $section, $adviser, $religion, $student_id]);

	if ($executeQuery) {
		return true;
	}
}



function deleteAStudent($pdo, $student_id) {

	$sql = "DELETE FROM student_records WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$student_id]);

	if ($executeQuery) {
		return true;
	}

}




?>
