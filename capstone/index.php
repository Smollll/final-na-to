<?php 
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: solid 1px #888;
            border-radius: 4px;
            background-color: #AFD198;
            margin-top: 20px;
            
           
        }

        h3 {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        button {
    background-color: #4CAF50;
    color: white;
    padding: 15px 30px; 
    border: none;
    border-radius: 6px; 
    cursor: pointer;
    margin-top: 20px;
    display: block;
    margin-left: auto; 
    margin-right: auto; 
    font-size: large;
}
/* for address */
.address-container {
    display: flex;
    flex-direction: column;
}

.address-info {
    display: flex;
}


.address-info input[type="text"],
.address-info select {
    flex: 1;
    margin-right: 10px; /* Add spacing between input elements */
}

.address-info select {
    margin-right: 0; /* Remove margin from the select element */
}

button:hover {
  background-color: #45a049;
}
 
.container {
     display: flex;
     align-items: center;
}  
p {
    margin: 0;
}

a {
     color: blue;
     text-decoration: none;
     margin-left: 5px;
}

     .form-row {
 display: flex;
 justify-content: space-between;
 margin-bottom: 10px;
}

.input-container {
    width: calc(50% - 5px);
}

.input-container input[type="file"] {
    border: 1px solid #000;
    border-radius: 4px;
    border-width: 1px;
    padding: 10px;
    width: 60%;
    box-sizing: border-box;
}

.label-container {
    display: block;
    margin-bottom: 5px;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* Set a maximum width for the modal */
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    overflow: auto; /* Allow modal content to scroll */
}


.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.num{
    max-width: 150px;
}
@media screen and (max-width: 600px) {

form {
max-width: 90%;
margin: 0 auto;
padding: 20px;
margin-left: 10px; /* Add a small left margin */
margin-right: 10px; /* Add a small right margin */
overflow-x: hidden;
}
.form-container {
display: flex;
flex-direction: column;
width: 100%;

}

.form-row {
width: 100%;
display: flex;
flex-direction: column;

margin-bottom: 20px;
}

.input-container {
width: 100%;
}

.input-container label {
margin-bottom: 5px;
}

.input-container input[type="file"] {
width: 100%;
}
.swal2-popup {
font-size: 12px; /* Decrease font size for smaller screens */
max-width: 90%; /* Limit width for smaller screens */
}
.address-info {
        flex-direction: column; /* Change flex direction to column in mobile view */
    }

.address-info input[type="text"],
.address-info select {
    flex: none; /* Reset flex property */
    width: 100%; /* Set width to fill the container */
    margin-bottom: 10px; /* Add spacing between input elements */
    }
p {
    margin: 0;
    font-size: smaller;
   
}

a {
     color: blue;
     text-decoration: none;
     margin-left: 10px;
     font-size: smaller;
     
}
}

    </style>
<body>
    <h1 style="text-align: center;">Application Form</h1>
    <form  method="post" enctype="multipart/form-data">
    <div>
        <h3>Personal Data</h3>
        <div>
            <label for="firstName">Fullname*</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required><br>
        </div>
        <div>
            <label for="email">Email*</label>
            <input type="text" id="email" name="email" placeholder="Email" required><br>
        </div>
        <div>
            <label for="conNum">Contact Number*</label>
            <input class="num" type="tel" id="conNum" name="conNum" placeholder="ex...  0923-456-7890" required><br>
        </div>
        <div class="address-container">
    <div>
        <label for="streetAddress">Address*</label>
        <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required>
    </div>
    <div class="address-info">
        <input type="text" id="city" name="city" placeholder="City" required>
        <input type="text" id="zipCode" name="zipCode" placeholder="Zipcode" required>
        <input type="text" id="province" name="province" placeholder="Province" required>
    </div>
</div>

    <div class="form-container">
        <h3>Application Document</h3>
        <div class="form-row">
    <div class="input-container">
        <label for="application_letter">Cover Letter*</label>
        <input type="file" id="appLetter" name="application_letter" accept="image/*"  >
    </div><br>
    <div class="input-container">
        <label for="curriculum_vitae">Resume*</label>
        <input type="file" id="cv" name="curriculum_vitae" accept="image/*">
    </div>
</div>
<div class="form-row">
    <div class="input-container">
        <label for="picture">Formal Picture*</label>
        <input type="file" id="picture" name="pic" accept="image/*" >
        <p style="color: #12372A; font-size: 10px;">Only .jpg, .jpeg, .png files allowed*</p>
    </div><br>
    <div class="input-container">
        <label for="valid_id">Valid ID*</label>
        <input type="file" id="valId" name="valid" accept="image/*" >
        <p style="color: #12372A; font-size: 10px;">Only front view*</p>
    </div>
</div>

    </div>
<br><br>


<div class="container">
    
        <p>Please read and Agree to the:</p>
        <a href="#" id="terms-link">Terms and Conditions</a>

        <div class="modal" id="terms-modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Terms and Conditions</h2>
                <p>Donec lobortis metus eget ligula cursus, sodales suscipit metus imperdiet.</p>

                <label for="accept-terms-checkbox">
                    <input type="checkbox" id="accept-terms-checkbox"> I accept the terms and conditions
                </label>
            </div>
        </div>
    </div>
    <br>
    <br>
    <form id="application-form">
        <button type="submit" id="submit-btn">Submit Application</button>
        
    </form>


    <script>
   $(document).ready(function(){
    // Event listener for form submission
    $('#submit-btn').click(function(event){
        event.preventDefault(); // Prevent default form submission
        
        // Perform form validation
        if (validateForm()) {
            // Check if terms and conditions are accepted
            if (!document.getElementById('accept-terms-checkbox').checked) {
                // Display error message if terms and conditions are not accepted
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please read and accept the Terms and Conditions!",
                });
            } else {
                // If validation and terms acceptance pass, proceed with form submission
                
                var formData = new FormData($('form')[0]); // Correct form selection

                // Send form data to server using AJAX
                $.ajax({
                    url: 'main.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                        success: function(response){
                            $('form')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Please wait while we review your application form",                                    
                            });

                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText); // Log error message to console
                        // Display error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing the form.',
                        });
                    }
                });
            }
        }
    });
});

function validateForm() {
    var errors = [];

    // Validate Fullname
    var firstName = $('#firstName').val().trim();
    if (firstName === '') {
        errors.push("Fullname is required");
    } else if (!/^[a-zA-Z ]*$/.test(firstName)) {
        errors.push("Only letters and white space allowed for Fullname");
    }

    // Validate Email
    var email = $('#email').val().trim();
    if (email === '') {
        errors.push("Email is required");
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        errors.push("Invalid email format");
    }

    // Validate Contact Number
    var conNum = $('#conNum').val().trim();
    if (conNum === '') {
        errors.push("Contact Number is required");
    } else if (!/^\d{11}$/.test(conNum)) {
        errors.push("Contact Number must be exactly 11 digits");
    }

    // Validate Address
    var streetAddress = $('#streetAddress').val().trim();
    var city = $('#city').val().trim();
    var zipCode = $('#zipCode').val().trim();
    var province = $('#province').val().trim();
    if (streetAddress === '' || city === '' || zipCode === '' || province === '') {
        errors.push("Address fields are required");
    }

    // applicaiton letter
    var image = $('#appLetter').prop('files')[0];
    if (!image) {
        errors.push("Image is required");
    } else {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Adjust as needed
        var maxSizeInBytes = 5 * 1024 * 1024; // 5MB, adjust as needed

        if (!allowedExtensions.test(image.name)) {
            errors.push("Invalid file format. Please upload JPG, JPEG, PNG images only.");
        }

        if (image.size > maxSizeInBytes) {
            errors.push("File size exceeds the limit. Please upload an image smaller than 5MB.");
        }
    }

// pang validate cv
    var image = $('#cv').prop('files')[0];
    if (!image) {
        errors.push("Image is required");
    } else {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Adjust as needed
        var maxSizeInBytes = 5 * 1024 * 1024; // 5MB, adjust as needed

        if (!allowedExtensions.test(image.name)) {
            errors.push("Invalid file format. Please upload JPG, JPEG, PNG images only.");
        }

        if (image.size > maxSizeInBytes) {
            errors.push("File size exceeds the limit. Please upload an image smaller than 5MB.");
        }
    }

// pang validate picture

    var image = $('#picture').prop('files')[0];
    if (!image) {
        errors.push("Image is required");
    } else {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Adjust as needed
        var maxSizeInBytes = 5 * 1024 * 1024; // 5MB, adjust as needed

        if (!allowedExtensions.test(image.name)) {
            errors.push("Invalid file format. Please upload JPG, JPEG, PNG images only.");
        }

        if (image.size > maxSizeInBytes) {
            errors.push("File size exceeds the limit. Please upload an image smaller than 5MB.");
        }
    }

    // pang validate valid id

    var image = $('#valId').prop('files')[0];
    if (!image) {
        errors.push("Image is required");
    } else {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Adjust as needed
        var maxSizeInBytes = 5 * 1024 * 1024; // 5MB, adjust as needed

        if (!allowedExtensions.test(image.name)) {
            errors.push("Invalid file format. Please upload JPG, JPEG, PNG images only.");
        }

        if (image.size > maxSizeInBytes) {
            errors.push("File size exceeds the limit. Please upload an image smaller than 5MB.");
        }
    }

    // Check if there are any errors
    if (errors.length > 0) {
    
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'All fields are empty!!'
        });

        return false; // Validation failed
    }

    return true; // Validation passed
}
</script>


    
<script>

document.getElementById('terms-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('terms-modal').style.display = 'block';
});

document.getElementsByClassName('close')[0].addEventListener('click', function() {
    document.getElementById('terms-modal').style.display = 'none';
});

document.getElementById('accept-terms-checkbox').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('terms-modal').style.display = 'none';
    }
});

document.getElementById('submit-btn').addEventListener('click', function(event) {
    if (!document.getElementById('accept-terms-checkbox').checked) {
        event.preventDefault();
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Please read the Terms and Condition!",
        });
    }
});
</script>






    <script src="script.js"></script>

</body>
</html>