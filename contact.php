<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basketballportfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nameError = $emailError = $messageError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = sanitizeInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameError = "Only letters and spaces allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    if (empty($_POST["message"])) {
        $messageError = "Message is required";
    } else {
        $message = sanitizeInput($_POST["message"]);
        $message = strip_tags($message);
    }
}

$errors = array_filter(array(
    'nameError' => $nameError,
    'emailError' => $emailError,
    'messageError' => $messageError
));

if (empty($errors)) {
    $sql = "INSERT INTO contacts (Name, Email, Message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo json_encode($errors);
}

$conn->close();
?>