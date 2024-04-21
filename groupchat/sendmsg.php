<?php
// Include your database connection script
include('connect.php');

if(isset($_POST['message']) && isset($_POST['sender'])){

    $message= $_POST['message'];
    // gagawa tayo ng variable ng kung sino yung sender
    $registration_order_no = $_POST['sender'];
    // gagawa tayo ng query para mainsert yung message natin sa database
    $messageInsert = mysqli_query($connect, "INSERT INTO groupmsg (message_content, sender) 
    VALUES ('$message', '$registration_order_no')");
}
?>
