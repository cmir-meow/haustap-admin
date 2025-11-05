<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Overview</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/booking_process/css/booking_overview.css" />
  <link rel="stylesheet" href="/client/css/homepage.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="/login_sign up/js/api.js"></script>
  <script src="/client/js/booking-api.js"></script>
</head>

<body>
  <!-- HEADER -->
  <?php include dirname(__DIR__) . "/client/includes/header.php"; ?>

<main class="booking-overview">
  <h1 class="page-title">Booking Overview</h1>

  <section class="overview-box">
    <div class="service-header">
      <h2>Home Cleaning</h2>
      <h3><strong>Bungalow - Basic Cleaning</strong></h3>
      <hr>
    </div>

    <div class="details">
      <p><strong>Date:</strong> May 21, 2025</p>
      <p><strong>Time:</strong> 1:00 PM</p>
      <p class="multi-line">
        <strong>Address:</strong> B1 L50 Mango St. Phase 1 Saint Joseph Village 10,
        Barangay Langgam, City of San Pedro, Laguna 4023
      </p>
      <p class="multi-line">
        <strong>You selected:</strong> <b>Bungalow 80 - 150 sqm</b>
      </p>
      <p class="multi-line">
        <strong></strong> <b>Basic Cleaning - 1 Cleaner</b>
      </p>

      <div class="inclusions multi-line">
        <p>
          Inclusions:<br
          Living Room: walis, mop, dusting furniture, trash removal<br>
          Bedrooms: bed making, sweeping, dusting, trash removal<br>
          Hallways: mop & sweep, remove cobwebs<br>
          Windows & Mirrors: quick wipe
        </p>
      </div>
    </div>

    <div class="notes-section">
      <label for="notes" class="notes-label"><b>Notes:</b></label>
      <textarea id="notes"></textarea>
      <hr>
    </div>

    <div class="voucher-section">
      <div class="voucher-left">
        <i class="fa-solid fa-ticket icon"></i>
        <span>Add a Voucher</span>
      </div>
      <div class="voucher-toggle">
        <button class="toggle-btn">></button>
      </div>
    </div>

    <div class="summary">
  <div class="summary-row">
    <strong>Sub Total:</strong> <span>₱800.00</span>
  </div>
  <div class="summary-row">
    <strong>Voucher Discount:</strong> <span>₱0</span>
  </div>
  <div class="summary-row total">
    <strong>TOTAL:</strong> <span>₱800.00</span>
  </div>
</div>

    <p class="footer-note">
      Full payment will be collected directly by the service provider upon completion of the service.
    </p>
  </section>

    <!-- PAGINATION -->
    <div class="pagination">
      <button>&lt;</button>
      
      
      
      
      
      <button>&gt;</button>
    </div>
  </main>


  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  <script>
    (function(){
      // Read selections from localStorage without altering the markup or layout
      function get(k){ try { return localStorage.getItem(k); } catch(e){ return null; } }
      var TZ = 'Asia/Manila';
      function formatDate(iso){
        try {
          var d = new Date(iso);
          return new Intl.DateTimeFormat('en-US', { timeZone: TZ, year:'numeric', month:'short', day:'numeric' }).format(d);
        } catch(e){ return iso; }
      }
      function formatTime(hhmm){
        if (!hhmm) return '';
        var parts = String(hhmm).split(':');
        var h = parseInt(parts[0]||'0',10), m = parts[1]||'00';
        var ampm = h>=12 ? 'PM' : 'AM';
        var h12 = h%12; if (h12===0) h12=12;
        return h12 + ':' + (m.length===1?('0'+m):m) + ' ' + ampm;
      }

      var selectedDate = get('selected_date');
      var selectedTime = get('selected_time');
      var address = get('booking_address');
      var serviceName = get('selected_service_name');
      var providerName = get('selected_provider_name');

      // Update service header text if available (content only)
      var h2 = document.querySelector('.service-header h2');
      var h3 = document.querySelector('.service-header h3');
      if (h3 && serviceName) { h3.innerHTML = '<strong>' + serviceName + '</strong>'; }
      if (h2 && providerName) { h2.textContent = providerName; }

      // Update details lines by matching labels; keep structure same
      var detailPs = Array.prototype.slice.call(document.querySelectorAll('.details p'));
      detailPs.forEach(function(p){
        var text = p.textContent || '';
        if (text.trim().startsWith('Date:') && selectedDate) {
          p.innerHTML = '<strong>Date:</strong> ' + formatDate(selectedDate);
        }
        if (text.trim().startsWith('Time:') && selectedTime) {
          p.innerHTML = '<strong>Time:</strong> ' + formatTime(selectedTime);
        }
        if (text.trim().startsWith('Address:') && address) {
          p.innerHTML = '<strong>Address:</strong> ' + address;
        }
      });

      // Update "You selected" line with the chosen service name
      var multiLines = Array.prototype.slice.call(document.querySelectorAll('.details p.multi-line'));
      if (multiLines.length) {
        var selectedLine = multiLines[0];
        var bEl = selectedLine ? selectedLine.querySelector('b') : null;
        if (bEl && serviceName) { bEl.textContent = serviceName; }
      }

      // Update subtotal and total to reflect selected price
      var price = (function(){ try { var v = localStorage.getItem('selected_service_price'); return v ? Number(v) : 0; } catch(e){ return 0; } })();
      var summarySpans = Array.prototype.slice.call(document.querySelectorAll('.summary span'));
      if (summarySpans.length >= 2) {
        var subtotalEl = summarySpans[0];
        var totalEl = summarySpans[summarySpans.length-1];
        var formattedPrice = '₱' + price.toFixed(2);
        if (subtotalEl) subtotalEl.textContent = formattedPrice;
        if (totalEl) totalEl.textContent = formattedPrice;
      }

      // Persist notes typing for use on confirm page
      var notesEl = document.getElementById('notes');
      if (notesEl) {
        var existing = get('booking_notes');
        if (existing) notesEl.value = existing;
        notesEl.addEventListener('input', function(){
          try { localStorage.setItem('booking_notes', notesEl.value || ''); } catch(e){}
        });
      }

      // Use pagination arrows for navigation without adding new UI
      var pag = document.querySelector('.pagination');
      if (pag) {
        var btns = Array.prototype.slice.call(pag.querySelectorAll('button'));
        if (btns.length) {
          var back = btns[0];
          var next = btns[btns.length-1];
          if (back) back.addEventListener('click', function(){ window.location.href = '/booking/schedule'; });
          // After overview, go to Choose Service Provider step
          if (next) next.addEventListener('click', function(){ window.location.href = '/booking/choose-sp'; });
        }
      }
    })();
  </script>
</body>
</html>

