{{-- @props([
    "title"=>"Inventory System",
    "bg"=>"bg-primary"
]) --}}

{{-- 
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

        <!-- Hamburger on the left -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Optional site right -->
        <a class="navbar-brand" href="#">Hello</a>

        <div class="offcanvas offcanvas-start text-bg-dark offcanvas-peek" tabindex="-1"id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav> --}}

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  background-color: #0d0c22;
  color: white;
  width: 250px;
  transition: width 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  z-index: 1000;
}

.sidebar.collapsed {
  width: 70px;
}
.sidebar .nav-link {
  color: white;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.sidebar.collapsed .nav-link span {
  display: none;
}
.toggle-btn {
  background: none;
  border: none;
  color: white;
  font-size: 1.5rem;
  margin: 1rem;
  align-self: flex-end;
}
.sidebar-footer {
  text-align: center;
  padding: 1rem;
}
.sidebar-footer img {
border-radius: 50%;
width: 40px;
}
.sidebar-footer p {
  margin: 5px 0 0;
  font-size: 0.8rem;
}
.search-box {
  padding: 0 1rem;
  margin-bottom: 1rem;
}
.search-box input {
  background-color: #1d1b31;
  border: none;
  color: white;
}
.search-box input::placeholder {
  color: #aaa;
}
@media (min-width: 768px) {
  body {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
  }

  body.sidebar-collapsed {
    margin-left: 70px;
  }
}

/* Sidebar collapses by default on small screens */
@media (max-width: 767.98px) {
  .sidebar {
    transform: translateX(-100%);
    position: fixed;
    z-index: 1050;
  }

  .sidebar.show {
    transform: translateX(0);
  }

  body {
    margin-left: 0 !important;
  }
}
</style>

<div class="sidebar" id="sidebar">
  <div>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    {{-- <div class="search-box">
      <input type="text" class="form-control" placeholder="Search...">
    </div> --}}

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-box"></i> <span>Dashboard</span></a>
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

