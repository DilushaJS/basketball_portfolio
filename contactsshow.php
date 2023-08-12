<!DOCTYPE html>
<html>
<head>
    <title>Basketball Portfolio - Contact US</title>
    <style>body{background-size:cover}</style>
</head>
<body background='3point.jpg'>
    <h1>Basketball Portfolio - Contact Details</h1>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "basketballportfolio";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM contacts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Action</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["Message"] . "</td>";
                echo "<td><a href='delete.php?ID=" . $row["ID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No contacts found.";
        }

        $conn->close();
    ?>
</body>
</html>
