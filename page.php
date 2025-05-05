<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Reservation System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .logo span {
            color: #3498db;
        }
        
        .navbar > div {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .navbar a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .navbar a:hover {
            color: #3498db;
        }
        
        /* Dropdown Styles */
        .account-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .account-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1000;
            padding: 0.5rem 0;
        }
        
        .dropdown-content.show {
            display: block;
        }
        
        .dropdown-username {
            display: block;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            color: #2c3e50;
        }
        
        .dropdown-content a {
            padding: 0.75rem 1rem;
            display: block;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .dropdown-content a:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-content i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
            color: #7f8c8d;
        }
        
        /* Main Content Styles */
        .background {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 5rem 2rem;
            text-align: center;
        }
        
        .background h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }
        
        .search-box {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .search-box-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .search-box-items > div {
            text-align: left;
        }
        
        .search-box label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 500;
        }
        
        .search-box input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        #search-submit {
            grid-column: 1 / -1;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        
        #search-submit:hover {
            background-color: #2980b9;
        }
        
        /* Other sections (offers, features, about, footer) */
        .offers, .features, .about {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .offers h2, .features h2, .about h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        
        .offers p, .features p, .about p {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .offer-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .offer-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .offer-card:hover {
            transform: translateY(-5px);
        }
        
        .offer-card i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
        
        .offer-card h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        .offer-card p {
            color: #7f8c8d;
            margin-bottom: 0;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .feature-item {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .feature-item i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
        
        .feature-item h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        .feature-item p {
            color: #7f8c8d;
            margin-bottom: 0;
        }
        
        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            align-items: center;
            margin-top: 2rem;
        }
        
        .about-text p {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        
        .about-image img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 3rem 2rem 1rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-section h3 {
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section li {
            margin-bottom: 0.75rem;
        }
        
        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: #3498db;
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background-color: #3498db;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bdc3c7;
            font-size: 0.9rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }
            
            .background {
                padding: 3rem 1rem;
            }
            
            .background h2 {
                font-size: 2rem;
            }
            
            .search-box {
                padding: 1.5rem;
            }
            
            .offers, .features, .about {
                padding: 3rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Bus<span>Reserve</span></div>
        <div>
            <a href="help.php" target="_blank">Help</a>
            <div class="account-dropdown">
                <a href="#" id="accountLink" class="account-toggle">
                    <?php 
                    if(isset($_SESSION['logged_in'])) {
                        echo htmlspecialchars($_SESSION['name']);
                    } else {
                        echo 'Account';
                    }
                    ?>
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-content" id="accountDropdown">
                    <?php if(isset($_SESSION['logged_in'])): ?>
                        <span class="dropdown-username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="myaccount.php"><i class="fas fa-user"></i> My Account</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else: ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                        <a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
        
    <div class="background">
        <h2>Book Your Bus Ticket With Ease</h2>
        <div class="search-box">
            <form onsubmit="goToDisplay(event)" class="search-box-items">
                <div>
                    <label for="from">From</label>
                    <input type="text" placeholder="Enter origin city" id="from" list="from-list" name="from" required>
                    <datalist id="from-list">
                        <option value="Bangalore">
                        <option value="Chennai">
                        <option value="Goa">
                        <option value="Hosur">
                        <option value="Hyderabad">
                        <option value="Kanyakumari">
                        <option value="Kolkata">
                        <option value="Mumbai">
                        <option value="Pondicherry">
                        <option value="Tamilnadu">
                        <option value="Tirupati">
                    </datalist>
                </div>
                <div>
                    <label for="to">To</label>
                    <input type="text" placeholder="Enter destination city" id="to" list="to-list" name="to" required>
                    <datalist id="to-list">
                        <option value="Bangalore">
                        <option value="Chennai">
                        <option value="Goa">
                        <option value="Hyderabad">
                        <option value="Kanyakumari">
                        <option value="Kolkata">
                        <option value="Mumbai">
                        <option value="Pondicherry">
                        <option value="Tamilnadu">
                        <option value="Tirupati">
                    </datalist>
                </div>
                <div>
                    <label for="date">Travel Date</label>
                    <input type="date" name="date" id="date" onfocus="this.min = new Date().toISOString().split('T')[0];" required>
                </div>
                <div>
                    <label for="passengers">Passengers</label>
                    <input type="number" name="numOfPassengers" placeholder="Number of passengers" id="passengers" min="1" max="46" required>
                </div>
                <button id="search-submit" name="search">
                    <i class="fas fa-search"></i> Search Buses
                </button>
            </form>
        </div>
    </div>
    
    <div class="offers">
        <h2>Exclusive Offers</h2>
        <p>Get amazing discounts and deals on your bus bookings</p>
        
        <div class="offer-cards">
            <div class="offer-card">
                <i class="fas fa-percentage"></i>
                <h3>First Booking Discount</h3>
                <p>Get up to 50% off on your first booking with us!</p>
            </div>
            <div class="offer-card">
                <i class="fas fa-user-friends"></i>
                <h3>Group Discount</h3>
                <p>Special discounts for group bookings of 5+ passengers</p>
            </div>
            <div class="offer-card">
                <i class="fas fa-bolt"></i>
                <h3>Last Minute Deals</h3>
                <p>Great prices for bookings made within 24 hours of travel</p>
            </div>
        </div>
    </div>
    
    <div class="features">
        <h2>Why Choose BusReserve?</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <i class="fas fa-shield-alt"></i>
                <h3>Safe Travel</h3>
                <p>Verified operators and safety protocols for your peace of mind</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-ticket-alt"></i>
                <h3>Easy Booking</h3>
                <p>Simple and fast booking process with instant confirmation</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Our customer care team is always ready to assist you</p>
            </div>
        </div>
    </div>
    
    <div class="about">
        <h2>About Us</h2>
        <div class="about-content">
            <div class="about-text">
                <p>Welcome to BusReserve, your trusted platform for hassle-free bus booking. We connect travelers with reliable bus operators across the country, offering a seamless booking experience with competitive prices.</p>
                <p>Our mission is to make bus travel more accessible, comfortable, and convenient for everyone. With thousands of routes and operators to choose from, we're your one-stop solution for all your bus travel needs.</p>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1509749837427-ac94a2553d0e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Bus travel">
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Bus Tickets</a></li>
                    <li><a href="#">Routes</a></li>
                    <li><a href="#">Offers</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 BusReserve. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const accountToggle = document.getElementById('accountLink');
            const accountDropdown = document.getElementById('accountDropdown');
            
            // Toggle dropdown on click
            accountToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                accountDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.account-dropdown')) {
                    accountDropdown.classList.remove('show');
                }
            });
        });

        // Search form functionality
        function goToDisplay(event) {
            event.preventDefault();
            const from = document.getElementById("from").value.trim();
            const to = document.getElementById("to").value.trim();
            const date = document.getElementById("date").value;
            const passengers = document.getElementById("passengers").value;
            const queryString = `from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}&date=${encodeURIComponent(date)}&passengers=${encodeURIComponent(passengers)}`;
            window.location.href = `displaybus.html?${queryString}`;
        }
    </script>
</body>
</html>