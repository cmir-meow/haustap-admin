<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Type of Cleaning | Homi</title>
  <link rel="stylesheet" href="css/indoor-cleaning.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/client/css/homepage.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></head>
<body>
<?php include dirname(__DIR__) . "/client/includes/header.php"; ?>
  <main>
    <h1 class="main-title">Type of Cleaning</h1>
    <button class="cleaning-type-btn">Villa Larger</button>
    <div class="cleaning-cards-container">
      <div class="cleaning-cards-row">
        <div class="cleaning-card">
          <input type="radio" name="cleaning" class="cleaning-radio" id="basic-cleaning">
          <label for="basic-cleaning" class="radio-label"></label>
        <div class="cleaning-title">Basic Cleaning &ndash; 4 Cleaners</div>
          <div class="cleaning-price">₱7,000</div>
          <div class="cleaning-inclusions-title">Inclusions:</div>
          <ul class="cleaning-inclusions">
            <li>All rooms swept, mopped, dusted</li>
            <li>Trash collection</li>
            <li>Windows & mirrors wiped</li>
          </ul>
        </div>
        <div class="cleaning-card">
          <input type="radio" name="cleaning" class="cleaning-radio" id="standard-cleaning">
          <label for="standard-cleaning" class="radio-label"></label>
        <div class="cleaning-title">Standard Cleaning &ndash; 5 Cleaners</div>
          <div class="cleaning-price">₱12,000</div>
          <div class="cleaning-inclusions-title">Inclusions:</div>
          <ul class="cleaning-inclusions">
            <li>All Basic tasks</li>
            <li>Kitchen deep clean</li>
            <li>Bathroom full scrub</li>
            <li>Furniture under cleaning</li>
          </ul>
        </div>
      </div>
      <div class="cleaning-cards-row">
        <div class="cleaning-card wide">
          <input type="radio" name="cleaning" class="cleaning-radio" id="deep-cleaning">
          <label for="deep-cleaning" class="radio-label"></label>
        <div class="cleaning-title">Deep Cleaning &ndash; 6 Cleaners</div>
          <div class="cleaning-price">₱20,000</div>
          <div class="cleaning-inclusions-title">Inclusions:</div>
          <ul class="cleaning-inclusions">
            <li>All Standard tasks</li>
            <li>Tile scrubbing & grout cleaning</li>
            <li>Behind appliances/furniture</li>
            <li>Carpet shampoo</li>
            <li>Full disinfection</li>
          </ul>
        </div>
      </div>
      <div class="cleaning-note">Cleaning materials are provided by the client</div>
      <nav class="pagination">
        <ul>
            <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
      </nav>
    </div>
  </main>
  <!-- FOOTER -->
  <?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
</body>
</html>


