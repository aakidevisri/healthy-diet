<?php
$conn = mysqli_connect("localhost","root","Koushik@0617","project1");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function sanitizeInput($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmpassword = sanitizeInput($_POST["confirmpassword"]);

    if (empty($email) || empty($password) || empty($confirmpassword)) {
        echo "Please fill in all the fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif ($password !== $confirmpassword) {
        echo "Passwords do not match.";
    } else {
        // Hash the password for security (you should always hash passwords before storing them)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            echo "User registered successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
