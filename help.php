<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Help | Bus Reservation System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/page.css">
  <link rel="stylesheet" href="css/help.css">
</head>
<body>
    <div class="navbar">
        <div class="logo"><a href="page.php">Bus<span>Reserve</span></a></div>
        <div>
            <a href="help.php">Help</a>
            <a href="#account" id="openModal">Account</a>
        </div>
    </div>

  <div class="help-container">
    <h1>Need Help? We're Here for You!</h1>
    <p>If you have any questions, issues, or suggestions regarding our Bus Reservation System, our support team is ready to assist you 24/7.</p>
    
    <div class="contact-info">
      <p><i class="fas fa-phone-alt"></i> <span>Phone Support:</span> +91-98765-43210</p>
      <p><i class="fas fa-envelope"></i> <span>Email Support:</span> support@busreserve.com</p>
      <p><i class="fas fa-comments"></i> <span>Live Chat:</span> Available 8AM-10PM daily</p>
    </div>

    <div class="support-options">
      <div class="support-card">
        <i class="fas fa-question-circle"></i>
        <h3>FAQs</h3>
        <p>Find quick answers to common questions about bookings, payments, cancellations and more.</p>
      </div>
      <div class="support-card">
        <i class="fas fa-book"></i>
        <h3>Help Center</h3>
        <p>Detailed guides and tutorials to help you navigate our platform and services.</p>
      </div>
      <div class="support-card">
        <i class="fas fa-headset"></i>
        <h3>Contact Support</h3>
        <p>Reach out to our customer support team for personalized assistance.</p>
      </div>
    </div>

    <div class="faq-section">
      <h2>Frequently Asked Questions</h2>
      <div class="faq-container">
        <div class="faq-item">
          <div class="faq-question">
            <span>How do I book a bus ticket?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <p>Booking a bus ticket is simple! Just enter your departure and destination cities, select your travel date, choose the number of passengers, and click 'Search Buses'. You'll see all available options and can select your preferred bus.</p>
          </div>
        </div>
        
        <div class="faq-item">
          <div class="faq-question">
            <span>What payment methods do you accept?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <p>We accept all major credit/debit cards, net banking, UPI payments, and popular digital wallets like Paytm, PhonePe, and Google Pay.</p>
          </div>
        </div>
        
        <div class="faq-item">
          <div class="faq-question">
            <span>Can I cancel my booking?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <p>Yes, you can cancel your booking through the 'My Trips' section in your account. Cancellation policies vary by operator, and refund amounts depend on when you cancel relative to the departure time.</p>
          </div>
        </div>
        
        <div class="faq-item">
          <div class="faq-question">
            <span>How do I track my bus?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <p>After booking, you'll receive a confirmation email with tracking details. You can also track your bus in real-time through the 'My Trips' section once the journey has started.</p>
          </div>
        </div>
        
        <div class="faq-item">
          <div class="faq-question">
            <span>What safety measures are in place?</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer">
            <p>All our partner operators follow strict safety protocols including regular sanitization, temperature checks, and mandatory masks. Many buses also offer contactless boarding options.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="page.php">Home</a></li>
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
          <li><a href="help.html">Contact Us</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Support</h3>
        <ul>
          <li><a href="help.html">Help Center</a></li>
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
    // FAQ toggle functionality
    document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', () => {
        const item = question.parentNode;
        item.classList.toggle('active');
        
        // Close other open FAQs
        document.querySelectorAll('.faq-item').forEach(otherItem => {
          if (otherItem !== item && otherItem.classList.contains('active')) {
            otherItem.classList.remove('active');
          }
        });
      });
    });
  </script>
</body>
</html>