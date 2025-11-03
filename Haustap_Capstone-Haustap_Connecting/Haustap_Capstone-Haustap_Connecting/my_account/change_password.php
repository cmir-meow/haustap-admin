<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Change Password</title>
  <link rel="stylesheet" href="../client/css/homepage.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/change_password.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <?php include __DIR__ . '/../client/includes/header.php'; ?>


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
      <li><a href="#" class="active">Profile</a></li>
      <li><a href="#">Addresses</a></li>
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
</aside>

<div class="change-password-page">
  <div class="change-password-box">
    <div class="change-password-header">
      <button class="back-btn"><i class="fas fa-arrow-left"></i></button>
      <h2>Change Password</h2>
    </div>

    <form class="password-form" method="POST" action="#">
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" name="current_password" placeholder="Enter current password">
      </div>

      <div class="form-group password-toggle">
        <label for="new-password">New Password</label>
        <div class="input-wrapper">
          <input type="password" id="new-password" name="new_password" placeholder="Enter new password">
          <i class="fas fa-eye toggle-icon"></i>
        </div>
      </div>

      <div class="form-group password-toggle">
        <label for="confirm-password">Confirm New Password</label>
        <div class="input-wrapper">
          <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter new password">
          <i class="fas fa-eye toggle-icon"></i>
        </div>
      </div>

      <button type="submit" class="submit-btn">Save</button>
    </form>
  </div>
  </div>
</main>
<!-- FOOTER -->
  <?php include __DIR__ . '/../client/includes/footer.php'; ?>
  
</body>
</html>