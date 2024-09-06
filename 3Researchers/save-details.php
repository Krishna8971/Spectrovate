<?php
// Path to the JSON file
$file = 'details.json';

// Initialize an empty array for new data
$existingData = array();

// Check if the file exists
if (file_exists($file)) {
    // Read existing data from file
    $jsonData = file_get_contents($file);
    $existingData = json_decode($jsonData, true);

    // Check if json_decode() failed
    if ($existingData === null) {
        $existingData = array();
    }
}

// Collect data from POST request
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$password = $_POST['password'];

// Check if the email already exists
foreach ($existingData as $data) {
    if ($data['email'] === $email) {
        echo "<script>alert('Email already exists.'); window.location.href = 'signup.html';</script>";
        exit();
    }
}

// Prepare new data
$newData = array(
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'dob' => $dob,
    'password' => $password
);

// Append new data to existing data
$existingData[] = $newData;

// Save the updated data to the JSON file
file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));

// Redirect to startup.html
header('Location: ../login.html');
exit();
?>
