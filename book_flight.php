<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "classic_airline";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$confirmationMessage = ""; // Store message for display

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $passenger_name = $_POST['passengerName'] ?? null;
    $email = $_POST['email'] ?? null;
    $id_number = $_POST['idNumber'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $sex = $_POST['sex'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $departure_date = $_POST['departureDate'] ?? null;
    $passenger_count = $_POST['passengerCount'] ?? null;
    $flight_type = isset($_POST['flightType']) ? implode(", ", $_POST['flightType']) : null;
    $from_location = $_POST['from'] ?? null;
    $to_location = $_POST['to'] ?? null;
    $flight_time = $_POST['time'] ?? null;

    if (!$passenger_name || !$email || !$id_number || !$departure_date || !$from_location || !$to_location) {
        $confirmationMessage = "❌ Error: Missing required fields.";
    } else {
        $sql = "INSERT INTO bookings (passenger_name, email, id_number, dob, sex, phone, departure_date, passenger_count, flight_type, from_location, to_location, flight_time) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssissss", $passenger_name, $email, $id_number, $dob, $sex, $phone, $departure_date, $passenger_count, $flight_type, $from_location, $to_location, $flight_time);

        if ($stmt->execute()) {
            $confirmationMessage = "✅ Booking Successful!";
        } else {
            $confirmationMessage = "❌ SQL Error: " . $conn->error;
        }

        $stmt->close();
    }
}

// Redirect back to the form page with confirmation message
header("Location: index.php?msg=" . urlencode($confirmationMessage));
exit();

$conn->close();
?>
