<style>
    .sidebar {
        width: 250px;
        transition: width 0.3s ease;
        background-color: #f8f9fa;
        height: 100vh;
        position: fixed;
        z-index: 1030;
        left: 0;
        top: 0;
        bottom: 0;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar.minimized {
        width: 70px;
    }

    .sidebar .nav-link {
        display: flex;
        align-items: center;
        white-space: nowrap;
        padding: 12px 20px;
    }

    .sidebar .nav-link i {
        font-size: 1.2rem;
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .sidebar.minimized .nav-link span {
        display: none;
    }

    .toggle-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        padding: 10px 20px;
        cursor: pointer;
    }

    /* Responsive layout */
    .content-wrapper {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }

    .sidebar.minimized + .content-wrapper {
        margin-left: 70px;
    }
</style>

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
                    <i class="bi bi-box-seam"></i> <span>Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('inventory.account') }}">
                    <i class="bi bi-person-gear"></i> <span>Account Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('inventory.supplier') }}">
                    <i class="bi bi-boxes"></i> <span>Supplier</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-tags"></i> <span>Organization & Label</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="settings-toggle">
                    <i class="bi bi-gear"></i> <span>Settings</span>
                </a>
                <ul class="nav-dropdown" id="settings-dropdown" style="display: none;">
                    <li><a class="nav-link" href="{{ route('inventory.product-names') }}">Add Product</a></li>
                    <li><a class="nav-link" href="{{ route('inventory.brand') }}">Add Brand</a></li>
                    <li><a class="nav-link" href="#">None</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('minimized');
        document.getElementById('main-content').classList.toggle('content-wrapper');
    }

    // Optional: toggle settings dropdown
    document.getElementById('settings-toggle').addEventListener('click', function (e) {
        e.preventDefault();
        const dropdown = document.getElementById('settings-dropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });
</script>
