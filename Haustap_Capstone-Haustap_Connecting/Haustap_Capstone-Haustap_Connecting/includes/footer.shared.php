<?php
// Shared footer partial for both guest and client contexts
// Usage: set $context = 'guest' or 'client' before requiring this file

$context = isset($context) ? $context : 'guest';
$logoSrc = $context === 'client' ? '/client/images/logo.png' : '/guest/images/logo.png';
?>
<!-- FOOTER -->
<footer>
  <div class="footer-content">
    <!-- Left Section -->
    <div class="footer-left">
      <h4>ABOUT HausTap</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Policies</a></li>
        <li><a href="#">Our Sitemap</a></li>
        <li><a href="#">Our Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Testimonials</a></li>
      </ul>
    </div>

    <!-- Center Section -->
    <div class="footer-center">
      <img src="<?= $logoSrc ?>" alt="HausTap Logo" />
      <p>Your space. Your peace. Your Glow</p>
    </div>

    <!-- Right Section -->
    <div class="footer-right">
      <h4>FOLLOW US</h4> <br>
      <ul>
        <li><i class="fab fa-facebook-f"></i> Facebook</li>
        <li><i class="fab fa-instagram"></i> Instagram</li>
      </ul>
      <div class="contact-info">
        <p>
          Address: Abc Road 12345<br />
          Philippines<br />
          Phone: +65 949 9226 246<br />
          Email: HAUSTAP_PH@gmail.com
        </p>
      </div>
    </div>
  </div>
  <div class="footer-bottom">2025 HausTap. All Rights Reserved.</div>
</footer>