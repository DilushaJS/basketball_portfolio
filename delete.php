<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basketballportfolio";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql = "DELETE FROM contacts WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Contact deleted successfully.";
    } else {
        echo "Error deleting contact: " . $conn->error;
    }
}
$conn->close();
?>
