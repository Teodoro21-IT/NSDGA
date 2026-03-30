<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Documents – NSDGA Marikina</title>
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
      color: #fff; font-size: 0.72rem; font-weight: 900; line-height: 1.45;
      text-align: center; letter-spacing: 0.04em; text-transform: uppercase;
    }
    .sidebar-brand-sub {
      color: rgba(255,255,255,0.55); font-size: 0.62rem; text-align: center;
      letter-spacing: 0.08em; text-transform: uppercase; margin-top: -4px;
    }
    .sidebar-nav { padding: 18px 0; flex: 1; }
    .sidebar-nav a {
      display: flex; align-items: center; gap: 10px; padding: 10px 18px;
      color: rgba(255,255,255,0.72); font-size: 0.82rem; font-weight: 400;
      text-decoration: none; transition: background 0.18s, color 0.18s;
      border-left: 3px solid transparent;
    }
    .sidebar-nav a:hover { background: rgba(255,255,255,0.08); color: #fff; }
    .sidebar-nav a.active {
      color: #fff; font-weight: 700; border-left: 3px solid #fff;
      background: rgba(255,255,255,0.12);
    }
    .sidebar-nav a svg { width: 15px; height: 15px; flex-shrink: 0; opacity: 0.8; }
    .sidebar-nav a.active svg { opacity: 1; }
    .sidebar-footer { padding: 14px 18px 20px; border-top: 1px solid rgba(255,255,255,0.12); }
    .sidebar-footer a {
      display: flex; align-items: center; gap: 10px;
      color: rgba(255,255,255,0.65); font-size: 0.82rem; text-decoration: none; transition: color 0.18s;
    }
    .sidebar-footer a:hover { color: #fff; }
    .sidebar-footer a svg { width: 15px; height: 15px; }

    /* ── MAIN ── */
    .main { margin-left: 178px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; background: #f4f4f4; }

    /* ── TOP BAR ── */
    .topbar {
      background: #fff; border-bottom: 1px solid #e8e8e8;
      padding: 0 32px; height: 54px;
      display: flex; align-items: center; flex-shrink: 0;
    }
    .topbar-spacer { flex: 1; }
    .topbar-user { display: flex; align-items: center; gap: 10px; }
    .topbar-user-info { text-align: right; }
    .topbar-user-name { font-size: 0.82rem; font-weight: 700; color: #111; }
    .topbar-user-lrn  { font-size: 0.7rem; color: #888; }
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
      font-size: 0.8rem; color: #444; text-decoration: none; transition: background 0.15s; border-left: none;
    }
    .avatar-dropdown a:hover { background: #f8f8f8; color: #7a0000; }
    .avatar-dropdown a svg { width: 14px; height: 14px; flex-shrink: 0; }
    .avatar-dropdown-divider { height: 1px; background: #f0f0f0; margin: 2px 0; }
    .avatar-dropdown a.logout { color: #c0392b; }
    .avatar-dropdown a.logout:hover { background: #fff5f5; }

    /* ── CONTENT ── */
    .content { padding: 32px 36px 48px; flex: 1; }

    .page-title { font-size: 1.3rem; font-weight: 900; color: #111; margin-bottom: 6px; }
    .page-sub   { font-size: 0.8rem; color: #777; margin-bottom: 24px; line-height: 1.5; }

    /* ── DOCUMENTS TABLE ── */
    .doc-table-card {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 8px;
      overflow: hidden; margin-bottom: 24px;
    }
    .doc-table {
      width: 100%; border-collapse: collapse;
    }
    .doc-table thead tr {
      border-bottom: 1px solid #efefef;
    }
    .doc-table thead th {
      padding: 13px 20px; text-align: left;
      font-size: 0.67rem; font-weight: 900; letter-spacing: 0.1em;
      text-transform: uppercase; color: #aaa;
    }
    .doc-table tbody tr {
      border-bottom: 1px solid #f5f5f5;
      transition: background 0.15s;
    }
    .doc-table tbody tr:last-child { border-bottom: none; }
    .doc-table tbody tr:hover { background: #fafafa; }
    .doc-table td { padding: 16px 20px; vertical-align: middle; }

    /* doc name cell */
    .doc-name-cell { display: flex; align-items: center; gap: 12px; }
    .doc-icon {
      width: 32px; height: 32px; border: 1px solid #e5e5e5; border-radius: 5px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
      background: #fafafa;
    }
    .doc-icon svg { width: 15px; height: 15px; color: #aaa; }
    .doc-name-text { font-size: 0.84rem; font-weight: 600; color: #111; }

    /* status badges */
    .badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 10px; border-radius: 20px;
      font-size: 0.72rem; font-weight: 700; white-space: nowrap;
    }
    .badge-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .badge.verified    { background: #eafaf1; color: #1e8449; }
    .badge.verified .badge-dot    { background: #27ae60; }
    .badge.review      { background: #eaf3fb; color: #1a6fa8; }
    .badge.review .badge-dot      { background: #2e86c1; }
    .badge.not-uploaded { background: #f5f5f5; color: #888; }
    .badge.not-uploaded .badge-dot { background: #bbb; }
    .badge.action      { background: #fef9e7; color: #b7770d; }
    .badge.action .badge-triangle {
      width: 0; height: 0;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      border-bottom: 7px solid #f39c12;
      flex-shrink: 0;
    }

    .last-updated { font-size: 0.8rem; color: #666; }

    /* action buttons */
    .btn-update {
      background: none; border: none; font-size: 0.8rem; font-weight: 700;
      font-family: 'Lato', sans-serif; color: #7a0000; cursor: pointer;
      transition: opacity 0.15s; padding: 0;
    }
    .btn-update:hover { opacity: 0.7; }
    .btn-upload {
      padding: 7px 16px; background: #7a0000; border: none; border-radius: 5px;
      font-size: 0.76rem; font-weight: 700; font-family: 'Lato', sans-serif;
      color: #fff; cursor: pointer; transition: background 0.18s;
    }
    .btn-upload:hover { background: #9a0000; }
    .btn-upload-new {
      padding: 7px 14px; background: #e67e22; border: none; border-radius: 5px;
      font-size: 0.76rem; font-weight: 700; font-family: 'Lato', sans-serif;
      color: #fff; cursor: pointer; transition: background 0.18s;
    }
    .btn-upload-new:hover { background: #ca6f1e; }

    /* ── BOTTOM CARDS ── */
    .bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .info-card {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; padding: 22px 24px;
    }
    .info-card-title {
      display: flex; align-items: center; gap: 8px;
      font-size: 0.88rem; font-weight: 900; margin-bottom: 14px;
    }
    .info-card-title svg { width: 16px; height: 16px; flex-shrink: 0; }
    .info-card-title.red { color: #c0392b; }
    .info-card-title.gray { color: #555; }

    .guidelines-list { display: flex; flex-direction: column; gap: 9px; }
    .guidelines-list p { font-size: 0.79rem; color: #555; line-height: 1.5; }

    .help-text { font-size: 0.79rem; color: #555; line-height: 1.55; margin-bottom: 16px; }
    .help-contact { display: flex; flex-direction: column; gap: 8px; }
    .help-contact-item {
      display: flex; align-items: center; gap: 8px;
      font-size: 0.79rem; color: #444;
    }
    .help-contact-item svg { width: 14px; height: 14px; color: #888; flex-shrink: 0; }

    .page-footer { text-align: center; font-size: 0.72rem; color: #bbb; margin-top: 28px; }

    @media (max-width: 700px) {
      .sidebar { display: none; }
      .main { margin-left: 0; }
      .bottom-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <img class="sidebar-avatar"
      src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
      alt="NSDGA Logo"/>
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
    <a href="mydocuments.php" class="active">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
      </svg>My Documents
    </a>
    <a href="notif.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
      </svg>Notifications
    </a>
    <a href="myprofile.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>My Profile
    </a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php">
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
    <div class="topbar-spacer"></div>
    <div class="topbar-user">
      <div class="topbar-user-info">
        <div class="topbar-user-name">Nailong A. Bcdeghi</div>
        <div class="topbar-user-lrn">LRN: 136676090147</div>
      </div>
      <div class="avatar-wrap">
        <img class="topbar-user-avatar"
          src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
          alt="Avatar" onclick="toggleDropdown()"/>
        <div class="avatar-dropdown" id="avatarDropdown">
          <div class="avatar-dropdown-header">
            <div class="avatar-dropdown-name">Nailong A. Bcdeghi</div>
            <div class="avatar-dropdown-lrn">LRN: 136676090147</div>
          </div>
          
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <div class="page-title">My Documents</div>
    <div class="page-sub">Please upload clear scanned copies of the required documents for verification. Ensure files are in PDF or JPEG format.</div>

    <!-- DOCUMENTS TABLE -->
    <div class="doc-table-card">
      <table class="doc-table">
        <thead>
          <tr>
            <th>Document Name</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <!-- 2x2 Picture — Verified -->
          <tr>
            <td>
              <div class="doc-name-cell">
                <div class="doc-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                  </svg>
                </div>
                <span class="doc-name-text">2x2 Picture</span>
              </div>
            </td>
            <td><span class="badge verified"><span class="badge-dot"></span>Verified</span></td>
            <td><span class="last-updated">Oct 12, 2023</span></td>
            <td><button class="btn-update">Update</button></td>
          </tr>

          <!-- Report Card — Under Review -->
          <tr>
            <td>
              <div class="doc-name-cell">
                <div class="doc-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                  </svg>
                </div>
                <span class="doc-name-text">Report Card (Form 138)</span>
              </div>
            </td>
            <td><span class="badge review"><span class="badge-dot"></span>Under Review</span></td>
            <td><span class="last-updated">Jan 15, 2024</span></td>
            <td><button class="btn-update">Update</button></td>
          </tr>

          <!-- Form 137 — Not Uploaded -->
          <tr>
            <td>
              <div class="doc-name-cell">
                <div class="doc-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="12" y1="17" x2="8" y2="17"/>
                  </svg>
                </div>
                <span class="doc-name-text">Form 137</span>
              </div>
            </td>
            <td><span class="badge not-uploaded"><span class="badge-dot"></span>Not Uploaded</span></td>
            <td><span class="last-updated">—</span></td>
            <td><button class="btn-upload">Upload</button></td>
          </tr>

          <!-- PSA Birth Certificate — Verified -->
          <tr>
            <td>
              <div class="doc-name-cell">
                <div class="doc-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 8h10M7 12h6"/>
                  </svg>
                </div>
                <span class="doc-name-text">PSA Birth Certificate</span>
              </div>
            </td>
            <td><span class="badge verified"><span class="badge-dot"></span>Verified</span></td>
            <td><span class="last-updated">Oct 12, 2023</span></td>
            <td><button class="btn-update">Update</button></td>
          </tr>

          <!-- Good Moral Certificate — Action Needed -->
          <tr>
            <td>
              <div class="doc-name-cell">
                <div class="doc-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                </div>
                <span class="doc-name-text">Good Moral Certificate</span>
              </div>
            </td>
            <td>
              <span class="badge action">
                <span class="badge-triangle"></span>Action Needed
              </span>
            </td>
            <td><span class="last-updated">Feb 01, 2024</span></td>
            <td><button class="btn-upload-new">Upload New</button></td>
          </tr>

        </tbody>
      </table>
    </div>

    <!-- BOTTOM INFO CARDS -->
    <div class="bottom-grid">

      <!-- Submission Guidelines -->
      <div class="info-card">
        <div class="info-card-title red">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          Submission Guidelines
        </div>
        <div class="guidelines-list">
          <p>All scanned documents must be legible and in high resolution.</p>
          <p>Maximum file size for each document is 5MB.</p>
          <p>The Registrar's Office typically reviews documents within 3-5 working days.</p>
          <p>Ensure that PSA Birth Certificates show the registry number clearly.</p>
        </div>
      </div>

      <!-- Need Help -->
      <div class="info-card">
        <div class="info-card-title gray">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
          Need Help?
        </div>
        <p class="help-text">If you are experiencing issues with uploading your documents or have questions about the requirements, please contact the Registrar's Office.</p>
        <div class="help-contact">
          <div class="help-contact-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
            registrar@nsdga.edu.ph
          </div>
          <div class="help-contact-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.18 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
            </svg>
            +63 (2) 8123-4567
          </div>
        </div>
      </div>

    </div>

    <div class="page-footer">&copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>

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