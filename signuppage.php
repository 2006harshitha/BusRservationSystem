<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | BusReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
            --text-color: #333;
            --text-light: #7f8c8d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        .navbar div {
            display: flex;
            gap: 2rem;
        }
        
        .navbar a {
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        .navbar a:hover {
            color: var(--primary-color);
        }
        
        .navbar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s;
        }
        
        .navbar a:hover::after {
            width: 100%;
        }
        
        /* Signup Container */
        .signup-container {
            display: flex;
            min-height: calc(100vh - 120px);
            align-items: center;
            justify-content: center;
            padding: 2rem 5%;
        }
        
        .signup-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
        }
        
        .signup-image {
            flex: 1;
            background: linear-gradient(rgba(52, 152, 219, 0.8), rgba(52, 152, 219, 0.8)), 
                        url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .signup-image h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .signup-image p {
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .signup-form {
            flex: 1;
            padding: 3rem;
        }
        
        .signup-form h2 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .signup-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 1rem;
        }
        
        .signup-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 1.5rem 5%;
            text-align: center;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .signup-card {
                flex-direction: column;
            }
            
            .signup-image {
                padding: 2rem;
            }
            
            .navbar {
                padding: 1rem;
            }
            
            .navbar div {
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo"><a href="page.php">Bus<span>Reserve</span></a></div>
        <div>
            <a href="help.html">Help</a>
            <a href="#languages">Languages</a>
            <a href="#account" id="openModal">Account</a>
        </div>
    </div>
    
    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-image">
                <h2>Welcome to BusReserve!</h2>
                <p>To keep connected with us please sign up with your personal information</p>
                <p>Already have an account?</p>
                <a href="login.php" class="signup-btn" style="background: transparent; border: 2px solid white; max-width: 200px;">Log In</a>
            </div>
            <div class="signup-form">
                <h2>Create Account</h2>
                <form action="signup.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            <option value="prefer-not-to-say">Prefer not to say</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" min="12" max="120">
                    </div>
                    <button type="submit" class="signup-btn">Sign Up</button>
                </form>
                <div class="login-link">
                    Already have an account? <a href="login.php">Log in</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>&copy; 2025 BusReserve. All rights reserved.</p>
    </div>
</body>
</html>