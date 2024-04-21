<?php 
//  include "connect.php";  
session_start();
if (isset($_SESSION['username'])) {
    // Retrieve username from session
    $name = $_SESSION['username'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "three_d","3307");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query to fetch user's full name
    $result = mysqli_query($con, "SELECT registration_order_no, firstname, middlename, lastname FROM users WHERE username='$name'");
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($con));
    }
    
    // Fetch user's full name from the result
    $row = mysqli_fetch_assoc($result);
    
    // Check if a row was fetched
    if ($row) {
        // Concatenate first name, middle name, and last name into $fullname
        $firstname = $row['firstname'];
        $fullname = $firstname . " " . $row['middlename'] . " " . $row['lastname'];
        $registration_order_no=$row['registration_order_no'];
        $_SESSION["registration_order_no"] = $registration_order_no;
        
    } else {
        $fullname = "Full name not found";
    }
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.js" ></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            margin-top: 3%;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }
       

        .msg-container {
            margin-top: 20px;
        }
        .display-message {
            max-height: 600px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .message {
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            word-wrap: break-word;
        }
        

        .msg-container {
    display: flex;
    flex-direction: column;
}

.sender-message {
    background-color: #007bff;
    color: white; /* Set text color for sender messages */
    padding: 10px;
    border-radius: 10px;
    margin: 5px 0;
    word-wrap: break-word;
    align-self: flex-end; /* Align sender messages to the end (right side) */
    width: fit-content;
    max-width: 300px;
    order: 1; /* Set the order of sender messages */
    margin-left: auto;
    text-align: right;

}

.receiver-message {
    background-color: #D8D9DA;
    color: black; /* Set text color for receiver messages */
    padding: 10px;
    border-radius: 10px;
    margin: 5px 0;
    word-wrap: break-word;
    align-self: flex-start; /* Align receiver messages to the start (left side) */
    max-width: 300px;
    width: fit-content;
    order: 2; /* Set the order of receiver messages */
}







        #message {
            width: calc(100% - 20px);
            min-height: 50px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        input[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #0056b3;
        }.btn{
            background-color: rgba(255, 102, 102, 0.7);
            color: white;
            padding: 10px 20px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            font: 1em sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="h2">
            <h1><?php echo $fullname; ?></h1>
        </div>
        <form action="" method="post">
            <button class="btn" type="submit" name="logout">Logout</button>
            <?php
            if (isset($_POST['logout'])) {
                session_destroy();
                header("location:login.php");
            }
            ?>
        </form>
        <div class="msg-container">
            <h1>Message Board</h1>
            <div class="display-message">
                <!-- Display messages here -->
            </div>
            <form action="" method="post">
                <input type="hidden" name="sender" id="sender" value="<?php echo $registration_order_no ?>">
                <textarea name="message" id="message" cols="30" rows="3" placeholder="Type your message here..."></textarea>
                <input type="button" value="Send" onclick="sendmsg()">
            </form>
        </div>
    </div>
    
    
</body>
<script>
    $(document).ready(function(){
        display();
        setInterval(fetchNewMessages, 3000);
        
    })
    function fetchNewMessages() {
    // Create an AJAX request to fetch new messages
    $.ajax({
        url: "display.php", // URL to your server script that fetches new messages
        type: "POST",
        success: function(data) {
            // Update the display with the new messages
            $(".display-message").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle AJAX request errors
            console.error("Failed to fetch new messages: " + textStatus + ", " + errorThrown);
        }
    });
}


// first of all gagawa muna tayo ng ajax function para makapag send ng message
    function sendmsg() {
    // Create a FormData object
    var send = new FormData();
    
    // Get the value from the message input and the sender input
    var textmsg = $("#message").val();
    var texsender = $("#sender").val();
    
    // after natin kunin yung value mag apend tayo dito para madagdagan ng value
    send.append("message", textmsg);
    send.append("sender", texsender);
    
    // after non gagawin na natin yung function to para maibato yung message and kung sino yung nag send
    $.ajax({
        url: "sendmsg.php",
        type: "POST",
        data: send,
        contentType: false,  
        processData: false,
        success: function(data) {
            // then kapag nag success na i c-clear nito yung laman ng textarea
            $("#message").val("");
            display();
            $(".display-message").scrollTop($(".display-message")[0].scrollHeight);
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            alert("An error occurred while sending the message.");
        }
    });
}

    function display(){
        var display = new FormData();
        var textmsg = $("#message").val();
        display.append("message", textmsg);
        $.ajax({
            url: "display.php",
            type: "POST",
            data: display,
            contentType: false,
            processData: false,
            success: function(data){
                $(".display-message").html(data);
            }
        })

    }
</script>
</html>