<?php
// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$jsonFile = $_POST['jsonFile'] ?? '';

// Check if the JSON file exists
if (!file_exists($jsonFile)) {
    echo 'error';
    exit;
}

// Load and decode the JSON data
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

if (!is_array($data)) {
    echo 'error';
    exit;
}

// Check if the email and password match any entry in the JSON data
$validLogin = false;
foreach ($data as $entry) {
    if ($entry['email'] === $email && $entry['password'] === $password) {
        $validLogin = true;
        break;
    }
}

// Return the result
if ($validLogin) {
    echo 'success';
} else {
    echo 'error';
}
?>
