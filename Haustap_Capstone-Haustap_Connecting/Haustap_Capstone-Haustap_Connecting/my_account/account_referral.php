<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Referral</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link rel="stylesheet" href="../client/css/homepage.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/my_account/css/account_referral.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <?php include __DIR__ . '/../client/includes/header.php'; ?>
  <main class="account-referral">
  <div class="referral-box">
    <h2>Referral</h2>
    <hr>

    <div class="referral-section">
      <p class="your-code"><strong>Your Code</strong></p>

      <div class="code-box">
        <div class="inner-box">
          <p class="referral-code">6AYI6F</p>
        </div>
        <button class="copy-btn">Copy</button>
      </div>

      <div class="add-code-box">
        <p>Add the referral code you have received from your friend</p>
        <input type="text" placeholder="">
        <button class="submit-btn">Submit</button>
      </div>
    </div>
  </div>
</main> 
<?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
</body>
</html>