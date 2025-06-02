<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "classic_airline";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bookings</title>
</head>
<body>

<h2>Stored Flight Bookings</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Passenger Name</th>
        <th>Email</th>
        <th>Departure Date</th>
        <th>From</th>
        <th>To</th>
        <th>Time</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['passenger_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['departure_date']; ?></td>
            <td><?php echo $row['from_location']; ?></td>
            <td><?php echo $row['to_location']; ?></td>
            <td><?php echo $row['flight_time']; ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>

<?php $conn->close(); ?>
