<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Add some CSS for the toast and background image -->
    <style>
        body {
            background-image: url('images/sachila9.jpg'); /* Your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: white; /* Set text color to white for readability */
        }

        /* Semi-transparent background for the form and table */
        .reservations, .reservation-list {
            background-color: rgba(0, 0, 0, 0.7); /* Black background with 70% opacity */
            padding: 20px;
            border-radius: 8px;
        }

        .toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 30px;
            transform: translateX(-50%);
            font-size: 17px;
        }

        .toast.show {
            visibility: visible;
            animation: fadeInOut 3s forwards; /* Animation to hide the toast after 3 seconds */
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            background-color: rgba(255, 255, 255, 0.9); /* White with slight transparency */
            color: black; /* Black text for the table */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray for even rows */
        }

        tr:hover {
            background-color: #ddd; /* Gray on hover */
        }

        .button {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            color: white;
            background-color: #007BFF; /* Blue button */
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
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
        <section class="reservations">
            <h2>Your Reservations</h2>

            <!-- Search form for filtering by date and guest name -->
            <form method="GET" class="search-form">
                <label for="search-date">Search by Date:</label>
                <input type="date" name="search-date" id="search-date">

                <label for="search-guest">Search by Guest Name:</label>
                <input type="text" name="search-guest" id="search-guest" placeholder="Enter guest name">

                <button type="submit">Search</button>
            </form>

            <div class="reservation-list">
                <?php
                $dateFilter = isset($_GET['search-date']) ? $_GET['search-date'] : null;
                $guestFilter = isset($_GET['search-guest']) ? $_GET['search-guest'] : null;

                // Build the SQL query with filters
                $sql = "SELECT * FROM reservations WHERE 1=1"; // Default to all reservations

                if ($dateFilter) {
                    $sql .= " AND checkin_date = '$dateFilter'";
                }

                if ($guestFilter) {
                    $sql .= " AND guest_name LIKE '%$guestFilter%'";
                }

                $result = $conn->query($sql);

                // Check if there are reservations
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Hotel Name</th>
                                    <th>Guest Name</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>";
                    
                    // Fetch each row and display in table format
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['hotel_name']}</td>
                                <td>{$row['guest_name']}</td>
                                <td>{$row['checkin_date']}</td>
                                <td>{$row['checkout_date']}</td>
                                <td>
                                    <a href='update.php?id={$row['id']}' class='button'>Update</a>
                                    <a href='process.php?delete={$row['id']}' class='button'>Delete</a>
                                </td>
                              </tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<p>No reservations found.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 CheckINN | All Rights Reserved</p>
    </footer>

    <!-- Toast message div -->
    <div id="toast" class="toast"></div>

    <!-- JavaScript for toast message -->
    <script>
        // Function to show toast message
        function showToast(message) {
            var toast = document.getElementById('toast');
            toast.innerHTML = message;
            toast.className = 'toast show';
            setTimeout(function() {
                toast.className = toast.className.replace('show', '');
            }, 3000); // Hide after 3 seconds
        }

        // Check if there's a status in the URL query string
        const params = new URLSearchParams(window.location.search);
        const status = params.get('status');

        if (status === 'updated') {
            showToast('Reservation updated successfully!');
        } else if (status === 'deleted') {
            showToast('Reservation deleted successfully!');
        } else if (status === 'error') {
            showToast('An error occurred!');
        }
    </script>
</body>
</html>
