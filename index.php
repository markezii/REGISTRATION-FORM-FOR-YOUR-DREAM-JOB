<?php
// --- 1. DATABASE CONNECTION ---
$servername = "localhost:3307"; // Your Port
$username = "root"; 
$password = "";     
$dbname = "student management system"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 

// --- INITIALIZE VARIABLES (To keep form empty by default) ---
$first_name = "";
$last_name = "";
$gender = "";
$year_level = "";
$section = "";
$adviser = "";
$religion = "";
$id = 0;
$update_mode = false;

// --- 2. DELETE FUNCTION ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM student_records WHERE student_id=$id");
    header("Location: index.php"); // Reload page to finish
    exit();
}

// --- 3. EDIT FUNCTION (Fetch data to fill the form) ---
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update_mode = true;
    $result = $conn->query("SELECT * FROM student_records WHERE student_id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $year_level = $row['year_level'];
        $section = $row['section'];
        $adviser = $row['adviser'];
        $religion = $row['religion'];
    }
}

// --- 4. HANDLE FORM SUBMISSION (Insert OR Update) ---
if (isset($_POST['save'])) {
    // INSERT NEW RECORD
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $year_level = $_POST['year_level'];
    $section = $_POST['section'];
    $adviser = $_POST['adviser'];
    $religion = $_POST['religion'];

    $sql = "INSERT INTO student_records (first_name, last_name, gender, year_level, section, adviser, religion)
            VALUES ('$first_name', '$last_name', '$gender', '$year_level', '$section', '$adviser', '$religion')";
    
    if ($conn->query($sql)) { header("Location: index.php"); exit(); }
}

if (isset($_POST['update'])) {
    // UPDATE EXISTING RECORD
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $year_level = $_POST['year_level'];
    $section = $_POST['section'];
    $adviser = $_POST['adviser'];
    $religion = $_POST['religion'];

    $sql = "UPDATE student_records SET 
            first_name='$first_name', last_name='$last_name', gender='$gender', 
            year_level='$year_level', section='$section', adviser='$adviser', religion='$religion' 
            WHERE student_id=$id";

    if ($conn->query($sql)) { header("Location: index.php"); exit(); }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 10px; }
        label { display: inline-block; width: 100px; }
        input[type="text"] { padding: 5px; width: 200px; }
        
        /* Button Styles */
        .btn-submit { padding: 10px 30px; cursor: pointer; background-color: #eee; border: 1px solid #999; }
        .btn-update { padding: 10px 30px; cursor: pointer; background-color: green; color: white; border: 1px solid green; }
        
        table { border-collapse: collapse; width: 100%; margin-top: 30px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        
        .btn-edit { background-color: #4CAF50; color: white; padding: 3px 8px; text-decoration: none; border-radius: 3px; margin-right: 5px; }
        .btn-delete { background-color: #f44336; color: white; padding: 3px 8px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>

    <h2>Welcome to the Student Management System</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="form-group"> <label>First Name</label> <input type="text" name="first_name" value="<?php echo $first_name; ?>" required> </div>
        <div class="form-group"> <label>Last Name</label> <input type="text" name="last_name" value="<?php echo $last_name; ?>" required> </div>
        <div class="form-group"> <label>Gender</label> <input type="text" name="gender" value="<?php echo $gender; ?>"> </div>
        <div class="form-group"> <label>Year Level</label> <input type="text" name="year_level" value="<?php echo $year_level; ?>"> </div>
        <div class="form-group"> <label>Section</label> <input type="text" name="section" value="<?php echo $section; ?>"> </div>
        <div class="form-group"> <label>Adviser</label> <input type="text" name="adviser" value="<?php echo $adviser; ?>"> </div>
        <div class="form-group"> 
            <label>Religion</label> 
            <input type="text" name="religion" value="<?php echo $religion; ?>" style="margin-right: 10px;"> 
            
            <?php if ($update_mode == true): ?>
                <input type="submit" name="update" value="Update Record" class="btn-update">
                <a href="index.php" style="margin-left: 10px;">Cancel</a>
            <?php else: ?>
                <input type="submit" name="save" value="Submit" class="btn-submit">
            <?php endif; ?>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Year</th>
                <th>Section</th>
                <th>Adviser</th>
                <th>Religion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM student_records";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['student_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['year_level'] . "</td>";
                    echo "<td>" . $row['section'] . "</td>";
                    echo "<td>" . $row['adviser'] . "</td>";
                    echo "<td>" . $row['religion'] . "</td>";
                    echo "<td>
                            <a class='btn-edit' href='index.php?edit=".$row['student_id']."'>Edit</a>
                            <a class='btn-delete' href='index.php?delete=".$row['student_id']."'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No students registered yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>