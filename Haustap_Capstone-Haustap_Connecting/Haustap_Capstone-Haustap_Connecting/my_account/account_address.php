<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Addresses</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link rel="stylesheet" href="../client/css/homepage.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  
  <link rel="stylesheet" href="/my_account/css/account_address.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- HEADER -->
  <?php include __DIR__ . '/../client/includes/header.php'; ?>

  <!-- MAIN CONTENT -->
  <main class="account-page">
    <div class="account-container">
      <!-- LEFT SIDEBAR -->
      <aside class="sidebar">
        <div class="profile-card">
          <div class="profile-header-side">
            <i class="fa-solid fa-user fa-2x"></i>
            <div class="profile-text">
              <p class="profile-name">Jenn Bornilla</p>
              <button class="edit-profile-btn">
                <i class="fa-solid fa-pen"></i> Edit Profile
              </button>
            </div>
          </div>
        </div>

        <nav class="sidebar-nav">
          <div class="sidebar-nav-group">
            <h4><i class="fa-solid fa-user-circle"></i> My Account</h4>
            <ul>
              <li><a href="#">Profile</a></li>
              <li><a href="#" class="active">Addresses</a></li>
              <li><a href="#">Privacy Settings</a></li>
            </ul>
          </div>
          <ul class="sidebar-secondary">
            <li><i class="fa-solid fa-user-group"></i> Referral</li>
            <li><i class="fa-solid fa-ticket"></i> My Vouchers</li>
            <li><i class="fa-solid fa-link"></i> Connect Haustap</li>
            <li><i class="fa-solid fa-file-contract"></i> Terms and Conditions</li>
            <li><i class="fa-solid fa-star"></i> Rate HOMI</li>
            <li><i class="fa-solid fa-circle-info"></i> About us</li>
          </ul>

          <button class="logout-btn">Log out</button>
        </nav>
      </aside>

      <!-- RIGHT SECTION: ADDRESSES -->
      <section class="profile-section">
  <div class="profile-box">
    <div class="address-header">
      <h2 class="profile-header">Addresses</h2>
<button class="add-address-btn"><i class="fa-solid fa-plus"></i> Add New Address</button>
    </div>
    <hr class="divider">

    <!-- Address Card 1 -->
    <div class="address-box">
      <div class="address-info">
        <p class="address-name">Jen Bornilla</p>
        <p class="address-details">
          123 P. Burgos Street, Brgy. San Isidro, Quezon City, Metro Manila
        </p>
      </div>
      <div class="address-actions">
        <div class="action-top">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </div>
          <button class="default-btn">Set as Default</button>
      </div>
    </div>

    <!-- Address Card 2 -->
    <div class="address-box">
      <div class="address-info">
        <p class="address-name">Maria Santos</p>
        <p class="address-details">
          45 Mabini Street, Brgy. Malate, Manila City, Metro Manila
        </p>
      </div>
      <div class="address-actions">
        <div class="action-top">
          <button class="edit-btn">Edit</button>
          <button class="delete-btn">Delete</button>
        </div>
          <button class="default-btn">Set as Default</button>
      </div>
    </div>
  </div>
</section>
    </div>
  </main>

  <!-- FOOTER -->
<?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
</body>
</html>
