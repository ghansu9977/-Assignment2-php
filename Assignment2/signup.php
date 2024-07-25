<?php
echo "Connecting to MySQL database...<br>";

$conn = mysqli_connect('localhost', 'root', '', 'work') or die("Connection failed: " . mysqli_connect_error());

$createTableQuery = 'CREATE TABLE IF NOT EXISTS user (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(100),
    Email VARCHAR(200) UNIQUE NOT NULL,
    Password VARCHAR(200) NOT NULL
)';

if (mysqli_query($conn, $createTableQuery)) {
    echo "Table created successfully <br>";
} else {
    echo "Table creation failed: " . mysqli_error($conn) . "<br>";
}

if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insertQuery = "INSERT INTO user (Username, Email, Password) VALUES ('$username', '$email', '$password')";
    echo mysqli_query($conn, $insertQuery) ? "SignUp successfully" : "SignUp failed: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
