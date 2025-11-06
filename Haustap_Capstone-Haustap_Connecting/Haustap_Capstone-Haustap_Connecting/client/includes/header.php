<?php
// Client header now delegates to the shared header component
$context = 'client';
require dirname(__DIR__, 2) . '/includes/header.shared.php';
?>
<script>
  // Default socket URL for notifications/chat if not set elsewhere
  window.SOCKET_URL = window.SOCKET_URL || 'http://localhost:3000';
</script>
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
<script src="/client/js/notify.js" defer></script>
<script src="/client/js/toast.js" defer></script>
<script src="/client/js/notify-ui.js" defer></script>
<script src="/js/lazy-images.js" defer></script>
<script src="/client/js/user_profile.js"></script>
<script src="/client/js/referral-init.js" defer></script>
<script src="/client/js/service-price-capture.js" defer></script>
<script src="/my_account/js/referral-modal.js" defer></script>
<script>
  // Enforce guest UI until login: hide client-only elements and route Bookings to /login
  (function(){
    function hasToken(){
      try { return !!localStorage.getItem('haustap_token'); } catch(e){ return false; }
    }
    if (hasToken()) return;
    var bell = document.getElementById('notifBellBtn');
    var drop = document.getElementById('notifDropdown');
    var account = document.querySelector('.account-link');
    if (bell) bell.style.display = 'none';
    if (drop) drop.style.display = 'none';
    if (!drop) { var d = document.getElementById('notifDropdown'); if (d) d.classList.add('hidden'); }
    if (account) account.style.display = 'none';
    var headerRight = document.querySelector('.header-right');
    if (headerRight && !document.querySelector('.auth-links')) {
      var auth = document.createElement('div');
      auth.className = 'auth-links';
      auth.innerHTML = '<div class="signup-link"><a href="/signup">Sign up</a></div><span>|</span><div class="login-link"><a href="/login">Login</a></div>';
      headerRight.appendChild(auth);
    }
    // Route Bookings to login for guests
    var navLinks = document.querySelectorAll('.nav a');
    navLinks.forEach(function(a){
      try {
        if (a.textContent && a.textContent.trim() === 'Bookings') {
          a.setAttribute('href', '/login');
        }
      } catch(e) {}
    });
  })();
</script>
