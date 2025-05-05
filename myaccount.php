<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

// Generate avatar based on user ID's last digit
$avatarNumber = isset($_SESSION['user_id']) ? substr($_SESSION['user_id'], -1) : '1';
$avatarImages = [
    '0' => 'avatars/0.png',
    '1' => 'avatars/1.png',
    '2' => 'avatars/2.png',
    '3' => 'avatars/3.png',
    '4' => 'avatars/4.png',
    '5' => 'avatars/5.png',
    '6' => 'avatars/6.png',
    '7' => 'avatars/7.png',
    '8' => 'avatars/8.png',
    '9' => 'avatars/9.png'
];

// Default avatar if something goes wrong
$avatarSrc = $avatarImages[$avatarNumber] ?? 'avatars/avatar1.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | BusReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/page.css">
    <style>
        .account-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .account-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .account-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            overflow: hidden;
        }
        
        .account-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .account-details {
            flex: 1;
        }
        
        .account-section {
            margin-bottom: 2rem;
        }
        
        .account-section h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 1rem;
        }
        
        .detail-label {
            width: 150px;
            font-weight: 500;
        }
        
        .detail-value {
            flex: 1;
        }
        
        .edit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .edit-btn:hover {
            background-color: var(--secondary-color);
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
    
    <div class="account-container">
        <div class="account-header">
            <div class="account-avatar">
            <img src="<?php echo $avatarSrc; ?>" alt="User Avatar">
            </div>
            <div class="account-details">
                <h2>My Account</h2>
                <p>Welcome back, <?php echo $_SESSION['name']; ?></p>
            </div>
        </div>
        
        <div class="account-section">
            <h3>Personal Information</h3>
            <div class="detail-row">
                <div class="detail-label">Email:</div>
                <div class="detail-value"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
            </div>
            <!-- Add more personal info fields as needed -->
            <button class="edit-btn">Edit Information</button>
        </div>
        
        <div class="account-section">
            <h3>Booking History</h3>
            <p>Your recent bookings will appear here.</p>
            <!-- Add booking history functionality -->
        </div>
        
        <div class="account-section">
            <h3>Account Settings</h3>
            <a href="change-password.php" class="edit-btn">Change Password</a>
            <a href="logout.php" class="edit-btn" style="background-color: var(--accent-color); margin-left: 10px;">Logout</a>
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
         document.addEventListener('DOMContentLoaded', function() {
            const accountToggle = document.querySelector('.account-toggle');
            const accountDropdown = document.getElementById('accountDropdown');
            
            // Toggle dropdown on click
            accountToggle.addEventListener('click', function(e) {
                e.preventDefault();
                accountDropdown.style.display = accountDropdown.style.display === 'block' ? 'none' : 'block';
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!accountToggle.contains(e.target) && !accountDropdown.contains(e.target)) {
                    accountDropdown.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>