<aside class="sidebar">
    {{-- Header --}}
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/nsgam-logo.png') }}" alt="NSGAM Logo" class="logo-img"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
           <img 
            src="{{ asset('images/logo.png') }}" 
            alt="NSDGA Logo" 
            class="mb-4 h-32 w-32 object-contain drop-shadow-md"
        >
        </div>
        <div class="sidebar-school-info">
            <p class="school-name">Nuestra Señora de Guia<br>Academy of Marikina</p>
            <p class="school-sub">Admin Access</p>
        </div>
    </div>

    {{-- Dashboard --}}
    <nav class="sidebar-nav">
        {{-- Dashboard --}}
        <a href="{{ route('admin_dashboard') }}" 
           class="nav-item {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
            Dashboard
        </a>

        {{-- Manage Accounts --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">           
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
            Manage Accounts
        </a>

        {{-- Student Records --}}
        <a href="{{ route('admin.students') }}" 
           class="nav-item {{ request()->routeIs('admin.students') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-closed"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/><path d="M2 10h20"/></svg>
            Student Records
        </a>

        {{-- Content Management --}}
        <a href="{{ route('admin.events.create') }}" class="nav-item {{ request()->routeIs('admin.events.create') ? 'active' : '' }}">
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="m16 19 2 2 4-4"/></svg>
           Content Management
        </a>

        {{--System Settings --}}
        <a href="{{ route('password.show') }}" class="nav-item {{ request()->routeIs('password.show') ? 'active' : '' }}">
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
           System Settings
        </a>

        
    </nav>

    {{-- Logout --}}
   <div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
            {{-- Professional Log Out Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <span>Logout</span>
        </button>
    </form>
</div>
</aside>

<style>
.sidebar {
    width: 280px;
    min-height: 100vh;
    background-color: #f8f9fa; /* Matches Figma light gray */
    border-right: 1px solid #eee;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
}

.sidebar-header {
    padding: 30px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.sidebar-logo {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.logo-img {
    width: 90%;
    height: 90%;
    object-fit: contain;
}

.school-name {
    font-size: 11px;
    font-weight: 800;
    color: #800000;
    text-transform: uppercase;
    line-height: 1.2;
    margin: 0;
}

.school-sub {
    font-size: 10px;
    color: #999;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-top: 2px;
}

.sidebar-nav {
    flex: 1;
    padding: 10px 16px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #555;
    text-decoration: none;
    transition: all 0.2s ease;
}

.nav-item:hover {
    background-color: # ;
    color: #222;
}

.nav-icon {
    font-size: 18px;
    width: 24px;
    display: flex;
    justify-content: center;
}

.nav-item.active {
    background-color: white;
    color: #800000;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.sidebar-footer {
    padding: 24px 16px;
}

.logout-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px;
    border-radius: 12px;
    background-color: #e9ecef;
    border: none;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    cursor: pointer;
    transition: background 0.2s;
}

.logout-btn:hover {
    background-color: #dee2e6;
    color: #333;
}
</style>