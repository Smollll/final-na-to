<?php
include 'conn.php';

$firstName = $_POST["firstName"];
$email = $_POST["email"];
$conNum = $_POST["conNum"];
$streetAddress = $_POST["streetAddress"];
$city = $_POST["city"];
$zipCode = $_POST["zipCode"];
$province = $_POST["province"];

$currentDate = date('Y-m-d');

$sql = "INSERT INTO contbl (firstName, email, conNum, streetAddress, city, province, zipCode, date) 
        VALUES ('$firstName', '$email', '$conNum', '$streetAddress', '$city', '$province', '$zipCode', '$currentDate')";

// Execute the insert query
if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Get the last inserted ID
    $last_id = $conn->insert_id;
    $appLetter_path = "";
    $cv_path = "";
    $picture_path = "";
    $valId_path = "";

    foreach ($_FILES as $key => $file) {
        if (!empty($file['tmp_name'])) {
            $uploadDir = ''; // Set the upload directory path for each type of file
            switch ($key) {
                case 'application_letter':
                    $uploadDir = 'application/';
                    $uploadPath = $uploadDir . "{$last_id}_application_letter_" . $file['name'];
                    $appLetter_path = $uploadPath; // Assign the value to $appLetter_path
                    break;
                case 'curriculum_vitae':
                    $uploadDir = 'resume/';
                    $uploadPath = $uploadDir . "{$last_id}_curriculum_vitae_" . $file['name'];
                    $cv_path = $uploadPath; // Assign the value to $cv_path
                    break;
                case 'pic':
                    $uploadDir = 'image/';
                    $uploadPath = $uploadDir . "{$last_id}_picture_" . $file['name'];
                    $picture_path = $uploadPath; // Assign the value to $picture_path
                    break;
                case 'valid':
                    $uploadDir = 'validId/';
                    $uploadPath = $uploadDir . "{$last_id}_valid_id_" . $file['name'];
                    $valId_path = $uploadPath; // Assign the value to $valId_path
                    break;
                default:
                    // Handle unsupported file types or other cases
                    break;
            }
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Do nothing here, files are moved successfully
            } else {
                echo "Error uploading file $key.";
            }
        }
    }

    // Construct the SQL update statement
    $sql_update = "UPDATE contbl SET appLetter = '$appLetter_path', cv = '$cv_path', picture = '$picture_path', valId = '$valId_path' WHERE id = $last_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
