<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HausTap Bookings</title>
  <link rel="stylesheet" href="/css/global.css">
  <link rel="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/booking.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="/client/css/homepage.css"></head>
<body><?php include dirname(__DIR__) . "/client/includes/header.php"; ?>

  <!-- Skeleton Overlay -->
  <div id="skeleton-overlay" class="skeleton-overlay">
    <div class="skeleton-grid">
      <div class="skeleton-row">
        <div class="skeleton-block skeleton-line shimmer" style="width:50%"></div>
      </div>
      <div class="skeleton-line shimmer" style="width:90%"></div>
      <div class="skeleton-line shimmer" style="width:85%"></div>
      <div class="skeleton-row">
        <div class="skeleton-circle"></div>
        <div class="skeleton-block skeleton-line shimmer" style="width:30%"></div>
        <div class="skeleton-block skeleton-line shimmer" style="width:15%"></div>
      </div>
      <div class="skeleton-row" style="margin-top:8px">
        <div class="spinner" aria-hidden="true"></div>
        <span style="font-size:14px;color:#555">Loading bookings…</span>
      </div>
    </div>
  </div>

  <script>
    (function(){
      var overlay = document.getElementById('skeleton-overlay');
      function show(){ document.body.classList.add('loading'); overlay.style.display='block'; }
      function hide(){ document.body.classList.remove('loading'); overlay.style.display='none'; }
      window.HausTapLoading = { show: show, hide: hide };
      show();
      window.addEventListener('DOMContentLoaded', function(){ setTimeout(hide, 800); });
    })();
  </script>

  <div class="page-content">

  <!-- tabs -->
  <div class="mytabs">
    <input type="radio" id="tabpending" name="mytabs" checked="checked">
      <label for="tabpending">Pending</label>
      <div class="tab">
        <div class="booking-list" data-status="pending"></div>
        <!-- Static Pending demo removed; dynamic bookings render into .booking-list -->

      </div>
      

      <input type="radio" id="tabongoing" name="mytabs">
      <label for="tabongoing">Ongoing</label>
      <div class="tab">
        <div class="booking-list" data-status="ongoing"></div>
        <div class="booking_tables">
        <div class="booking-header">
          <div>
            <h2>Home Cleaning</h2>
            <p>Bungalow - Basic Cleaning</p>
          </div>
          <div class="booking-status">
          <span>Booking ID</span>
          <span class="status">ONGOING</span>
          </div>
        </div>
        </div>
        <!-- Details -->
        <div class="booking-details">
          <div class="detail">
          <strong>Date</strong>
          <p>May 21, 2025</p>
          </div>
          <div class="detail">
          <strong>Time</strong>
          <p>11:00 AM - 2:00 PM</p>
          </div>
          <div class="detail address">
          <strong>Address</strong>
          <p>B1 L50 Mango st. Phase 1 Saint Joseph Village 10<br>
          Barangay Langgam, City of San Pedro, Laguna 4023</p>
          </div>
        </div>
          <div class="booking-details">
  <div class="detail full-width total-line">
    <span class="label">Total:</span>
    <span class="price">2,500</span>
  </div>
  <p class="payment-note">
    Full payment will be collected directly by the service provider upon completion of the service.
  </p>
</div>

        <!-- booking-footer -->
        <div class="booking-footer">
          <div class="service-provider">
            <div class="service-provider-top">
              <i class="fa-solid fa-user account-icon"></i>
              <span class="name">Ana Santos</span>
              <i class="fa-solid fa-comment message-icon"></i>
            </div>
            <div class="rating">
              <i class="fa-solid fa-star" aria-hidden="true"></i> (4.9)
            </div>
          </div>
          <div class="actions">
            <div class="dropdown">
              <button class="btn btn-outline-dark dropdown-toggle" type="view_progress" data-bs-toggle="dropdown">View Progress</button>
              <ul class="dropdown-menu progress-menu">
                <li><a class="dropdown-item" href="#"><b>View Progress</b></a></li>
                <li><a class="dropdown-item" href="#">Timeline:</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-square-check completed"></i> Worker confirmed</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-square-check completed"></i> Worker arrived</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-hourglass-half"></i> Service in progress</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-circle-check" style="visibility:hidden"></i> Service completed</a></li>
              </ul>
            </div>
            <div class="dropdown">
              <button class="btn btn-outline-dark dropdown-toggle" type="more" data-bs-toggle="dropdown">More</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Contact Seller</a></li>
                <li><a class="dropdown-item" href="#">Buy Again</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      

      <input type="radio" id="tabcompleted" name="mytabs">
      <label for="tabcompleted">Completed</label>
      <div class="tab">
        <div class="booking-list" data-status="completed"></div>
        <div class="booking_tables">
        <div class="booking-header">
          <div>
            <h2>Home Cleaning</h2>
            <p>Bungalow - Basic Cleaning</p>
          </div>
          <div class="booking-status">
          <span>Booking ID</span>
          <span class="status">COMPLETED</span>
          </div>
        </div>
        </div>
        <!-- Details -->
        <div class="booking-details">
          <div class="detail">
          <strong>Date</strong>
          <p>May 21, 2025</p>
          </div>
          <div class="detail">
          <strong>Time</strong>
          <p>11:00 AM - 2:00 PM</p>
          </div>
          <div class="detail address">
          <strong>Address</strong>
          <p>B1 L50 Mango st. Phase 1 Saint Joseph Village 10<br>
          Barangay Langgam, City of San Pedro, Laguna 4023</p>
          </div>
        </div>
        <div class="booking-details">
            <div class="detail full-width">
              <span>Total:</span>
              <span>2,500</span>
            </div>
        </div>

        <!-- booking-footer -->
        <div class="booking-footer">
          <div class="service-provider">
            <div class="service-provider-top">
              <i class="fa-solid fa-user account-icon"></i>
              <span class="name">Ana Santos</span>
              <i class="fa-solid fa-comment message-icon"></i>
            </div>
            <div class="rating">
              <i class="fa-solid fa-star" aria-hidden="true"></i> (4.9)
            </div>
          </div>
          <div class="actions">
            <button class="rate">Rate</button>
            <div class="dropdown">
              <button class="btn btn-outline-dark" type="button" data-bs-toggle="dropdown">
                Request for Return
              </button>
            <div class="dropdown-menu request-return p-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="mb-0">Service Issue. How Can We Help?</h6>
              <button type="button" class="btn-close" data-bs-dismiss="dropdown" aria-label="Close"></button>
              </div>
<!-- Option 1 -->
              <div class="form-check border p-2 mb-2 rounded">
                <input class="form-check-input" type="checkbox" id="issue1" checked>
                <label class="form-check-label fw-bold" for="issue1">
                The service was completed, but I have issues
                </label>
                <small class="text-muted d-block">
                I received service that is incomplete, defective, or not as agreed.
                </small>
              </div>

<!-- Option 2 -->
              <div class="form-check border p-2 rounded">
                <input class="form-check-input" type="checkbox" id="issue2">
                <label class="form-check-label fw-bold" for="issue2">
                The service was not fully completed
                </label>
                <small class="text-muted d-block">
                 Missing work, incomplete tasks, or service provider left early.
                </small>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-outline-dark" type="more" data-bs-toggle="dropdown">More</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Contact Seller</a></li>
            <li><a class="dropdown-item" href="#">Buy Again</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <p class="return-reminder">
  Reminder: You may request a return for free within 24 hours after the service. <br>
  After 24 hours, a 300 return fee will be charged.
</p>
      </div>

      <input type="radio" id="tabcancelled" name="mytabs">
      <label for="tabcancelled">Cancelled</label>
      <div class="tab">
        <div class="booking-list" data-status="cancelled"></div>
        <div class="booking_tables">
        <div class="booking-header">
          <div>
            <h2>Home Cleaning</h2>
            <p>Bungalow - Basic Cleaning</p>
          </div>
          <div class="booking-status">
          <span>Booking ID</span>
          <span class="status">CANCELLED</span>
          </div>
        </div>
        </div>
        <!-- Details -->
        <div class="booking-details">
          <div class="detail">
          <strong>Date</strong>
          <p>May 21, 2025</p>
          </div>
          <div class="detail">
          <strong>Time</strong>
          <p>11:00 AM - 2:00 PM</p>
          </div>
          <div class="detail address">
          <strong>Address</strong>
          <p>B1 L50 Mango st. Phase 1 Saint Joseph Village 10<br>
          Barangay Langgam, City of San Pedro, Laguna 4023</p>
          </div>
        </div>
        <div class="booking-details">
            <div class="detail full-width">
              <span>Total:</span>
              <span>2,500</span>
            </div>
        </div>

        <!-- booking-footer -->
        <div class="booking-footer">
          <div class="service-provider">
            <div class="service-provider-top">
              <i class="fa-solid fa-user account-icon"></i>
              <span class="name">Ana Santos</span>
              <i class="fa-solid fa-comment message-icon"></i>
            </div>
            <div class="rating">
              <i class="fa-solid fa-star" aria-hidden="true"></i> (4.9)
            </div>
          </div>
          <div class="actions">
            <div class="dropdown">
              <button class="btn btn-outline-dark dropdown-toggle" type="more" data-bs-toggle="dropdown">View Cancellation Details</button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">View Full Cancellation Details</a></li>
                <li><a class="dropdown-item" href="#">Book Again</a></li>
                <li><a class="dropdown-item" href="#">Contact Support</a></li>
              </ul>
            </div>
          </div>
        </div>
          <p class="cancellation_details">View Cancellation Policy</p>
      </div>
    </div>

  
  
    <!-- FOOTER -->
  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  </div>
  <script src="/login_sign up/js/api.js"></script>
  <script src="/client/js/ht-confirm.js"></script>
  <script src="/client/js/booking-api.js"></script>
  <script>
    (function(){
      var focusId = (function(){
        try {
          var p = new URLSearchParams(window.location.search);
          return p.get('focus') || localStorage.getItem('last_booking_id') || null;
        } catch(e) { return null; }
      })();

      function fmtDate(d){ try { var dt = new Date(d); return dt.toLocaleDateString(undefined, { year:'numeric', month:'short', day:'2-digit' }); } catch(e){ return d || ''; } }
      function fmtTime(t){ try {
        var parts = String(t||'').split(':');
        if (parts.length>=2){ var h = Number(parts[0]); var m = parts[1]; var ampm = h>=12 ? 'PM' : 'AM'; h = h%12; if (h===0) h=12; return h+':'+m+' '+ampm; }
        return t || '';
      } catch(e){ return t || ''; } }

      function normalizeStatus(s){
        s = String(s||'').toLowerCase();
        if (!s) return 'pending';
        if (s === 'accepted' || s === 'in_progress' || s === 'inprogress' || s === 'started' || s === 'ongoing') return 'ongoing';
        if (s === 'done' || s === 'finished' || s === 'complete' || s === 'completed') return 'completed';
        if (s === 'canceled' || s === 'cancelled') return 'cancelled';
        return s;
      }

      function el(tag, cls){ var e = document.createElement(tag); if (cls) e.className = cls; return e; }
      function renderCard(b){
        var wrap = el('div', 'booking_tables dynamic');
        var header = el('div', 'booking-header');
        var left = el('div', '');
        var h2 = el('h2'); h2.textContent = b.service_name || 'Service';
        var p = el('p'); p.textContent = (b.provider && b.provider.name) ? b.provider.name : (b.address || '').slice(0,80);
        left.appendChild(h2); left.appendChild(p);
        var right = el('div', 'booking-status');
        var idSpan = el('span'); idSpan.textContent = 'Booking ID';
        var pipe = el('span', 'status'); pipe.textContent = '|';
        var st = el('span', 'status'); st.textContent = String(normalizeStatus(b.status)||'').toUpperCase();
        right.appendChild(idSpan); right.appendChild(pipe); right.appendChild(st);
        header.appendChild(left); header.appendChild(right);
        wrap.appendChild(header);

        var details = el('div', 'booking-details');
        var d1 = el('div', 'detail'); d1.appendChild(el('strong')).textContent='Date'; var dp=el('p'); dp.textContent = fmtDate(b.scheduled_date); d1.appendChild(dp);
        var d2 = el('div', 'detail'); d2.appendChild(el('strong')).textContent='Time'; var tp=el('p'); tp.textContent = fmtTime(b.scheduled_time); d2.appendChild(tp);
        var d3 = el('div', 'detail address'); d3.appendChild(el('strong')).textContent='Address'; var ap=el('p'); ap.textContent = b.address || '—'; d3.appendChild(ap);
        details.appendChild(d1); details.appendChild(d2); details.appendChild(d3);
        wrap.appendChild(details);

        var totals = el('div', 'booking-details no-border');
        var tline = el('div', 'detail full-width'); var tlabel = el('span'); tlabel.textContent='Total:'; var tval = el('span'); tval.textContent = (b.price!=null) ? String(b.price) : '—'; tline.appendChild(tlabel); tline.appendChild(tval); totals.appendChild(tline);
        wrap.appendChild(totals);

        // Client-side cancel for pending bookings
        var statusNorm = normalizeStatus(b.status);
        if (statusNorm === 'pending') {
          var footer = el('div', 'booking-footer');
          var actions = el('div', 'actions');
          var cancelBtn = el('button', 'btn btn-outline-dark');
          cancelBtn.textContent = 'Cancel';
          cancelBtn.addEventListener('click', function(){
            if (!window.HausTapBookingAPI || !b.id) return;
            window.htConfirm('Cancel this booking?', { title:'Cancel Booking', okText:'Cancel Booking', cancelText:'Keep Booking' })
              .then(function(go){ if (!go) return; HausTapLoading && HausTapLoading.show && HausTapLoading.show();
                window.HausTapBookingAPI.cancelBooking(b.id)
                  .then(function(){ refresh(); })
                  .catch(function(err){ console.error('Cancel failed', err); alert('Unable to cancel right now.'); })
                  .finally(function(){ HausTapLoading && HausTapLoading.hide && HausTapLoading.hide(); });
              });
          });
          actions.appendChild(cancelBtn);
          footer.appendChild(actions);
          wrap.appendChild(footer);
        }

        // Add Chat button for ongoing or accepted bookings
        if (statusNorm === 'ongoing') {
          var footer2 = el('div', 'booking-footer');
          var actions2 = el('div', 'actions');
          var chatBtn = el('button', 'btn btn-outline-dark');
          chatBtn.textContent = 'Chat';
          chatBtn.addEventListener('click', function(){
            try {
              var url = '/client/contact_client.php?booking_id=' + encodeURIComponent(b.id);
              window.location.href = url;
            } catch(e) { console.error(e); }
          });
          actions2.appendChild(chatBtn);
          footer2.appendChild(actions2);
          wrap.appendChild(footer2);
        }

        if (String(focusId||'') === String(b.id||'')) {
          wrap.style.outline = '2px solid #2fb576';
          wrap.style.boxShadow = '0 0 0 3px rgba(47,181,118,0.2)';
          setTimeout(function(){ wrap.scrollIntoView({ behavior:'smooth', block:'center' }); }, 100);
        }
        return wrap;
      }

      function placeCard(b){
        var status = normalizeStatus(b.status||'pending');
        var container = document.querySelector('.booking-list[data-status="'+status+'"]');
        if (!container) return;
        container.appendChild(renderCard(b));
        // Hide static demo blocks once we have dynamic data
        var tab = container.closest('.tab');
        if (tab) {
          // Hide static demo blocks once we have dynamic data,
          // but keep footers visible to allow static Cancel button fallback.
          var demos = tab.querySelectorAll('.booking_tables:not(.dynamic), .after-bookings, .return-reminder, .cancellation_details');
          demos.forEach(function(x){ x.style.display='none'; });
        }
      }

      function clearDynamic(){
        var lists = document.querySelectorAll('.booking-list');
        lists.forEach(function(list){ list.innerHTML = ''; });
      }

      function listAndRender(){
        try {
          if (typeof HausTapBookingAPI === 'undefined') return;
          HausTapLoading && HausTapLoading.show && HausTapLoading.show();
          HausTapBookingAPI.listBookings().then(function(resp){
            var arr = [];
            if (resp && resp.data && resp.data.data && Array.isArray(resp.data.data)) arr = resp.data.data;
            else if (resp && resp.data && Array.isArray(resp.data)) arr = resp.data;
            else if (Array.isArray(resp)) arr = resp;
            // Show all bookings, including pending, to reflect full workflow
            clearDynamic();
            arr.forEach(placeCard);
          }).catch(function(err){
            console.error('Booking list failed:', err);
          }).finally(function(){ HausTapLoading && HausTapLoading.hide && HausTapLoading.hide(); });
        } catch(e) { console.error(e); }
      }

      function refresh(){ listAndRender(); }

      // Attempt to render bookings; if unauthorized or unavailable, static demo remains
      listAndRender();
      // Poll for updates every 30 seconds to keep statuses in sync
      setInterval(function(){ try { listAndRender(); } catch(e){} }, 30000);

      // Fallback: enable Cancel on static Pending card when API is available
      try {
        var staticCancel = document.querySelector('.cancel-pending-static');
        if (staticCancel) {
          staticCancel.addEventListener('click', function(){
            var bid = null;
            try { bid = localStorage.getItem('last_booking_id'); } catch(e){}
            if (!bid) { alert('No booking selected to cancel yet.'); return; }
            if (typeof HausTapBookingAPI === 'undefined') { alert('Cancellation not available in preview mode.'); return; }
            window.htConfirm('Cancel this booking?', { title:'Cancel Booking', okText:'Cancel Booking', cancelText:'Keep Booking' })
              .then(function(go){ if (!go) return; HausTapLoading && HausTapLoading.show && HausTapLoading.show();
                HausTapBookingAPI.cancelBooking(bid)
                  .then(function(){ refresh(); })
                  .catch(function(err){ console.error('Cancel failed', err); alert('Unable to cancel right now.'); })
                  .finally(function(){ HausTapLoading && HausTapLoading.hide && HausTapLoading.hide(); });
              });
          });
        }
      } catch(e) { /* ignore */ }
    })();
  </script>
</body>
</html>
