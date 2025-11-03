<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirm Booking</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/booking_process/css/confirm_booking.css" />
  <link rel="stylesheet" href="/client/css/homepage.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="/login_sign up/js/api.js"></script>
  <script src="/client/js/booking-api.js"></script>
</head>
 <body>
  <!-- HEADER -->
  <?php include dirname(__DIR__) . "/client/includes/header.php"; ?>
    <main class="confirm-container">
    <div class="confirm-box">
      <img src="/booking_process/images/logo.png" alt="HausTap Logo" class="logo" />
    <div class ="check-icon">
      <i class="fa-solid fa-check-circle check-icon"></i>
    </div>
      <h1 id="confirm-title">Processing your booking…</h1>
      <p id="confirm-status" style="margin-top:8px;color:#555"></p>
      <button class="home-btn">Back To Home</button>
    </div>
  </main>
  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  <script>
    (function(){
      var titleEl = document.getElementById('confirm-title');
      var statusEl = document.getElementById('confirm-status');
      var homeBtn = document.querySelector('.home-btn');
      if (homeBtn) {
        homeBtn.addEventListener('click', function(){ window.location.href = '/'; });
      }

      function show(msg){ if (statusEl) statusEl.textContent = msg || ''; }

      var token = (typeof HausTapBookingAPI !== 'undefined') ? HausTapBookingAPI.getToken() : (localStorage.getItem('haustap_token') || '');
      var mockMode = (typeof window !== 'undefined') && ((window.API_BASE || '').indexOf('/mock-api') !== -1);
      if (!token && !mockMode) {
        titleEl && (titleEl.textContent = 'Please login to continue');
        show('Redirecting to login…');
        setTimeout(function(){ window.location.href = '/login'; }, 1000);
        return;
      }

      // Collect selections from previous steps
      var providerId = parseInt(localStorage.getItem('selected_provider_id') || '0', 10);
      var providerName = localStorage.getItem('selected_provider_name') || '';
      var scheduledDate = localStorage.getItem('selected_date') || null;
      var scheduledTime = localStorage.getItem('selected_time') || null;
      var serviceName = localStorage.getItem('selected_service_name') || 'General Service';
      var address = localStorage.getItem('booking_address') || null;

      // Minimal guardrails
      if (!providerId) {
        if (mockMode) {
          providerId = 1;
          providerName = providerName || 'Demo Provider';
          show('Preview mode: using a demo provider');
        } else {
          titleEl && (titleEl.textContent = 'Select a provider to proceed');
          show('Redirecting to service provider list…');
          setTimeout(function(){ window.location.href = '/booking/choose-sp'; }, 1000);
          return;
        }
      }
      if (!scheduledDate || !scheduledTime) {
        if (mockMode) {
          var now = new Date();
          var yyyy = now.getFullYear();
          var mm = String(now.getMonth() + 1).padStart(2, '0');
          var dd = String(now.getDate()).padStart(2, '0');
          scheduledDate = yyyy + '-' + mm + '-' + dd;
          scheduledTime = '09:00';
          show('Preview mode: using a demo schedule');
        } else {
          titleEl && (titleEl.textContent = 'Pick a schedule to proceed');
          show('Redirecting to schedule selection…');
          setTimeout(function(){ window.location.href = '/booking/schedule'; }, 1000);
          return;
        }
      }

      var payload = {
        provider_id: providerId,
        service_name: serviceName,
        scheduled_date: scheduledDate,
        scheduled_time: scheduledTime,
        address: address,
        price: 0,
        notes: providerName ? ('Booked with ' + providerName) : 'Created via web booking flow',
      };

      titleEl && (titleEl.textContent = 'Creating your booking…');
      show('Please wait while we submit to the server');

      if (typeof HausTapBookingAPI === 'undefined') {
        titleEl && (titleEl.textContent = 'Thank You For Booking!');
        show('Preview mode: API helper not loaded.');
        return;
      }

      HausTapBookingAPI.createBooking(payload)
        .then(function(resp){
          titleEl && (titleEl.textContent = 'Thank You For Booking!');
          var bookingId = (resp && resp.data && resp.data.id) || (resp && resp.id) || null;
          show(bookingId ? ('Booking ID: #' + bookingId) : 'Booking created successfully.');
          try {
            localStorage.removeItem('selected_date');
            localStorage.removeItem('selected_time');
            localStorage.removeItem('selected_provider_id');
            localStorage.removeItem('selected_provider_name');
          } catch {}
        })
        .catch(function(err){
          var msg = (err && err.message) || 'Failed to create booking';
          titleEl && (titleEl.textContent = 'Could not complete booking');
          show(msg + '. Please try again later.');
        });
    })();
  </script>
 </body>
