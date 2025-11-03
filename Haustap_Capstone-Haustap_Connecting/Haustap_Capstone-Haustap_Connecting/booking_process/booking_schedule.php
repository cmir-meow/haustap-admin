<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Schedule</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/booking_process/css/booking_schedule.css" />
  <link rel="stylesheet" href="/client/css/homepage.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="/login_sign up/js/api.js"></script>
  <script src="/client/js/booking-api.js"></script>
</head>

<body>
  <!-- HEADER -->
  <?php include dirname(__DIR__) . "/client/includes/header.php"; ?>

<main class="booking-schedule">
    <h1 class="page-title">Booking Schedule</h1>
    <button class="subcategory-btn"><b>Bungalow</b></button>

    <section class="schedule-box">
      <h2 class="section-title">DATE</h2>

      <div class="date-grid">
        <!-- Example static list for UI only -->
        <label class="date-box" data-date="2025-10-06">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 6, 2025</strong><br>Monday</div>
        </label>

        <label class="date-box today" data-date="2025-10-07">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 7, 2025</strong><br>Tuesday - Today</div>
        </label>

        <label class="date-box" data-date="2025-10-08">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 8, 2025</strong><br>Wednesday</div>
        </label>

        <label class="date-box" data-date="2025-10-09">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 9, 2025</strong><br>Thursday</div>
        </label>

        <label class="date-box" data-date="2025-10-10">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 10, 2025</strong><br>Friday</div>
        </label>

        <label class="date-box" data-date="2025-10-11">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 11, 2025</strong><br>Saturday</div>
        </label>

        <label class="date-box" data-date="2025-10-12">
          <input type="radio" name="date" />
          <div class="date-text"><strong>Oct 12, 2025</strong><br>Sunday</div>
        </label>
      </div>

      <h2 class="section-title">TIME</h2>
      <select class="time-select">
        <option selected disabled>Select Time</option>
        <option value="08:00">8:00 AM</option>
        <option value="09:00">9:00 AM</option>
        <option value="10:00">10:00 AM</option>
        <option value="11:00">11:00 AM</option>
        <option value="12:00">12:00 PM</option>
        <option value="13:00">1:00 PM</option>
        <option value="14:00">2:00 PM</option>
        <option value="15:00">3:00 PM</option>
        <option value="16:00">4:00 PM</option>
      </select>
    </section>

    <div class="pagination">
      <button class="back-btn">&lt;</button>
      <button class="active">1</button>
      <button class="active">2</button>
      <button class="active">3</button>
      <button class="active">4</button>
      <button>5</button>
      <button class="next-btn">&gt;</button>
    </div>
  </main>

  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  <script>
    (function(){
      var selectedDate = null;
      var selectedTime = null;
      // Read stored service label and display without overwriting
      var subcat = document.querySelector('.subcategory-btn');
      var storedServiceName = '';
      try { storedServiceName = localStorage.getItem('selected_service_name') || ''; } catch(e){}
      if (subcat && storedServiceName) {
        subcat.innerHTML = '<b>' + storedServiceName + '</b>';
      }

      var labels = Array.prototype.slice.call(document.querySelectorAll('.date-box'));
      labels.forEach(function(label){
        var input = label.querySelector('input[type="radio"]');
        var iso = label.getAttribute('data-date');
        if (input) {
          input.addEventListener('change', function(){
            selectedDate = iso || null;
            labels.forEach(function(l){ l.style.outline = 'none'; });
            label.style.outline = '2px solid #009999';
          });
        }
        // Also allow clicking the label itself
        label.addEventListener('click', function(){
          selectedDate = iso || null;
          labels.forEach(function(l){ l.style.outline = 'none'; });
          label.style.outline = '2px solid #009999';
          var inp = label.querySelector('input[type="radio"]');
          if (inp) inp.checked = true;
        });
      });

      var timeSelect = document.querySelector('.time-select');
      if (timeSelect) {
        selectedTime = timeSelect.value && timeSelect.value !== 'Select Time' ? timeSelect.value : null;
        timeSelect.addEventListener('change', function(){
          selectedTime = timeSelect.value && timeSelect.value !== 'Select Time' ? timeSelect.value : null;
        });
      }

      var backBtn = document.querySelector('.back-btn');
      if (backBtn) backBtn.addEventListener('click', function(){ window.location.href = '/booking/choose-sp'; });

      var nextBtn = document.querySelector('.next-btn');
      if (nextBtn) nextBtn.addEventListener('click', function(){
        // Default to first labeled date if none explicitly selected
        if (!selectedDate) {
          var first = document.querySelector('.date-box');
          selectedDate = first ? first.getAttribute('data-date') : null;
        }
        try {
          if (selectedDate) localStorage.setItem('selected_date', selectedDate);
          if (selectedTime) localStorage.setItem('selected_time', selectedTime);
        } catch {}
        window.location.href = '/booking/confirm';
      });
    })();
  </script>
</body>
</html>
