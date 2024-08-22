<footer class="footer bg-light d-flex justify-content-around">
    <a href="{{ route('dashboard') }}" class="footer-link col-4 d-flex justify-content-center align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}" id="dashboard">
        <i class="bi bi-house-door"></i>
        <div class="mt-1 ml-2">Dashboard</div>
    </a>
    <a href="{{ route('report') }}" class="footer-link col-4 d-flex justify-content-center align-items-center {{ request()->routeIs('report') ? 'active' : '' }}" id="report">
        <i class="bi bi-clipboard"></i>
        <div class="mt-1 ml-2">Report</div>
    </a>
    <a href="{{ route('factories.index') }}" class="footer-link col-4 d-flex justify-content-center align-items-center {{ request()->routeIs(['factories.*', 'sites.*', 'sensors.*']) ? 'active' : '' }}" id="company">
        <i class="bi bi-phone"></i>
        <div class="mt-1 ml-2">Factory</div>
    </a>
</footer>
