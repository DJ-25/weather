<?php
$servername = "weather.test";
$username = "root";
$password = "";
$dbname = "weather_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, city FROM weather_cities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - city: " . $row["city"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>