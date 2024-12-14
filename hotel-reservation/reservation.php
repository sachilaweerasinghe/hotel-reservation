<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservations - Make a Reservation</title>
    <link rel="stylesheet" href="styles.css">

    <!-- CSS for Toast Notification -->
    <style>
    body {
        background-image: url('images/sachila9.jpg'); 
        background-size: cover;
        background-repeat: no-repeat; 
        background-position: center;
        color: white; 
    }

    .reservation-form {
        background-color: rgba(0, 0, 0, 0.7); /* Black background with 70% opacity */
        padding: 20px; /* Add some padding around the form */
        border-radius: 8px; /* Optional: add rounded corners */
    }

    .toast {
        visibility: hidden; /* Hidden by default */
        min-width: 250px; /* Min width */
        margin-left: -125px; /* Center the toast */
        background-color: rgba(0, 0, 0, 0.8); /* Slightly transparent black background */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded corners */
        padding: 16px; /* Padding */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 50%; /* Center the toast */
        bottom: 30px; /* 30px from the bottom */
        font-size: 17px; /* Font size */
    }

    .toast.show {
        visibility: visible; /* Show the toast */
        animation: fadein 0.5s, fadeout 0.5s 2.5s; /* Fade in and out */
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;} 
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;} 
        to {bottom: 0; opacity: 0;}
    }
</style>


    <!-- JavaScript for client-side date validation and toast notification -->
    <script>
        // Function to validate the dates
        function validateDates() {
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format

            // Check that check-in date is not in the past
            if (checkin < today) {
                alert('Check-in date cannot be in the past.');
                return false;
            }

            // Check that check-out date is after the check-in date
            if (checkout <= checkin) {
                alert('Check-out date must be after the check-in date.');
                return false;
            }

            return true;
        }

        // Function to show the toast notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message; // Set the message
            toast.className = "toast show"; // Add the show class to the toast

            // Remove the toast after 3 seconds
            setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
        }

        // Check for success or error messages
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                showToast('Reservation made successfully!');
            }
            if (urlParams.has('error')) {
                showToast('Error occurred while making the reservation.');
            }
        };
    </script>
</head>
<body>
    <header>
        <nav>
            <div class="logo">CheckINN</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="reservation.php">Make a Reservation</a></li>
                <li><a href="your_reservation.php">Your Reservations</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="reservation-form">
            <h2>Make a Reservation</h2>
            <!-- Add the 'onsubmit' event to trigger validation before form submission -->
            <form action="process.php" method="POST" onsubmit="return validateDates()">
                <label for="hotel">Hotel:</label>
                <select name="hotel_name" id="hotel">
                    <option value="Seaside Resort">Seaside Resort</option>
                    <option value="Mountain Retreat">Mountain Retreat</option>
                    <option value="Lakeside Inn">Lakeside Inn</option>
                    <option value="City Center Hotel">City Center Hotel</option>
                    <option value="Countryside Lodge">Countryside Lodge</option>
                    <option value="Beachfront Villa">Beachfront Villa</option>
                    <option value="Luxury Spa Resort">Luxury Spa Resort</option>
                    <option value="Eco-Friendly Retreat">Eco-Friendly Retreat</option>
                    <option value="Budget Stay Hotel">Budget Stay Hotel</option>
                    <option value="Family-Friendly Resort">Family-Friendly Resort</option>
                    <option value="Business Hotel">Business Hotel</option>
                    <option value="Boutique Hotel">Boutique Hotel</option>
                </select>

                <label for="guest-name">Guest Name:</label>
                <input type="text" name="guest_name" id="guest-name" required>

                <label for="checkin">Check-in Date:</label>
                <input type="date" name="checkin_date" id="checkin" required>

                <label for="checkout">Check-out Date:</label>
                <input type="date" name="checkout_date" id="checkout" required>

                <button type="submit" name="submit">Reserve</button>
            </form>
        </section>

        <!-- Toast Notification -->
        <div id="toast"></div>
    </main>

    <footer>
        <p>&copy; 2024 CheckINN | All Rights Reserved</p>
    </footer>
</body>
</html>
