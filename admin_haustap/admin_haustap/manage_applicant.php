<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Manage Applicants</title>
  <link rel="stylesheet" href="css/manage_applicant.css" />
<script src="js/lazy-images.js" defer></script>
<script src="js/app.js" defer></script>
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <?php $active = 'applicants'; include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Topbar -->
      <header class="topbar">
        <div class="user">
          <button class="notif-btn">🔔</button>
          <div class="user-menu">
            <button id="userDropdownBtn" class="user-dropdown-btn">Mj Punzalan ▼</button>
            <div class="user-dropdown" id="userDropdown">
              <a href="#">View Profile</a>
              <a href="#">Change Password</a>
              <a href="#">Activity Logs</a>
              <a href="#" class="logout">Log out</a>
            </div>
          </div>
        </div>
      </header>

      <!-- Header -->
      <div class="page-header">
        <h3>Manage of Applicants</h3>
      </div>

      <!-- Applicant Tabs -->
      <div class="tabs">
        <button class="tab active">All</button>
        <button class="tab">Pending Review</button>
        <button class="tab">Scheduled</button>
        <button class="tab">Hired</button>
        <button class="tab">Rejected</button>
      </div>

      <!-- Table Section -->
      <div class="table-container">
        <div class="table-header">
          <input id="searchInput" type="text" placeholder="Search Applicant" class="search-bar" />
          <div class="filter-control">
            <button id="statusFilterBtn" class="filter-btn" type="button" aria-haspopup="true" aria-expanded="false">⚙️ Filter</button>
            <div id="statusFilterMenu" class="filter-dropdown" role="menu" aria-hidden="true">
              <button type="button" data-status="hired">Hired</button>
              <button type="button" data-status="pending_review">Pending Review</button>
              <button type="button" data-status="scheduled">Scheduled</button>
              <button type="button" data-status="rejected">Rejected</button>
            </div>
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Date Applied</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="applicantTableBody">
            <!-- Rows injected by JS -->
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
          <span id="prevPage" style="cursor:pointer">◀ Prev</span>
          <span id="paginationInfo">&nbsp;</span>
          <span id="nextPage" style="cursor:pointer">Next ▶</span>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Dropdown logic
    const dropdownBtn = document.getElementById("userDropdownBtn");
    const dropdown = document.getElementById("userDropdown");

    dropdownBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      dropdown.classList.toggle("show");
    });

    window.addEventListener("click", (e) => {
      if (!dropdown.contains(e.target)) dropdown.classList.remove("show");
    });

    // Tabs (highlight only; data loading handled in app.js)
    const tabs = document.querySelectorAll(".tab");
    tabs.forEach(tab => {
      tab.addEventListener("click", () => {
        tabs.forEach(t => t.classList.remove("active"));
        tab.classList.add("active");
      });
    });
  </script>
</body>
</html>


