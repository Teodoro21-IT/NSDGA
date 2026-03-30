<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Notifications – NSDGA Marikina</title>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;600;700&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Lato', sans-serif; background: #f0f0f0; min-height: 100vh; display: flex; }

    /* ── SIDEBAR ── */
    .sidebar {
      width: 178px; min-width: 178px; background: #7a0000;
      min-height: 100vh; display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; z-index: 10;
    }
    .sidebar-brand {
      padding: 22px 16px 18px; display: flex; flex-direction: column;
      align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,0.15);
    }
    .sidebar-avatar {
      width: 54px; height: 54px; border-radius: 50%;
      border: 2px solid rgba(255,255,255,0.35); object-fit: cover; flex-shrink: 0;
    }
    .sidebar-brand-name {
      color: #fff; font-family: 'Lato', sans-serif; font-size: 0.72rem; font-weight: 900;
      line-height: 1.45; text-align: center; letter-spacing: 0.04em; text-transform: uppercase;
    }
    .sidebar-brand-sub {
      color: rgba(255,255,255,0.55); font-size: 0.62rem; font-weight: 400;
      text-align: center; letter-spacing: 0.08em; text-transform: uppercase; margin-top: -4px;
    }
    .sidebar-nav { padding: 18px 0; flex: 1; }
    .sidebar-nav a {
      display: flex; align-items: center; gap: 10px; padding: 10px 18px;
      color: rgba(255,255,255,0.72); font-size: 0.82rem; font-weight: 400;
      text-decoration: none; letter-spacing: 0.01em;
      transition: background 0.18s, color 0.18s; border-left: 3px solid transparent;
    }
    .sidebar-nav a:hover { background: rgba(255,255,255,0.08); color: #fff; }
    .sidebar-nav a.active {
      color: #fff; font-weight: 700; border-left: 3px solid #fff; background: rgba(255,255,255,0.12);
    }
    .sidebar-nav a svg { width: 15px; height: 15px; flex-shrink: 0; opacity: 0.8; }
    .sidebar-nav a.active svg { opacity: 1; }
    .notif-badge {
      margin-left: auto; background: #c0392b; color: #fff;
      font-size: 0.65rem; font-weight: 900; border-radius: 50%;
      width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;
    }
    .sidebar-footer { padding: 14px 18px 20px; border-top: 1px solid rgba(255,255,255,0.12); }
    .sidebar-footer a {
      display: flex; align-items: center; gap: 10px;
      color: rgba(255,255,255,0.65); font-size: 0.82rem; text-decoration: none; transition: color 0.18s;
    }
    .sidebar-footer a:hover { color: #fff; }
    .sidebar-footer a svg { width: 15px; height: 15px; }

    /* ── MAIN ── */
    .main { margin-left: 178px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── TOP BAR ── */
    .topbar {
      background: #fff; border-bottom: 1px solid #e8e8e8;
      padding: 0 32px; height: 56px;
      display: flex; align-items: center; gap: 16px; flex-shrink: 0;
    }
    .topbar-title { font-size: 1.05rem; font-weight: 900; color: #111; letter-spacing: -0.01em; }
    .topbar-search { flex: 1; max-width: 300px; position: relative; margin-left: 8px; }
    .topbar-search input {
      width: 100%; padding: 7px 12px 7px 34px; border: 1px solid #e0e0e0;
      border-radius: 20px; font-size: 0.8rem; font-family: 'Lato', sans-serif;
      color: #333; background: #f8f8f8; outline: none; transition: border-color 0.2s;
    }
    .topbar-search input:focus { border-color: #7a0000; background: #fff; }
    .topbar-search input::placeholder { color: #bbb; }
    .topbar-search svg {
      position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
      width: 13px; height: 13px; color: #aaa;
    }
    .topbar-spacer { flex: 1; }
    .topbar-user { display: flex; align-items: center; gap: 10px; }
    .topbar-user-info { text-align: right; }
    .topbar-user-name { font-size: 0.82rem; font-weight: 700; color: #111; }
    .topbar-user-lrn  { font-size: 0.7rem; color: #888; }

    /* ── AVATAR DROPDOWN ── */
    .avatar-wrap { position: relative; }
    .topbar-user-avatar {
      width: 34px; height: 34px; border-radius: 50%; object-fit: cover;
      border: 2px solid #e0e0e0; cursor: pointer;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .topbar-user-avatar:hover { border-color: #7a0000; box-shadow: 0 0 0 3px rgba(122,0,0,0.12); }
    .avatar-dropdown {
      display: none; position: absolute; top: calc(100% + 10px); right: 0;
      background: #fff; border: 1px solid #e5e5e5; border-radius: 8px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.10); min-width: 170px; z-index: 100; overflow: hidden;
    }
    .avatar-dropdown.open { display: block; }
    .avatar-dropdown-header { padding: 13px 16px 10px; border-bottom: 1px solid #f0f0f0; }
    .avatar-dropdown-name { font-size: 0.82rem; font-weight: 700; color: #111; }
    .avatar-dropdown-lrn  { font-size: 0.7rem; color: #aaa; margin-top: 2px; }
    .avatar-dropdown a {
      display: flex; align-items: center; gap: 9px; padding: 10px 16px;
      font-size: 0.8rem; color: #444; text-decoration: none; transition: background 0.15s;
      border-left: none;
    }
    .avatar-dropdown a:hover { background: #f8f8f8; color: #7a0000; }
    .avatar-dropdown a svg { width: 14px; height: 14px; flex-shrink: 0; }
    .avatar-dropdown-divider { height: 1px; background: #f0f0f0; margin: 2px 0; }
    .avatar-dropdown a.logout { color: #c0392b; }
    .avatar-dropdown a.logout:hover { background: #fff5f5; }

    /* ── CONTENT ── */
    .content { padding: 30px 36px 40px; flex: 1; display: flex; flex-direction: column; }

    .inbox-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
    .inbox-header h2 { font-size: 1.15rem; font-weight: 900; color: #111; margin-bottom: 3px; }
    .inbox-header p  { font-size: 0.8rem; color: #666; }
    .mark-all-btn {
      background: none; border: none; font-size: 0.82rem; font-family: 'Lato', sans-serif;
      font-weight: 700; color: #7a0000; cursor: pointer; transition: opacity 0.15s;
    }
    .mark-all-btn:hover { opacity: 0.7; }

    .date-label {
      font-size: 0.68rem; font-weight: 900; letter-spacing: 0.1em;
      text-transform: uppercase; color: #aaa; margin-bottom: 8px;
    }
    .notif-card { background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; margin-bottom: 24px; overflow: hidden; }
    .notif-item {
      display: flex; align-items: flex-start; gap: 14px; padding: 18px 22px;
      border-bottom: 1px solid #f2f2f2; transition: background 0.15s;
    }
    .notif-item:last-child { border-bottom: none; }
    .notif-item:hover { background: #fafafa; }
    .notif-radio {
      width: 16px; height: 16px; border: 2px solid #ccc; border-radius: 50%;
      flex-shrink: 0; margin-top: 3px; cursor: pointer; transition: border-color 0.15s;
    }
    .notif-radio:hover { border-color: #7a0000; }
    .notif-body { flex: 1; }
    .notif-meta { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 5px; }
    .notif-title { font-size: 0.85rem; font-weight: 700; color: #111; line-height: 1.4; }
    .notif-ts { font-size: 0.7rem; color: #aaa; white-space: nowrap; flex-shrink: 0; margin-top: 2px; }
    .notif-desc { font-size: 0.8rem; color: #555; line-height: 1.55; }
    .notif-card-empty {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 8px;
      height: 110px; margin-bottom: 28px;
    }
    .load-more-wrap { display: flex; justify-content: center; margin-bottom: 24px; }
    .load-more-btn {
      padding: 9px 28px; background: #fff; border: 1px solid #ddd; border-radius: 20px;
      font-size: 0.82rem; font-family: 'Lato', sans-serif; color: #444; cursor: pointer;
      transition: background 0.15s, border-color 0.15s;
    }
    .load-more-btn:hover { background: #f5f5f5; border-color: #bbb; }
    .page-footer { text-align: center; font-size: 0.74rem; color: #bbb; padding-bottom: 8px; }

    @media (max-width: 700px) {
      .sidebar { display: none; }
      .main { margin-left: 0; }
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
      alt="NSDGA Logo" class="sidebar-avatar"/>
    <div class="sidebar-brand-name">Nuestra Señora De Guia<br>Academy of Marikina</div>
    <div class="sidebar-brand-sub">Student Portal</div>
  </div>
  <nav class="sidebar-nav">
    <a href="applicationstatus.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
      </svg>Application Status
    </a>
    <a href="enrollmentform.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
      </svg>Enrollment Form
    </a>
    <a href="mydocuments.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
      </svg>My Documents
    </a>
    <a href="notif.php" class="active">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
      </svg>Notifications
      <span class="notif-badge">9</span>
      <a href="myprofile.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
      </svg>My Profile
    </a>
    </a>
  </nav>
  <div class="sidebar-footer">
    <a href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
      </svg>Logout
    </a>
  </div>
</aside>

<!-- MAIN -->
<main class="main">

  <!-- TOP BAR -->
  <div class="topbar">
    <div class="topbar-title">Notifications</div>
    <div class="topbar-search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <input type="text" placeholder="Search notifications..."/>
    </div>
    <div class="topbar-spacer"></div>
    <div class="topbar-user">
      <div class="topbar-user-info">
        <div class="topbar-user-name">Nailong A. Bcdeghi</div>
        <div class="topbar-user-lrn">LRN: 136676090147</div>
      </div>
      <div class="avatar-wrap">
        <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
          alt="Avatar" class="topbar-user-avatar" onclick="toggleDropdown()"/>
        <div class="avatar-dropdown" id="avatarDropdown">
          <div class="avatar-dropdown-header">
            <div class="avatar-dropdown-name">Nailong A. Bcdeghi</div>
            <div class="avatar-dropdown-lrn">LRN: 136676090147</div>
          </div>
          <a href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>My Profile
          </a>
          <a href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
            </svg>Settings
          </a>
          
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <div class="inbox-header">
      <div>
        <h2>Inbox</h2>
        <p>You have 2 new actions required</p>
      </div>
      <button class="mark-all-btn">Mark all as read</button>
    </div>

    <div class="date-label">Today</div>
    <div class="notif-card">
      <div class="notif-item">
        <div class="notif-radio"></div>
        <div class="notif-body">
          <div class="notif-meta">
            <div class="notif-title">Action Needed: Please resubmit a clear copy of your Report Card</div>
            <div class="notif-ts">2 hours ago</div>
          </div>
          <div class="notif-desc">The previous upload was blurry and unreadable. Please ensure all details are visible before uploading to avoid further delays in your processing.</div>
        </div>
      </div>
      <div class="notif-item">
        <div class="notif-radio"></div>
        <div class="notif-body">
          <div class="notif-meta">
            <div class="notif-title">Enrollment Status: Your enrollment application is currently being reviewed</div>
            <div class="notif-ts">5 hours ago</div>
          </div>
          <div class="notif-desc">Your application for the Academic Year 2024-2025 has been successfully received and is now in the verification queue. Expect an update within 3-5 working days.</div>
        </div>
      </div>
    </div>

    <div class="date-label">Yesterday</div>
    <div class="notif-card-empty"></div>

    <div class="load-more-wrap">
      <button class="load-more-btn">Load older notifications</button>
    </div>

    <div class="page-footer">
      &copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.
    </div>

  </div>
</main>

<script>
  function toggleDropdown() {
    document.getElementById('avatarDropdown').classList.toggle('open');
  }
  document.addEventListener('click', function(e) {
    const wrap = document.querySelector('.avatar-wrap');
    if (wrap && !wrap.contains(e.target)) {
      document.getElementById('avatarDropdown').classList.remove('open');
    }
  });
</script>

</body>
</html>