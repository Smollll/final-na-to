<?php 
include('connect.php');

// Start or resume the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['registration_order_no'])) {
    // Retrieve the registration order number of the logged-in user
    $logged_in_user_registration_order_no = $_SESSION['registration_order_no'];
} else {
    // Handle the case when the user is not logged in
    exit("User not logged in");
}

// SQL query to retrieve messages
$sql = "
    SELECT groupmsg.message_content, users.firstname, users.middlename, users.lastname, users.registration_order_no
    FROM groupmsg
    JOIN users ON groupmsg.sender = users.registration_order_no
";

// Execute the query
$result = mysqli_query($connect, $sql);

// Check if the query execution is successful
if ($result) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine if the sender is the logged-in user
        $is_sender_logged_in_user = ($row['registration_order_no'] == $logged_in_user_registration_order_no);

        // Apply different CSS classes based on whether the sender is the logged-in user or not
        $message_class = $is_sender_logged_in_user ? "sender-message" : "receiver-message";

        // Display the sender's full name and message content with appropriate styling
        
        echo "<div class='$message_class'>";
        echo htmlspecialchars($row['firstname']) . "<br> ";
        echo  htmlspecialchars($row['message_content'])."<br> ";
        echo "</div>";
    }
} else {
    // Output an error message if the query failed
    echo "Error fetching messages: " . mysqli_error($connect);
}
?>
