
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
        <a class="nav-link active" href="{{ route('inventory.account') }}">
        <i class="bi-person-gear"></i> <span>Account Management</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('inventory.supplier') }}">
        <i class="bi-boxes"></i> <span>Supplier</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi-tags"></i> <span>Organization $ Label</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" id="settings-toggle">
        <i class="bi-gear"></i> <span>Settings</span>
        </a>
        <ul class="nav-dropdown" id="settings-dropdown" style="display: none;">
        <li><a class="nav-link" href="{{ route('inventory.product-names') }}">Add Product</a></li>
        <li><a class="nav-link" href="{{ route('inventory.brand') }}">Add Brand</a></li>
        <li><a class="nav-link" href="#">None</a></li>
        </ul>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#"><i class="#"></i> <span>Log out</span></a>
    </li> --}}
    </ul>
</div>
</div>




