<?php
<!-- filepath: register.php -->
<?php
// Connect to your database
$conn = new mysqli("localhost", "username", "password", "database_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        $_POST['firstName'],
        $_POST['middleName'], // Add this line for Middlename
        $_POST['lastName'],
        $_POST['contact'],
        $_POST['email'],
        $_POST['course'],
        $_POST['batch'],
        $_POST['studentId']
    ];
    $line = implode(",", array_map('htmlspecialchars', $data)) . "\n";
    file_put_contents("records.csv", $line, FILE_APPEND);
    header("Location: records.php");
    exit();
}

// Get form data
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$course = $_POST['course'];
$batch = $_POST['batch'];
$studentId = $_POST['studentId'];

// Insert into database
$sql = "INSERT INTO students (firstName, middleName, lastName, contact, email, course, batch, studentId)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $firstName, $middleName, $lastName, $contact, $email, $course, $batch, $studentId);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful!'); window.location.href='index.html';</script>";
} else {
    echo "<script>alert('Registration failed!'); window.location.href='index.html';</script>";
}

$stmt->close();
$conn->close();
?>