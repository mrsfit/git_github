<?php
$showForm = true; 

if (isset($_GET['msg'])) {
    $confirmationMessage = htmlspecialchars($_GET['msg']);
    $showForm = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Flight</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #b4bd6d;
        }

        section {
            border: 2px solid black;
            background-color: #333;
            padding: 20px;
            color: #fff;
            width: 450px;
            height: auto;
            text-align: center;
        }

        #confirmationMessage {
            color: white;
            font-size: 18px;
            margin-top: 10px;
            padding: 10px;
            background-color: #28a745;
            display: block;
        }

        #bookingForm {
            display: <?php echo $showForm ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body>

<section class="bookingForm">
    <?php if (!$showForm) { ?>
        <div id="confirmationMessage"><?php echo $confirmationMessage; ?></div>
        <br>
        <a href="index.php" style="color: #fff; text-decoration: none; background: #007bff; padding: 10px;">Book Again</a>
    <?php } ?>

    <form id="bookingForm" action="book_flight.php" method="post">
        <label>Passenger Name:</label>
        <input type="text" name="passengerName" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>ID Number:</label>
        <input type="text" name="idNumber" required>

        <label>Date of Birth:</label>
        <input type="date" name="dob">

        <label>Sex:</label>
        <label><input type="radio" name="sex" value="M" required> Male</label>
        <label><input type="radio" name="sex" value="F"> Female</label>

        <label>Phone Number:</label>
        <input type="tel" name="phone">

        <label>Departure Date:</label>
        <input type="date" name="departureDate" required>

        <label>Passengers:</label>
        <input type="number" name="passengerCount" min="1" required>

        <label>Flight Type:</label>
        <label><input type="checkbox" name="flightType[]" value="Business"> Business</label>
        <label><input type="checkbox" name="flightType[]" value="Economic"> Economic</label>

        <label>From:</label>
        <select name="from" required>
            <option value="RWANDA">RWANDA</option>
            <option value="France">France</option>
            <option value="Dubai">Dubai</option>
        </select>

        <label>To:</label>
        <select name="to" required>
            <option value="UK">UK</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Canada">Canada</option>
        </select>

        <label>Flight Time:</label>
        <input type="time" name="time">

        <input type="submit" value="Book Flight">
    </form>
</section>

</body>
</html>
