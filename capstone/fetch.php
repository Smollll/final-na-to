<?php
// Include your database connection file
include 'conn.php';

// Fetch data from the database
$sql = "SELECT id, firstName, email, conNum, date, status FROM contbl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an array to store the fetched data
    $data = array();

    // Fetch each row and add it to the data array
    while ($row = $result->fetch_assoc()) {
        // Add the row to the data array
        $data[] = array(
            'id' => $row['id'],
            'firstName' => $row['firstName'],
            'email' => $row['email'],
            'conNum' => $row['conNum'],
            'date' => $row['date'],
            'status' => $row['status']
        );
    }

    // Return the data array as JSON
    echo json_encode(array('success' => true, 'data' => $data));
} else {
    // No data found
    echo json_encode(array('success' => false, 'error' => 'No data found'));
}

// Close the database connection
$conn->close();
?>
