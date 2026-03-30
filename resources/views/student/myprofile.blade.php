<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile – NSDGA Marikina</title>
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

    /* ── CONTENT ── */
    .content { padding: 32px 36px 48px; flex: 1; }

    /* ── PROFILE HEADER CARD ── */
    .profile-header-card {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 10px;
      padding: 28px 32px; display: flex; align-items: center; gap: 24px;
      margin-bottom: 16px;
    }
    .profile-pic-wrap { position: relative; flex-shrink: 0; }
    .profile-pic {
      width: 80px; height: 80px; border-radius: 50%; object-fit: cover;
      border: 3px solid #e5e5e5;
    }
    .profile-pic-edit {
      position: absolute; bottom: 0; right: 0;
      width: 24px; height: 24px; background: #7a0000; border-radius: 50%;
      display: flex; align-items: center; justify-content: center; cursor: pointer;
      border: 2px solid #fff;
    }
    .profile-pic-edit svg { width: 11px; height: 11px; color: #fff; }
    .profile-info h1 { font-size: 1.35rem; font-weight: 900; color: #111; margin-bottom: 5px; }
    .profile-info p  { font-size: 0.82rem; color: #888; }

    /* ── INFO CARD ── */
    .info-card {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 10px;
      padding: 28px 32px; margin-bottom: 16px;
    }

    /* ── SECTION LABEL ── */
    .section-label {
      text-align: center; font-size: 0.68rem; font-weight: 900;
      letter-spacing: 0.18em; text-transform: uppercase; color: #888;
      margin-bottom: 24px;
    }

    /* ── FORM GRID ── */
    .form-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px;
    }
    .form-grid.full { grid-template-columns: 1fr; }

    .field { display: flex; flex-direction: column; gap: 6px; }
    .field label {
      font-size: 0.65rem; font-weight: 900; letter-spacing: 0.1em;
      text-transform: uppercase; color: #aaa;
    }
    .field input {
      width: 100%; padding: 10px 14px; border: 1px solid #e5e5e5; border-radius: 5px;
      font-size: 0.85rem; font-family: 'Lato', sans-serif; color: #222;
      background: #f8f8f8; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .field input:focus {
      border-color: #7a0000; box-shadow: 0 0 0 3px rgba(122,0,0,0.07);
      background: #fff;
    }
    .field input[readonly] { background: #fff; color: #222; cursor: text; }
    .field input::placeholder { color: #bbb; }

    /* editable fields hint */
    .editable-hint {
      text-align: right; font-size: 0.72rem; color: #aaa;
      margin-bottom: 12px; font-style: italic;
    }

    /* section divider */
    .section-divider { height: 1px; background: #f0f0f0; margin: 24px 0; }

    /* ── SAVE BTN ── */
    .save-row { display: flex; justify-content: flex-end; margin-top: 24px; }
    .btn-save {
      display: flex; align-items: center; gap: 8px;
      padding: 10px 24px; background: #7a0000; border: none; border-radius: 6px;
      font-family: 'Lato', sans-serif; font-size: 0.84rem; font-weight: 700;
      color: #fff; cursor: pointer; transition: background 0.18s;
    }
    .btn-save:hover { background: #9a0000; }
    .btn-save svg { width: 15px; height: 15px; }

    .page-footer { text-align: center; font-size: 0.72rem; color: #bbb; margin-top: 28px; }

    @media (max-width: 700px) {
      .sidebar { display: none; }
      .main { margin-left: 0; }
      .form-grid { grid-template-columns: 1fr; }
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
    <a href="mydocuments.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
      </svg>My Documents
    </a>
    <a href="notif.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
      </svg>Notifications
    </a>
    <a href="myprofile.php" class="active">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>My Profile
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
  <div class="content">

    <!-- PROFILE HEADER -->
    <div class="profile-header-card">
      <div class="profile-pic-wrap" onclick="document.getElementById('pic-input').click()" title="Change photo" style="cursor:pointer;">
        <img class="profile-pic" id="profilePic"
          src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
          alt="Profile Photo"/>
        <div class="profile-pic-edit">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
          </svg>
        </div>
        <input type="file" id="pic-input" accept="image/*" style="display:none" onchange="previewPic(this)"/>
      </div>
      <div class="profile-info">
        <h1>Nailong Andrei Amurao</h1>
        <p>LRN: 136676090147</p>
      </div>
    </div>

    <!-- PERSONAL & CONTACT CARD -->
    <div class="info-card">

      <!-- Personal Information -->
      <div class="section-label">Personal Information</div>
      <div class="form-grid">
        <div class="field">
          <label>Birthdate</label>
          <input type="text" value="October 12, 2008"/>
        </div>
        <div class="field">
          <label>Birthplace</label>
          <input type="text" value="Marikina City, Philippines"/>
        </div>
        <div class="field">
          <label>Gender</label>
          <input type="text" value="Male"/>
        </div>
        <div class="field">
          <label>Nationality</label>
          <input type="text" value="Filipino"/>
        </div>
      </div>

      <div class="section-divider"></div>

      <!-- Contact Information -->
      <div class="section-label">Contact Information</div>

      <div class="form-grid">
        <div class="field">
          <label>Mobile Number</label>
          <input type="text" value="+63 917 123 4567"/>
        </div>
        <div class="field">
          <label>Email Address</label>
          <input type="email" value="juan.delacruz@student.nsdga.edu.ph"/>
        </div>
      </div>

      <div style="margin-top: 16px;">
        <div class="field">
          <label>Complete Address</label>
          <input type="text" value="Block 6 Lot 12  Mahogany St., Brgy. San Antonio, Pasig City, Metro Manila"/>
        </div>
      </div>

      <!-- Save Button -->
      <div class="save-row">
        <button class="btn-save">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
          </svg>
          Save Changes
        </button>
      </div>

    </div>

    <div class="page-footer">&copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>

  </div>
</main>

<script>
  function previewPic(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profilePic').src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
</body>
</html>