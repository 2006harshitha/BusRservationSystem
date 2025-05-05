<?php
session_start();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'bus');
    
    if (!$conn) {
        $error = "Database connection failed: " . mysqli_connect_error();
    } else {
        // Prepare the SQL statement - IMPORTANT: This is vulnerable to SQL injection!
        $query = "SELECT id, name, email, phone, password FROM users WHERE email = '".mysqli_real_escape_string($conn, $email)."' AND password = '".mysqli_real_escape_string($conn, $password)."'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            // Fetch the user data
            $user = mysqli_fetch_assoc($result);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['email']; 
            $_SESSION['name'] = $user['name'];
            $_SESSION['logged_in'] = true;
            $_SESSION['mobile'] = $user['phone']; // This was missing a semicolon
            
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Redirect to protected page
            header("Location: page.php");
            exit;
        } else {  
            // If we get here, login failed
            $error = "Invalid email or password";
        } 
        
        // Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BusReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="navbar">
        <a href="page.php" class="logo">Bus<span>Reserve</span></a>
        <div>
            <a href="help.html">Help</a>
            <a href="signuppage.php">Sign Up</a>
        </div>
    </div>
    
    <div class="login-container">
        <div class="login-box">
            <h1 class="login-title"><i class="fas fa-user-circle"></i> User Login</h1>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form id="loginForm" method="post" action="login.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>
                
                <div class="login-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="forgot-password.html">Forgot password?</a>
                    </div>
                </div>
                
                <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
                
                <div class="divider">or login with</div>
                <div class="social-login">
                    <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn google"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a>
                </div>
                
                <div class="signup-link">
                    Don't have an account? <a href="signuppage.php">Sign up here</a>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About BusReserve</h3>
                <p>Your trusted platform for safe and easy bus reservations. We connect travelers with the best options at the best prices.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="page.php">Home</a></li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="signuppage.php">Sign Up</a></li>
                    <li><a href="forgot-password.html">Forgot Password</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 BusReserve. All rights reserved.
        </div>
    </footer>
</body>
</html>