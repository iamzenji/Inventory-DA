
<div class="sidebar" id="sidebar">
  <div>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('inventory.dashboard') }}">
          <i class="bi bi-box"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('inventory.product') }}">
            <i class="bi-box-seam"></i> <span>Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#"><i class="bi-person-gear"></i> <span>Account Management</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi-boxes"></i> <span>Supplies</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi-tags"></i> <span>Organization $ Label</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi-gear"></i> <span>Settings</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="#"></i> <span>Log out</span></a>
      </li>
    </ul>
  </div>
</div>

<script>
  const sidebar = document.getElementById("sidebar");

  function toggleSidebar() {
    if (window.innerWidth < 768) {
      sidebar.classList.toggle("show");
    } else {
      sidebar.classList.toggle("collapsed");
      document.body.classList.toggle("sidebar-collapsed");
    }
  }

  // Auto-collapse on resize
  window.addEventListener("resize", () => {
    if (window.innerWidth < 768) {
      sidebar.classList.remove("collapsed");
      document.body.classList.remove("sidebar-collapsed");
    }
  });
</script>

