<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	<?php $getStudentById = getStudentById($pdo, $_GET['student_id']); ?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo $getStudentById['first_name']; ?>">
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo $getStudentById['last_name']; ?>">
		</p>
		<p>
			<label for="gender">Gender</label>
			<input type="text" name="gender" value="<?php echo $getStudentById['gender']; ?>">
		</p>
		<p>
			<label for="yearLevel">Year Level</label>
			<input type="text" name="yearLevel" value="<?php echo $getStudentById['year_level']; ?>">
		</p>
		<p>
			<label for="section">Section</label>
			<input type="text" name="section" value="<?php echo $getStudentById['section']; ?>">
		</p>
		<p>
			<label for="adviser">Adviser</label>
			<input type="text" name="adviser" value="<?php echo $getStudentById['adviser']; ?>"></p>
		<p>
			<label for="adviser">Student ID</label>
			<input type="hidden" name="student_id" value="<?php echo $getStudentById['student_id']; ?>">
		</p>
		<p>
			<label for="religion">Religion</label>
			<input type="text" name="religion" value="<?php echo $getStudentById['religion']; ?>">
			<input type="submit" name="editStudentBtn">
		</p>
	</form>
</body>
</html>