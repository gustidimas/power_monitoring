<!-- Config untuk koneksi ke database -->

<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "monitoring_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>