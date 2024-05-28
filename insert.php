<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is on a different host
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "test"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $job_title = $conn->real_escape_string($_POST['job_title']);
    $country = $conn->real_escape_string($_POST['country']);
    $state = $conn->real_escape_string($_POST['state']);
    $address = $conn->real_escape_string($_POST['address']);
    $zipcode = $conn->real_escape_string($_POST['zipcode']);

    // Insert data into database
    $sql = "INSERT INTO testtable (first_name, last_name, email, phone, company_name, job_title, country, state, address, zipcode)
    VALUES ('$first_name', '$last_name', '$email', '$phone', '$company_name', '$job_title', '$country', '$state', '$address', '$zipcode')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the provided link
        header("Location: " . $_GET['redirect']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close connection
$conn->close();
