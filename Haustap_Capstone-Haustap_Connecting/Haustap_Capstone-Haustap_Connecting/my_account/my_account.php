<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account</title>
  <link rel="stylesheet" href="/css/global.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/my_account/css/my_account.css" />
  <link rel="stylesheet" href="/client/css/homepage.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <!-- HEADER -->
<?php include dirname(__DIR__) . "/client/includes/header.php"; ?>

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
</nav>
    </aside>

    <!-- RIGHT MAIN CONTENT -->
    <section class="profile-section">
      <div class="profile-box">
        <h2 class="profile-header">Profile</h2>

        <div class="profile-content">
          <div class="profile-info">
            <div class="info-row">
              <label>Name:</label>
              <input type="text" id="name" placeholder="">
            </div>

            <div class="info-row">
              <label>Email:</label>
              <span>jen********@gmail.com <a href="#">Change</a></span>
            </div>

            <div class="info-row">
              <label>Phone Number:</label>
              <span>********89 <a href="#">Change</a></span>
            </div>

            <div class="info-row">
              <label>Gender:</label>
              <span>
                <label><input type="radio" name="gender"> Male</label>
                <label><input type="radio" name="gender"> Female</label>
              </span>
            </div>

            <div class="info-row">
              <label>Date of Birth:</label>
              <span><a href="#">Add</a></span>
            </div>

            <div class="btn-group">
              <button class="change-password">Change Password</button>
              <button class="save-btn">Save</button>
            </div>
          </div>

          <div class="profile-image">
            <i class="fa-solid fa-user fa-4x"></i>
            <button class="select-image">Select Image</button>
            <p class="file-note">File size: maximum 1MB<br>File extension: JPEG, PNG</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

   <!-- FOOTER -->
<?php include dirname(__DIR__) . "/client/includes/footer.php"; ?>
  <script>
    (function() {
      // Read user from localStorage (set during sign-up or login)
      let user = null;
      try { user = JSON.parse(localStorage.getItem('haustap_user') || 'null'); } catch {}

      const setRowValue = (labelText, value, withChangeLink = true) => {
        const rows = document.querySelectorAll('.info-row');
        for (const row of rows) {
          const label = row.querySelector('label');
          if (!label) continue;
          if ((label.textContent || '').trim().toLowerCase() === labelText.toLowerCase()) {
            let target = row.querySelector('span');
            if (!target) {
              target = document.createElement('span');
              row.appendChild(target);
            }
            if (withChangeLink) {
              target.innerHTML = `${value || ''} <a href="#">Change</a>`;
            } else {
              target.textContent = value || '';
            }
            break;
          }
        }
      };

      if (user) {
        // Prefer first+last name if available, else fall back to 'name'
        const combined = `${(user.firstName || '').trim()} ${(user.lastName || '').trim()}`.trim();
        const fullName = combined || (user.name || '');
        const profileNameEl = document.querySelector('.profile-name');
        if (profileNameEl && fullName) profileNameEl.textContent = fullName;

        const nameInput = document.getElementById('name');
        if (nameInput && fullName) nameInput.value = fullName;

        setRowValue('Email:', user.email || '');
        setRowValue('Phone Number:', user.mobile || user.phone || '');

        // Gender radios (optional; set if available)
        if (user.gender) {
          const radios = document.querySelectorAll('input[type="radio"][name="gender"]');
          const g = (user.gender || '').toLowerCase();
          if (radios.length >= 2) {
            if (g === 'male') radios[0].checked = true;
            if (g === 'female') radios[1].checked = true;
          }
        }

        // Date of birth (optional)
        const dob = user.dob || (user.birthMonth && user.birthDay && user.birthYear ? `${user.birthMonth}/${user.birthDay}/${user.birthYear}` : '');
        if (dob) setRowValue('Date of Birth:', dob, false);
      }

      // Save button can update stored name (simple example)
      const saveBtn = document.querySelector('.save-btn');
      if (saveBtn) {
        saveBtn.addEventListener('click', function() {
          const nameInput = document.getElementById('name');
          if (!nameInput) return;
          const updatedName = nameInput.value.trim();
          if (!user) user = {};
          user.name = updatedName;
          try { localStorage.setItem('haustap_user', JSON.stringify(user)); } catch {}
          alert('Profile saved locally.');
        });
      }

      // Log out clears local data and navigates to login
      const logoutBtn = document.querySelector('.logout-btn');
      if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
          localStorage.removeItem('haustap_token');
          localStorage.removeItem('haustap_user');
          window.location.href = '/login';
        });
      }
    })();
  </script>
</body>
</html>