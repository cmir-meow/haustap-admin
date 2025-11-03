<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Location</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/booking_location.css" />
  <link rel="stylesheet" href="/client/css/homepage.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- HEADER -->
  <?php include dirname(__DIR__) . "/client/includes/header.php"; ?>

 <main class="booking-location-page">
    <h1 class="page-title">Booking Location</h1>
    <button class="subcategory-btn"><b>Bungalow</b></button>

    <section class="booking-layout">
      <!-- LEFT SIDE -->
      <div class="left-column">
        <!-- Pin Location Box -->
        <div class="pin-box">
<label for="pinLocation"><i class="fa-solid fa-map-marker" aria-hidden="true"></i> Pin Location:</label>
          <input type="text" id="pinLocation" placeholder="Pin your location" />
        </div>

        <!-- Insert Type of House Box -->
        <div class="house-type-box">
<label for="houseType"><i class="fa-solid fa-home" aria-hidden="true"></i> Insert Type of House:</label>
          <input type="text" id="houseType" placeholder="Insert Type of House #" />
        </div>

        <!-- Map Container (Ready for Backend Integration) -->
        <div id="map" class="map-container">
          <p class="map-placeholder-text">Map area (ready for API integration)</p>
        </div>
      </div>

      <!-- RIGHT SIDE -->
      <div class="right-column">
        <!-- Set Address Box -->
        <div class="address-box">
          <div class="address-header">
            <i class="fa-solid fa-house icon"></i>
            <h3>Set Address</h3>
          </div>
          <div class="address-body">
            <p>Blk 11 Lot 6 Mary St. Saint Joseph Village 10<br>
              Brgy. Langgam San Pedro City, Laguna</p>
            <button class="edit-btn">Edit</button>
          </div>
        </div>

        <!-- Saved Address Box -->
        <div class="address-box">
          <div class="address-header">
            <div class="header-left">
              <i class="fa-solid fa-floppy-disk icon"></i>
              <h3>Saved Address</h3>
            </div>
            <input type="radio" name="savedAddress" />
          </div>
          <div class="address-body">
            <p>Blk 11 Lot 6 Apple St. Saint Joseph Village 10<br>
              Brgy. Langgam San Pedro City, Laguna</p>
          </div>
        </div>
      </div>
    </section>

    <!-- PAGINATION -->
    <div class="pagination">
      <button>&lt;</button>
      <button class="active">1</button>
      <button class="active">2</button>
      <button class="active">3</button>
      <button>4</button>
      <button>&gt;</button>
    </div>
  </main>


  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  <script>
    // Wire pagination to proceed to Booking Schedule and persist address info
    document.addEventListener('DOMContentLoaded', function(){
      var pag = document.querySelector('.pagination');
      if (!pag) return;
      var btns = Array.prototype.slice.call(pag.querySelectorAll('button'));
      var back = btns.length ? btns[0] : null;
      var next = btns.length ? btns[btns.length-1] : null;

      var pinInput = document.getElementById('pinLocation');
      var houseInput = document.getElementById('houseType');
      var savedRadio = document.querySelector('input[type="radio"][name="savedAddress"]');
      var savedAddressText = '';
      if (savedRadio) {
        var savedBox = savedRadio.closest('.address-box');
        var savedP = savedBox ? savedBox.querySelector('.address-body p') : null;
        savedAddressText = savedP ? (savedP.textContent || '').trim() : '';
        savedRadio.addEventListener('change', function(){
          if (savedRadio.checked && savedAddressText) {
            try { localStorage.setItem('booking_address', savedAddressText); } catch(e){}
          }
        });
      }
      var subcat = document.querySelector('.subcategory-btn');

      // Determine correct service label to show on this page
      try {
        var params = new URLSearchParams(window.location.search);
        var house = params.get('house');
        var cleaning = params.get('cleaning');
        var serviceParam = params.get('service');
        var stored = localStorage.getItem('selected_service_name');

        function toTitle(s){ return String(s||'').replace(/-/g,' ').replace(/\b\w/g, function(m){ return m.toUpperCase(); }); }
        function cap(s){ return String(s||'').charAt(0).toUpperCase() + String(s||'').slice(1); }

        var computed = '';
        if (house && cleaning) {
          computed = toTitle(house) + ' - ' + cap(cleaning) + ' Cleaning';
        } else if (serviceParam) {
          computed = toTitle(serviceParam);
        } else if (stored) {
          computed = stored;
        }

        if (subcat && computed) {
          subcat.textContent = computed;
          localStorage.setItem('selected_service_name', computed);
        }
      } catch(e){}

      if (back) back.addEventListener('click', function(){
        // Default back behavior: go to previous page
        window.history.back();
      });

      if (next) next.addEventListener('click', function(){
        // If user selected a saved address, use it directly
        if (savedRadio && savedRadio.checked) {
          var saved = savedAddressText;
          if (saved) {
            try { localStorage.setItem('booking_address', saved); } catch(e){}
            window.location.href = '/booking/schedule';
            return;
          }
        }

        // Fallback: require at least a pin or house type
        var pin = (pinInput && pinInput.value) ? pinInput.value.trim() : '';
        var house = (houseInput && houseInput.value) ? houseInput.value.trim() : '';
        if (!pin && !house) {
          alert('Please set a pin location or house type before proceeding.');
          return;
        }
        var addrParts = [];
        if (house) addrParts.push('House: ' + house);
        if (pin) addrParts.push('Pin: ' + pin);
        var addr = addrParts.join(' | ');
        try { localStorage.setItem('booking_address', addr); } catch(e){}
        window.location.href = '/booking/schedule';
      });
    });
  </script>
</body>
</html>
