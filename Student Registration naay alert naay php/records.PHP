<?php
<!-- filepath: records.php -->
<?php
echo "<h2>Registered Students</h2>";
echo "<a href='index.php'>Back to Registration</a><br><br>";
if (file_exists("records.csv")) {
    echo "<table border='1'><tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Course</th>
        <th>Batch</th>
        <th>ID</th>
    </tr>";
    $file = fopen("records.csv", "r");
    while (($row = fgetcsv($file)) !== false) {
        echo "<tr>";
        // Output each column in order
        for ($i = 0; $i < 8; $i++) {
            echo "<td>" . (isset($row[$i]) ? htmlspecialchars($row[$i]) : '') . "</td>";
        }
        echo "</tr>";
    }
    fclose($file);
    echo "</table>";
} else {
    echo "No records found.";
}
?>