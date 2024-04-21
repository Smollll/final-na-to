<?php 
include 'conn.php';
include 'modal.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

/* Container styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-top: 20px;
}

/* Heading styles */
h1 {
    color: #333;
    text-align: center;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Table header styles */
table th {
    background-color: #f2f2f2;
}

/* Table row hover effect */
table tr:hover {
    background-color: #f9f9f9;
}

/* CSS for Approved status */
.status-approved {
            color: green;
        }

        /* CSS for Pending status */
.status-pending {
            color: #FFC94A;
        }
.status-rejected {
            color: red;
}
        
        .ellipsis {
    cursor: pointer;
    font-size: 200%;
    text-decoration: none;
    display: inline-block;
    position: relative;
    text-align: center;
    width: 1em; /* Adjust as needed */
    height: 1em; /* Adjust as needed */
    line-height: 1em; /* Adjust as needed */
}

.ellipsis:hover::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%; /* Adjust as needed */
    height: 150%; /* Adjust as needed */
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.1); /* Adjust the color and transparency as needed */
}
        /* CSS for options */
        .options {
    display: none;
    position: absolute;
    background-color: #EEEEEE; /* Background color */
    min-width: 120px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    border-radius: 5px; /* Rounded corners */
    color: #FFFFFF; /* White text color */
}

.options button {
    color: #FFFFFF; /* White text color */
    border: none;
    padding: 8px 12px;
    margin: 4px;
    border-radius: 3px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition on hover */
    display: block; /* Ensure buttons are displayed as block elements */
    width: 100%; /* Full width */
}

.options button.approve {
    background-color: #90D26D; /* Green button background color */
}

.options button.reject {
    background-color: #A34343; /* Red button background color */
}
.modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
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
    /* Style for the modal container */
    .modal {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

/* Style for the modal content */
.modal-content {
    position: fixed;
    top: 10%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fefefe;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 80%;
    max-height: 80%;
    overflow-y: auto;
}

    /* Style for the close button */
    .close {
        color: #aaa;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }

    /* Center the image horizontally and vertically */
    #modalImage {
        display: block;
        margin: auto;
        max-width: 100%;
        max-height: 100%;
    }
    

    #modalData {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    /* Style for the individual image containers */
    .image-container {
        width: 20%; /* Adjust the width of the container */
        margin-bottom: 20px; /* Adjust the spacing between image containers */
        text-align: center;
    }

    /* Style for the images */
    .clickable-img {
        max-width: 100%; /* Adjust the maximum width of the images */
        height: auto; /* Maintain aspect ratio */
        cursor: pointer;
    }
</style>
<body>
    
<div class="container">
    <h1>Application List</h1>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="table-body"> <!-- This is where the dynamically fetched data will be inserted -->
            <!-- Table rows will be inserted here -->
            
        </tbody>
    </table>
</div>

    
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalData"> <!-- This div will hold the fetched data -->
            <!-- Content will be inserted here -->
            
        </div>
    </div>

    <div id="imageModal" class="modal">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img id="modalImage" src="" alt="Full View" style="max-width: 100%; height: auto;">
</div>
</div>
<!-- Image Zoom Modal -->



<script>
   
    $(document).ready(function() {
        loadTableData();
    // Bind click event to rows in the table body
    $('#table-body').on('click', 'tr', function(event) {
        event.stopPropagation(); // Stop the event from propagating further
        
        var rowId = $(this).data('id'); // Get the ID of the clicked row
        openModal(rowId); // Call the openModal function with the row ID
    });

    // Bind click event to the options div
    $('#table-body').on('click', '.options', function(event) {
        event.stopPropagation(); // Stop the event from propagating further
    });


    // Function to load table data via AJAX
    function loadTableData() {
        $.ajax({
            url: 'fetch.php', // Path to the PHP script handling the data retrieval
            type: 'POST',
            dataType: 'json', // Expecting JSON response
            success: function(response) {
    if (response.success) {
        // Clear existing table content
        $('#table-body').empty();
        // Populate table with new data
        response.data.forEach(function(row) {
            var status = "Pending";

            // If status is Approved or Rejected, update status accordingly
            if (row.status == 1) {
                status = "Approved";
            } else if (row.status == 2) {
                status = "Rejected";
            }

            // Apply status class based on status
            var statusClass = (row.status == 1) ? "status-approved" : ((row.status == 2) ? "status-rejected" : "status-pending");

            // Display status in table cell
                         $('#table-body').append(`
                             <tr data-id='${row.id}' onclick="openModal(${row.id})">
                                 <td>${row.firstName}</td>
                                 <td>${row.email}</td>
                                 <td>${row.conNum}</td>
                                 <td>${row.date}</td>
                                 <td class='${statusClass}'>${status}</td>
                                 
                                 <td>
                                         <span class='ellipsis' onclick="toggleOptions(${row.id}, event)">
                                             <i class='bx bx-dots-horizontal-rounded' aria-hidden='true'></i>
                                         </span>
                                         <div class='options' id='options_${row.id}' style="display: none; padding: 0; ">
                                             <button class='approve' onclick="approveApplication(${row.id}, event)">Approve</button>
                                             <button class='reject' onclick="rejectApplication(${row.id}, event)">Reject</button>

                                            </div>
                                    </td>

                           </tr>
                    `);



                  });
              } else {
                  console.error('Failed to fetch table data:', response.error);
              }
          },
          error: function(xhr, status, error) {
              console.error('AJAX request error:', error);
          }
      });
   }

    // Update table data periodically (e.g., every 5 seconds)
    setInterval(loadTableData, 5000); // Adjust the interval as needed
});



function toggleOptions(id, event) {
    event.stopPropagation(); // Stop the event from propagating further

    var options = document.getElementById('options_' + id);
    var allOptions = document.querySelectorAll('.options');
    
    // Close all options boxes except the selected one
    allOptions.forEach(function(option) {
        if (option.id !== id) {
            option.style.display = 'none';
        }
    });

    // Toggle the selected options box
    if (options.style.display === "none") {
        options.style.display = "block";
        optionBoxActive = true; // Set flag to true when an option box is active
        disableModal(); // Disable modal interactivity when an option box is active
    } else {
        options.style.display = "none";
        optionBoxActive = false; // Set flag to false when no option box is active
        enableModal(); // Enable modal interactivity when no option box is active
    }
}

// Add event listener to close options box when clicking outside of it
document.body.addEventListener('click', function(e) {
    var allOptions = document.querySelectorAll('.options');
    allOptions.forEach(function(option) {
        if (!option.contains(e.target)) {
            option.style.display = 'none';
            enableModal(); // Enable modal interactivity when no option box is active
        }
    });
});


function approveApplication(id, event) {
    event.preventDefault(); // Prevent the default behavior of the event
    event.stopPropagation(); // Stop the event from propagating further
    updateApplicationStatus(id, 1); // 1 represents approved status
}

function rejectApplication(id, event) {
    event.preventDefault(); // Prevent the default behavior of the event
    event.stopPropagation(); // Stop the event from propagating further
    updateApplicationStatus(id, 2); // 2 represents rejected status
}



// ajax dito

function updateApplicationStatus(id, status) {
    $.ajax({
        url: 'update_status.php', // Path to the PHP script handling the update
        type: 'POST',
        data: { id: id, status: status },
        success: function(response) {
            if (response.success) {
                // Update was successful, reload the page
                location.reload(true); // Reload the page, optionally passing true to force reloading from the server
            } else {
                // Update failed, display error message
                console.error('Error updating application status:', response.error);
            }
        },
        error: function(xhr, status, error) {
            // AJAX request encountered an error
            console.error('AJAX request error:', error);
        }
    });
}
// pang pindot
function openModal(id) {
    // Open the main modal
    var mainModal = document.getElementById("myModal");
    mainModal.style.display = "block";

    // Fetch data for the given ID using an AJAX request
    $.ajax({
        url: 'fetch_application_data.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json', // Expecting JSON response
        success: function(response) {
            if (response.success) {
                // Populate the main modal with data
                populateModalData(response.data);
            } else {
                console.error('Failed to fetch data:', response.error);
                // Handle error (e.g., display an error message in the modal)
                displayErrorInModal(response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
            // Handle error (e.g., display an error message in the modal)
            displayErrorInModal('An error occurred while fetching data.');
        }
    });
}

function populateModalData(data) {
    // Get the modal data container
    var modalData = document.getElementById('modalData');
    
    // Clear any previous content
    modalData.innerHTML = '';
    
    // Create content based on the provided data
    var content = `
        <div class="image-container">
            <p>Cover Letter:</p>
            <img src="${data.appLetter}" alt="Application Letter" class="clickable-img">
        </div>
        <div class="image-container">
            <p>Resume:</p>
            <img src="${data.cv}" alt="CV" class="clickable-img">
        </div>
        <div class="image-container">
            <p>Formal picture:</p>
            <img src="${data.picture}" alt="Picture" class="clickable-img">
        </div>
        <div class="image-container">
            <p>Valid ID:</p>
            <img src="${data.valId}" alt="Validation ID" class="clickable-img">
        </div>
    `;

    // Add content to modal
    modalData.innerHTML = content;

    // Add click event listeners to images for zooming
    addImageClickListeners();
}




function addImageClickListeners() {
    // Add event listener to each clickable image
    document.querySelectorAll('.clickable-img').forEach(function(img) {
        img.addEventListener('click', function() {
            openImageModal(this.src);
        });
    });
}


// Function to open the image modal
function openImageModal(imageSrc) {
    if (imageSrc) {
        // Get the image modal elements
        var imageModal = document.getElementById('imageModal');
        var modalImage = document.getElementById('modalImage');
        
        // Set the src attribute of the modal image to the clicked image source
        modalImage.src = imageSrc;
        
        // Display the image modal
        imageModal.style.display = 'block';
    }
}

// Function to close the image modal
function closeImageModal() {
    var imageModal = document.getElementById('imageModal');
    imageModal.style.display = 'none';
}

// Close the image modal when clicking outside of the modal content
window.addEventListener('click', function(event) {
    var imageModal = document.getElementById('imageModal');
    if (event.target === imageModal) {
        closeImageModal();
    }
});

// Function to close the main modal
function closeModal() {
    var mainModal = document.getElementById("myModal");
    mainModal.style.display = "none";
}

// Function to display an error message in the modal
function displayErrorInModal(errorMessage) {
    var modalData = document.getElementById('modalData');
    modalData.innerHTML = `<p>Error: ${errorMessage}</p>`;
}


    </script>
    
</body>
</html>