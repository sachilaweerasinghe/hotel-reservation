<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservations - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css?v=1.1">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px; /* Location of the box */
        }
        /* Centered headings and increase font size */
h1 {
    text-align: center; /* Center the main heading */
    font-size: 2em; /* Increase font size */
}

h2 {
    text-align: center; /* Center the heading */
    font-size: 2.5em; /* Increase font size */
    padding-bottom: 5px; /* Space between text and underline */
}

h2::after {
    content: ''; /* Required for pseudo-elements */
    display: block; /* Make it a block element */
    width: 45%;
    height: 4px; /* Thickness of the underline */
    background: linear-gradient(90deg, #4CAF50, #FFC107, #4CAF50); /* Gradient underline */
    transform: translateX(60%); /* Center it under the text */
   
    
}


p {
    text-align: center; /* Center paragraphs */
    font-size: 0.75em; /* Increase font size of paragraphs */
}


        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 5px; /* Rounded corners */
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Center items vertically */
            position: relative; /* To position the close icon */
        }

        .modal img {
            max-width: 150px; /* Set image size */
            margin-left: 20px; /* Space between text and image */
            border-radius: 5px; /* Rounded corners for images */
        }

        /* Close icon */
        .close {
            position: absolute;
            top: 10px; /* Distance from the top */
            right: 10px; /* Distance from the right */
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        /* Banner Slideshow styles */
        .banner {
            position: relative;
            overflow: hidden;
            height: 480px; /* Adjust height as needed */
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Cover the entire area while maintaining aspect ratio */
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0; /* Start with all images hidden */
            transition: opacity 1s ease-in-out; /* Fade effect */
            filter: blur(0); /* No blur for clear images */
        }

        .banner img.active {
            opacity: 1; /* Only the active image will be visible */
        }

        /* Welcome Text */
        .banner h1,
        .banner p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the text */
            color: white; /* Text color */
            z-index: 10; /* Ensure text is above images */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Add shadow for better visibility */
            text-align: center; /* Center align text */
        }

        /* Navigation Tools */
        .nav-tools {
            text-align: center; /* Center the navigation */
            margin: 20px 0; /* Space around navigation */
        }

        .nav-tools a {
            margin: 0 15px; /* Space between links */
            text-decoration: none; /* Remove underline */
            color: #4CAF50; /* Link color */
            font-weight: bold; /* Make links bold */
            transition: color 0.3s; /* Smooth color transition */
        }

        .nav-tools a:hover {
            color: #45a049; /* Darker green on hover */
        }

        /* Hotel Card Styles */
        .hotels {
            margin: 20px 0;
        }

        .hotel-list {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping of cards */
            justify-content: center; /* Center the cards */
            gap: 20px; /* Space between cards */
        }

        .hotel {
            cursor: pointer; /* Change cursor to pointer */
            transition: transform 0.2s; /* Smooth scaling effect */
            width: 200px; /* Fixed width for hotel cards */
            text-align: center; /* Center text */
            border: 1px solid #ddd; /* Border around hotel card */
            border-radius: 5px; /* Rounded corners */
            overflow: hidden; /* Prevent overflow */
            background-color: #f9f9f9; /* Light background */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding: 10px; /* Padding inside hotel cards */
            margin: 10px; /* Margin around hotel cards */
        }

        .hotel img {
            width: 100%; /* Full width for images */
            height: 120px; /* Fixed height for images */
            object-fit: cover; /* Cover to maintain aspect ratio */
            border-radius: 5px; /* Rounded corners for images */
        }

        .hotel:hover {
            transform: scale(1.05); /* Scale up on hover */
        }

        /* Button styles */
        .button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px; /* Space above the button */
        }

        .button:hover {
            background-color: #45a049; /* Darker green */
        }

        /* Apply fonts */
        body {
            font-family: 'Montserrat', sans-serif; /* Body font */
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif; /* Heading font */
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

    <section class="banner">
        <img class="active" src="images/sachila23.jpg" alt="Santani Wellness Resort & Spa">
        <img src="images/sachila9.jpg" alt="Shangri-La Colombo">
        <img src="images/sachila3.jpg" alt="Anantara Peace Resort">
        <img src="images/sachila8.jpeg" alt="Cinnamon Wild Yala">
        <h1>Welcome to CheckINN</h1>
    </section>

    <!-- Navigation Tools -->
    <div class="nav-tools">
        <a href="#most-viewed">Most Viewed Hotels</a>
        <a href="#recommended">Recommended Hotels</a>
        <a href="#budget-friendly">Budget Friendly Hotels</a>
    </div>

    <main>
        <section class="hotels" id="most-viewed">
            <h2>Most Viewed Hotels</h2>
            <div class="hotel-list">
                <div class="hotel" onclick="openModal('Santani Wellness Resort & Spa', 'images/sachila3.jpg', 'Santani Wellness Resort & Spa is a luxurious destination for rejuvenation and relaxation, offering wellness programs and exquisite natural surroundings. Experience holistic therapies, top-notch service, and a serene environment that invites tranquility and restoration.')">
                    <img src="images/sachila3.jpg" alt="Santani Wellness Resort & Spa">
                    <h3>Santani Wellness Resort & Spa</h3>
                </div>
                <div class="hotel" onclick="openModal('Shangri-La Colombo', 'images/hotel2.jpeg', 'Shangri-La Colombo is a premier urban resort offering stunning views of the ocean and city. Indulge in exceptional dining, wellness, and leisure experiences, and enjoy a perfect blend of luxury and comfort in the heart of the city.')">
                    <img src="images/hotel2.jpeg" alt="Shangri-La Colombo">
                    <h3>Shangri-La Colombo</h3>
                </div>
                <div class="hotel" onclick="openModal('Anantara Peace Resort', 'images/hotel3.jpeg', 'Anantara Peace Resort is set in a tranquil location with beachfront access, perfect for those seeking adventure and relaxation. Enjoy gourmet dining, spa services, and a range of activities that cater to every preference.')">
                    <img src="images/hotel3.jpeg" alt="Anantara Peace Resort">
                    <h3>Anantara Peace Resort</h3>
                </div>
                <div class="hotel" onclick="openModal('Cinnamon Wild Yala', 'images/hotel4.jpeg', 'Cinnamon Wild Yala combines luxury with nature, offering a unique safari experience. Stay in stunning accommodations and explore the rich biodiversity of the surrounding area, including the famous Yala National Park.')">
                    <img src="images/hotel4.jpeg" alt="Cinnamon Wild Yala">
                    <h3>Cinnamon Wild Yala</h3>
                </div>
            </div>
        </section>

        <section class="hotels" id="recommended">
            <h2>Recommended Hotels</h2>
            <div class="hotel-list">
                <div class="hotel" onclick="openModal('Heritance Kandalama', 'images/sachila24.jpg', 'Heritance Kandalama is a sustainable hotel built into a rock face, offering breathtaking views and eco-friendly luxury. Guests can immerse themselves in nature while enjoying exceptional comfort and service.')">
                    <img src="images/sachila24.jpg" alt="Heritance Kandalama">
                    <h3>Heritance Kandalama</h3>
                </div>
                <div class="hotel" onclick="openModal('Amaya Lake Dambulla', 'images/sachila21.jpg', 'Amaya Lake Dambulla is a nature-themed resort that provides a peaceful escape with luxurious accommodations and stunning views of the surrounding landscape. Enjoy a serene environment with modern comforts.')">
                    <img src="images/sachila21.jpg" alt="Amaya Lake Dambulla">
                    <h3>Amaya Lake Dambulla</h3>
                </div>
                <div class="hotel" onclick="openModal('The Fortress Resort & Spa', 'images/sachila6.jpg', 'The Fortress Resort & Spa blends luxury with an ancient Sri Lankan vibe, offering high-end amenities, private beach access, and superb dining options for an unforgettable stay.')">
                    <img src="images/sachila6.jpg" alt="The Fortress Resort & Spa">
                    <h3>The Fortress Resort & Spa</h3>
                </div>
                <div class="hotel" onclick="openModal('Jetwing Lighthouse', 'images/sachila19.jpg', 'Jetwing Lighthouse is a luxurious hotel located on the southern coast, known for its exceptional service, stunning architecture, and breathtaking ocean views.')">
                    <img src="images/sachila19.jpg" alt="Jetwing Lighthouse">
                    <h3>Jetwing Lighthouse</h3>
                </div>
            </div>
        </section>

        <section class="hotels" id="budget-friendly">
            <h2>Budget Friendly Hotels</h2>
            <div class="hotel-list">
                <div class="hotel" onclick="openModal('The Kingsbury', 'images/sachila18.jpg', 'The Kingsbury offers affordable luxury in the heart of Colombo, with easy access to shopping and attractions. Guests can enjoy comfortable accommodations without breaking the bank.')">
                    <img src="images/sachila18.jpg" alt="The Kingsbury">
                    <h3>The Kingsbury</h3>
                </div>
                <div class="hotel" onclick="openModal('OZO Colombo', 'images/sachila16.jpg', 'OZO Colombo is a stylish hotel with modern amenities, located near the beach. It offers great value for money while providing a vibrant atmosphere and excellent service.')">
                    <img src="images/sachila16.jpg" alt="OZO Colombo">
                    <h3>OZO Colombo</h3>
                </div>
                <div class="hotel" onclick="openModal('Ceylon City Hotel', 'images/sachila14.jpg', 'Ceylon City Hotel is an economical choice in Colombo, providing clean, comfortable rooms and easy access to popular sites and public transport.')">
                    <img src="images/sachila14.jpg" alt="Ceylon City Hotel">
                    <h3>Ceylon City Hotel</h3>
                </div>
                <div class="hotel" onclick="openModal('City Hub', 'images/sachila12.jpg', 'City Hub is a budget-friendly hostel offering shared and private accommodations, perfect for backpackers and solo travelers looking for a sociable environment.')">
                    <img src="images/sachila12.jpg" alt="City Hub">
                    <h3>City Hub</h3>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div id="hotelModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div>
                <h2 id="modalHotelName"></h2>
                <img id="modalHotelImage" src="" alt="">
                <p id="modalHotelDescription"></p>
                <button class="button" onclick="reserveHotel()">Reserve Now</button>
            </div>
        </div>
    </div>

    <script>
        // Slideshow functionality
        let slideIndex = 0;
        const slides = document.querySelectorAll('.banner img');

        function showSlides() {
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === slideIndex) {
                    slide.classList.add('active');
                }
            });
            slideIndex = (slideIndex + 1) % slides.length; // Loop back to the start
            setTimeout(showSlides, 4000); // Change image every 4 seconds
        }

        showSlides();

        // Modal functionality
        function openModal(hotelName, hotelImage, hotelDescription) {
            document.getElementById('modalHotelName').innerText = hotelName;
            document.getElementById('modalHotelImage').src = hotelImage;
            document.getElementById('modalHotelDescription').innerText = hotelDescription;
            document.getElementById('hotelModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('hotelModal').style.display = 'none';
        }

        function reserveHotel() {
            alert('Reservation process initiated for ' + document.getElementById('modalHotelName').innerText);
        }
    </script>
</body>
</html>
