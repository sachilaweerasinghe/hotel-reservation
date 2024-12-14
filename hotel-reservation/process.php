<?php
include 'db.php';

// Add reservation
if (isset($_POST['submit'])) {
    $hotel_name = $_POST['hotel_name'];
    $guest_name = $_POST['guest_name'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];

    // Validation: Check if check-in and check-out dates are valid
    if ($checkin_date < date('Y-m-d')) {
        header("Location: reservation.php?error=invalid_checkin");
        exit();
    }

    if ($checkout_date <= $checkin_date) {
        header("Location: reservation.php?error=invalid_checkout");
        exit();
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO reservations (hotel_name, guest_name, checkin_date, checkout_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $hotel_name, $guest_name, $checkin_date, $checkout_date);

    if ($stmt->execute() === TRUE) {
        // Redirect back to reservation.php with a success flag for submission
        header("Location: reservation.php?success=1");
    } else {
        header("Location: reservation.php?error=database_error");
    }
}

// Delete reservation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        // Redirect back to your_reservation.php with a delete success flag
        header("Location: your_reservation.php?status=deleted");
    } else {
        header("Location: your_reservation.php?status=error");
    }
}

// Update reservation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $hotel_name = $_POST['hotel_name'];
    $guest_name = $_POST['guest_name'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];

    // Validation: Check if check-in and check-out dates are valid
    if ($checkin_date < date('Y-m-d')) {
        header("Location: update.php?id=$id&error=invalid_checkin");
        exit();
    }

    if ($checkout_date <= $checkin_date) {
        header("Location: update.php?id=$id&error=invalid_checkout");
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE reservations SET hotel_name = ?, guest_name = ?, checkin_date = ?, checkout_date = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $hotel_name, $guest_name, $checkin_date, $checkout_date, $id);

    if ($stmt->execute() === TRUE) {
        // Redirect back to your_reservation.php with an update success flag
        header("Location: your_reservation.php?status=updated");
    } else {
        header("Location: your_reservation.php?status=error");
    }
}

$conn->close();
?>
