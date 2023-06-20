<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phpdriver';

// Try to connect to the database.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the registration form was submitted.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['age'], $_POST['number_of_posv'], $_POST['auto_number'], $_POST['auto'])) {
    // Could not get the data that should have been sent.
    exit('Please complete the registration form!');
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['age']) || empty($_POST['number_of_posv']) || empty($_POST['auto_number']) || empty($_POST['auto'])) {
    // One or more values are empty.
    exit('Please complete the registration form');
}

// Validate email format.
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid!');
}

// Validate username format.
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}

// Validate password length.
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password must be between 5 and 20 characters long!');
}

// Validate driver's age (21-65).
$driverAge = intval($_POST['age']);
if ($driverAge < 21 || $driverAge > 65) {
    exit('Driver\'s age must be between 21 and 65!');
}

// Validate client's age (greater than 16).
$clientAge = intval($_POST['age']);
if ($clientAge <= 16) {
    exit('Client\'s age must be greater than 16!');
}

// Check if the username or email already exists in the accounts table.
if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ? OR email = ?')) {
    $stmt->bind_param('ss', $_POST['username'], $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Username or email already exists.
        echo 'Username or email already exists, please choose another!';
    } else {
        $stmt->close();
        // Check if the driver's license or auto number already exists in the drivers table.
        if ($stmt = $con->prepare('SELECT id FROM drivers WHERE number_of_posv = ? OR auto_number = ?')) {
            $stmt->bind_param('ss', $_POST['number_of_posv'], $_POST['auto_number']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                // Driver's license or auto number already exists.
                echo 'Driver\'s license or auto number already exists, please check your details!';
            } else {
                $stmt->close();
                // Insert new account into the accounts table.
                if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, age) VALUES (?, ?, ?, ?)')) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sssi', $_POST['username'], $password, $_POST['email'], $_POST['age']);
                    $stmt->execute();
                    $accountId = $stmt->insert_id;
                    $stmt->close();

                    // Insert new driver into the drivers table.
                    if ($stmt = $con->prepare('INSERT INTO drivers (account_id, number_of_posv, auto_number, auto) VALUES (?, ?, ?, ?)')) {
                        $stmt->bind_param('isss', $accountId, $_POST['number_of_posv'], $_POST['auto_number'], $_POST['auto']);
                        $stmt->execute();
                        echo 'You have successfully registered as a driver! You can now login!';
                    } else {
                        // Something is wrong with the SQL statement.
                        echo 'Could not prepare statement!';
                    }
                } else {
                    // Something is wrong with the SQL statement.
                    echo 'Could not prepare statement!';
                }
            }
        } else {
            // Something is wrong with the SQL statement.
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    // Something is wrong with the SQL statement.
    echo 'Could not prepare statement!';
}

$con->close();
?>
