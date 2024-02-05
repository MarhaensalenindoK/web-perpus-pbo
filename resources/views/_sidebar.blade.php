<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perpustakaan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(View::yieldContent('page-name') == 'dashboard') active @endif">
        <a href="dashboard" class="nav-link" href="index.html">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <li class="nav-item @if(View::yieldContent('page-name') == 'book') active @endif">
        <a class="nav-link" href="books">
            <i class="fas fa-book-open"></i>
            <span>Buku</span>
        </a>
    </li>

    <li class="nav-item @if(View::yieldContent('page-name') == 'author') active @endif">
        <a class="nav-link" href="authors">
            <i class="fas fa-pen"></i>
            <span>Pengarang</span>
        </a>
    </li>

    <li class="nav-item @if(View::yieldContent('page-name') == 'member') active @endif">
        <a class="nav-link" href="members">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Anggota</span>
        </a>
    </li>

    <li class="nav-item @if(View::yieldContent('page-name') == 'loan') active @endif">
        <a class="nav-link" href="loans">
            <i class="fas fa-hand-holding"></i>
            <span>Peminjaman</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
