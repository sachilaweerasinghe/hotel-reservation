<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM reservations WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">CheckINN</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="reservation.php">Make a Reservation</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="reservation-form">
            <h2>Update Reservation</h2>
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="hotel">Hotel:</label>
                <select name="hotel_name" id="hotel">
                    <option value="Seaside Resort" <?php if ($row['hotel_name'] == 'Seaside Resort') echo 'selected'; ?>>Seaside Resort</option>
                    <option value="Mountain Retreat" <?php if ($row['hotel_name'] == 'Mountain Retreat') echo 'selected'; ?>>Mountain Retreat</option>
                    <!-- Add more options for hotels -->
                </select>

                <label for="guest-name">Guest Name:</label>
                <input type="text" name="guest_name" id="guest-name" value="<?php echo $row['guest_name']; ?>" required>

                <label for="checkin">Check-in Date:</label>
                <input type="date" name="checkin_date" id="checkin" value="<?php echo $row['checkin_date']; ?>" required>

                <label for="checkout">Check-out Date:</label>
                <input type="date" name="checkout_date" id="checkout" value="<?php echo $row['checkout_date']; ?>" required>

                <button type="submit" name="update">Update</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 CheckINN | All Rights Reserved</p>
    </footer>
</body>
</html>
