<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Enrollment Form – NSDGA Marikina</title>
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
      border: 2px solid rgba(255,255,255,0.35); object-fit: cover;
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
    .notif-badge {
      margin-left: auto; background: #c0392b; color: #fff;
      font-size: 0.65rem; font-weight: 900; border-radius: 50%;
      width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;
    }
    .sidebar-footer { padding: 14px 18px 20px; border-top: 1px solid rgba(255,255,255,0.12); }
    .sidebar-footer a {
      display: flex; align-items: center; gap: 10px;
      color: rgba(255,255,255,0.65); font-size: 0.82rem; text-decoration: none;
    }
    .sidebar-footer a:hover { color: #fff; }
    .sidebar-footer a svg { width: 15px; height: 15px; }

    /* ── MAIN ── */
    .main { margin-left: 178px; flex: 1; padding: 28px 32px 48px; }

    .page-title h1 {
      font-size: 1.25rem; font-weight: 900; color: #111;
      text-transform: uppercase; letter-spacing: 0.02em; margin-bottom: 4px;
    }
    .page-subtitle { font-size: 0.76rem; color: #888; margin-bottom: 20px; }
    .page-subtitle .star { color: #c0392b; }

    /* ── FORM SECTION ── */
    .form-section {
      background: #fff; border: 1px solid #e5e5e5; border-radius: 7px;
      padding: 20px 24px; margin-bottom: 16px;
    }
    .section-title {
      display: flex; align-items: center; gap: 7px;
      font-size: 0.88rem; font-weight: 900; color: #111; margin-bottom: 16px;
    }
    .section-title svg { width: 16px; height: 16px; color: #7a0000; }
    .section-title .star { color: #c0392b; margin-left: 2px; }

    /* ── GRID ── */
    .row { display: grid; gap: 12px 14px; margin-bottom: 12px; }
    .row:last-child { margin-bottom: 0; }
    .c3  { grid-template-columns: 1fr 1fr 1fr; }
    .c2  { grid-template-columns: 1fr 1fr; }
    .c21 { grid-template-columns: 2fr 1fr; }
    .c1  { grid-template-columns: 1fr; }

    .field { display: flex; flex-direction: column; gap: 4px; }
    .field label { font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: #555; }
    .field label .r { color: #c0392b; }
    .field input, .field select {
      width: 100%; padding: 7px 10px; border: 1px solid #ddd; border-radius: 5px;
      font-size: 0.82rem; font-family: 'Lato', sans-serif; color: #222;
      background: #fff; outline: none; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field input:focus, .field select:focus {
      border-color: #7a0000; box-shadow: 0 0 0 3px rgba(122,0,0,0.07);
    }
    .field input::placeholder { color: #bbb; }

    /* ── PILL CHOICES ── */
    .pill-label {
      font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
      text-transform: uppercase; color: #555; margin-bottom: 6px; display: block;
    }
    .pill-label .r { color: #c0392b; }

    .pill-group {
      display: flex; flex-wrap: wrap; gap: 7px;
    }

    .pill {
      padding: 5px 14px;
      border: 1.5px solid #ddd;
      border-radius: 20px;
      font-size: 0.78rem;
      font-family: 'Lato', sans-serif;
      font-weight: 600;
      color: #555;
      background: #fff;
      cursor: pointer;
      transition: all 0.15s;
      user-select: none;
      white-space: nowrap;
    }
    .pill:hover { border-color: #7a0000; color: #7a0000; background: #fff8f8; }
    .pill.selected {
      background: #7a0000;
      border-color: #7a0000;
      color: #fff;
    }
    .pill.disabled {
      opacity: 0.35;
      cursor: not-allowed;
      pointer-events: none;
    }

    /* strand pills — larger because of long text */
    .strand-pill {
      padding: 6px 14px;
      border: 1.5px solid #ddd;
      border-radius: 6px;
      font-size: 0.76rem;
      font-family: 'Lato', sans-serif;
      font-weight: 600;
      color: #555;
      background: #fff;
      cursor: pointer;
      transition: all 0.15s;
      user-select: none;
      text-align: left;
    }
    .strand-pill:hover { border-color: #7a0000; color: #7a0000; background: #fff8f8; }
    .strand-pill.selected { background: #7a0000; border-color: #7a0000; color: #fff; }

    .pill-field { display: flex; flex-direction: column; }

    /* hidden section */
    #strand-section { display: none; margin-top: 12px; }

    /* ── DOC GRID ── */
    .doc-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }
    .doc-card {
      border: 1px solid #e5e5e5; border-radius: 7px; padding: 16px 14px 12px;
      display: flex; flex-direction: column; align-items: center;
      gap: 5px; text-align: center; background: #fafafa;
    }
    .doc-card svg { width: 26px; height: 26px; color: #bbb; margin-bottom: 3px; }
    .doc-name { font-size: 0.76rem; font-weight: 700; color: #222; }
    .doc-name .r { color: #c0392b; }
    .doc-desc { font-size: 0.68rem; color: #aaa; line-height: 1.4; }
    .doc-card.optional { opacity: 0.65; }
    .upload-btn {
      padding: 4px 14px; background: #fff; border: 1px solid #ccc; border-radius: 4px;
      font-size: 0.69rem; font-family: 'Lato', sans-serif; font-weight: 700;
      letter-spacing: 0.06em; text-transform: uppercase; color: #444; cursor: pointer;
      margin-top: 3px; transition: background 0.15s;
    }
    .upload-btn:hover { background: #f0f0f0; }
    .upload-btn.opt { color: #aaa; border-color: #e0e0e0; background: #f8f8f8; }
    input[type="file"] { display: none; }
    .file-label { font-size: 0.67rem; color: #2e7d32; min-height: 14px; }

    /* ── BOTTOM ── */
    .cert-row {
      display: flex; align-items: center; gap: 8px;
      font-size: 0.78rem; color: #555; margin-top: 8px;
    }
    .cert-row input { accent-color: #7a0000; width: 14px; height: 14px; }
    .btn-row { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
    .btn-draft {
      padding: 9px 22px; background: #fff; border: 1px solid #ccc; border-radius: 5px;
      font-family: 'Lato', sans-serif; font-size: 0.82rem; font-weight: 700; color: #444; cursor: pointer;
    }
    .btn-draft:hover { background: #f5f5f5; }
    .btn-submit {
      padding: 9px 24px; background: #7a0000; border: none; border-radius: 5px;
      font-family: 'Lato', sans-serif; font-size: 0.82rem; font-weight: 700; color: #fff; cursor: pointer;
    }
    .btn-submit:hover { background: #9a0000; }
    .page-footer { text-align: center; font-size: 0.72rem; color: #bbb; margin-top: 24px; }

    @media (max-width: 600px) {
      .sidebar { display: none; }
      .main { margin-left: 0; padding: 16px; }
      .c3, .c2, .c21 { grid-template-columns: 1fr; }
      .doc-grid { grid-template-columns: 1fr 1fr; }
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
    <a href="enrollmentform.php" class="active">
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
      <span class="notif-badge">9</span>
    </a>
     <a href="myprofile.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
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

  <div class="page-title"><h1>Student Enrollment Form</h1></div>
  <div class="page-subtitle">Please fill out all required fields marked with an asterisk (<span class="star">*</span>) to process your registration.</div>

  <!-- PERSONAL INFORMATION -->
  <div class="form-section">
    <div class="section-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>Personal Information <span class="star">*</span>
    </div>

    <div class="row c3">
      <div class="field"><label>First Name <span class="r">*</span></label><input type="text" placeholder="Enter first name"/></div>
      <div class="field"><label>Middle Name</label><input type="text" placeholder="Enter middle name"/></div>
      <div class="field"><label>Last Name <span class="r">*</span></label><input type="text" placeholder="Enter last name"/></div>
    </div>

    <div class="row c3">
      <div class="field"><label>LRN (12-digit) <span class="r">*</span></label><input type="text" placeholder="000000000000" maxlength="12"/></div>
      <div class="field">
        <label>Sex <span class="r">*</span></label>
        <select><option value="">Select Sex</option><option>Male</option><option>Female</option></select>
      </div>
      <div class="field"><label>Age <span class="r">*</span></label><input type="number" placeholder="0" min="3" max="25"/></div>
    </div>

    <div class="row c21">
      <div class="field"><label>Date of Birth <span class="r">*</span></label><input type="date"/></div>
      <div class="field"><label>Birthplace <span class="r">*</span></label><input type="text" placeholder="City, Province"/></div>
    </div>

    <div class="row c1">
      <div class="field"><label>Home Address <span class="r">*</span></label><input type="text" placeholder="House No., Street, Brgy, City, Province"/></div>
    </div>

    <div class="row c2">
      <div class="field"><label>Contact Number <span class="r">*</span></label><input type="text" placeholder="09XX-X-XXX-XXXX" maxlength="13"/></div>
      <div class="field">
        <label>School Year <span class="r">*</span></label>
        <input type="text" value="2024-2025"/>
      </div>
    </div>

    <div class="row c2">
      <div class="field">
        <label>Student Type <span class="r">*</span></label>
        <select><option>New Student</option><option>Old Student</option><option>Transferee</option></select>
      </div>
    </div>

    <!-- Education Level pills -->
    <div style="margin-top:14px;">
      <span class="pill-label">Education Level <span class="r">*</span></span>
      <div class="pill-group" id="edu-group">
        <button type="button" class="pill" data-level="elementary" onclick="selectLevel(this)">Elementary</button>
        <button type="button" class="pill" data-level="jhs" onclick="selectLevel(this)">Junior High School</button>
        <button type="button" class="pill" data-level="shs" onclick="selectLevel(this)">Senior High School</button>
      </div>
    </div>

    <!-- Grade Level pills -->
    <div style="margin-top:14px;" id="grade-section">
      <span class="pill-label">Grade Level Applying For <span class="r">*</span></span>
      <div class="pill-group" id="grade-group">
        <span style="font-size:0.75rem;color:#bbb;font-style:italic;">Select an education level first</span>
      </div>
    </div>

    <!-- Strand pills — SHS only -->
    <div style="margin-top:14px;" id="strand-section">
      <span class="pill-label">Strand <span class="r">*</span></span>
      <div class="pill-group" id="strand-group" style="flex-direction:column; align-items:flex-start;">
        <button type="button" class="strand-pill" onclick="selectStrand(this)">STEM – Science, Technology, Engineering & Mathematics</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">ABM – Accountancy, Business & Management</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">HUMSS – Humanities & Social Sciences</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">GAS – General Academic Strand</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">TVL – Technical-Vocational-Livelihood</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">SPORTS Track</button>
        <button type="button" class="strand-pill" onclick="selectStrand(this)">ARTS & DESIGN Track</button>
      </div>
    </div>

  </div>

  <!-- ACADEMIC BACKGROUND -->
  <div class="form-section">
    <div class="section-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
      </svg>Academic Background <span class="star">*</span>
    </div>

    <div class="row c2">
      <div class="field"><label>Previous School Attended <span class="r">*</span></label><input type="text" placeholder="Enter school name"/></div>
      <div class="field">
        <label>Course / Strand Interested <span class="r">*</span></label>
        <select>
          <option value="">Select a course</option>
          <option>STEM – Science, Technology, Engineering & Mathematics</option>
          <option>ABM – Accountancy, Business & Management</option>
          <option>HUMSS – Humanities & Social Sciences</option>
          <option>GAS – General Academic Strand</option>
          <option>TVL – Technical-Vocational-Livelihood</option>
        </select>
      </div>
    </div>

    <div class="row c2">
      <div class="field"><label>Last Grade/Year Level Completed <span class="r">*</span></label><input type="text" placeholder="e.g. Grade 12"/></div>
      <div class="field"><label>GWA (General Weighted Average) <span class="r">*</span></label><input type="text" placeholder="e.g. 92.5"/></div>
    </div>
  </div>

  <!-- DOCUMENT REQUIREMENTS -->
  <div class="form-section">
    <div class="section-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
      </svg>Document Requirements <span class="star">*</span>
    </div>

    <div class="doc-grid">
      <div class="doc-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
        </svg>
        <div class="doc-name">2x2 Picture <span class="r">*</span></div>
        <div class="doc-desc">High quality, white background</div>
        <button class="upload-btn" onclick="document.getElementById('f-pic').click()">Upload File</button>
        <input type="file" id="f-pic" accept="image/*" onchange="showFile(this,'l-pic')"/>
        <span class="file-label" id="l-pic"></span>
      </div>

      <div class="doc-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <div class="doc-name">Report Card <span class="r">*</span></div>
        <div class="doc-desc">Scanned copy of latest grades</div>
        <button class="upload-btn" onclick="document.getElementById('f-rc').click()">Upload File</button>
        <input type="file" id="f-rc" onchange="showFile(this,'l-rc')"/>
        <span class="file-label" id="l-rc"></span>
      </div>

      <div class="doc-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="12" y1="17" x2="8" y2="17"/>
        </svg>
        <div class="doc-name">Form 137 <span class="r">*</span></div>
        <div class="doc-desc">Official Student Permanent Record</div>
        <button class="upload-btn" onclick="document.getElementById('f-137').click()">Upload File</button>
        <input type="file" id="f-137" onchange="showFile(this,'l-137')"/>
        <span class="file-label" id="l-137"></span>
      </div>

      <div class="doc-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 8h10M7 12h6"/>
        </svg>
        <div class="doc-name">PSA Birth Certificate <span class="r">*</span></div>
        <div class="doc-desc">Clear copy from PSA</div>
        <button class="upload-btn" onclick="document.getElementById('f-psa').click()">Upload File</button>
        <input type="file" id="f-psa" onchange="showFile(this,'l-psa')"/>
        <span class="file-label" id="l-psa"></span>
      </div>

      <div class="doc-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        <div class="doc-name">Good Moral Cert <span class="r">*</span></div>
        <div class="doc-desc">Upload our commitment form</div>
        <button class="upload-btn" onclick="document.getElementById('f-moral').click()">Upload File</button>
        <input type="file" id="f-moral" onchange="showFile(this,'l-moral')"/>
        <span class="file-label" id="l-moral"></span>
      </div>

      <div class="doc-card optional">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <div class="doc-name">Additional Documents</div>
        <div class="doc-desc">Upload any supporting documents</div>
        <button class="upload-btn opt" onclick="document.getElementById('f-extra').click()">Optional</button>
        <input type="file" id="f-extra" multiple onchange="showFile(this,'l-extra')"/>
        <span class="file-label" id="l-extra"></span>
      </div>
    </div>
  </div>

  <div class="cert-row">
    <input type="checkbox" id="cert"/>
    <label for="cert">I hereby certify that the information above is true and correct.</label>
  </div>

  <div class="btn-row">
    <button class="btn-draft">Save Draft</button>
    <button class="btn-submit">Submit Enrollment</button>
  </div>

  <div class="page-footer">&copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>

</main>

<script>
  const gradeMap = {
    elementary: ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6'],
    jhs:        ['Grade 7','Grade 8','Grade 9','Grade 10'],
    shs:        ['Grade 11','Grade 12']
  };

  function selectLevel(btn) {
    // toggle education level selection
    document.querySelectorAll('#edu-group .pill').forEach(p => p.classList.remove('selected'));
    btn.classList.add('selected');

    const level = btn.dataset.level;
    const gradeGroup = document.getElementById('grade-group');
    const strandSection = document.getElementById('strand-section');

    // Build grade pills
    gradeGroup.innerHTML = '';
    gradeMap[level].forEach(g => {
      const p = document.createElement('button');
      p.type = 'button';
      p.className = 'pill';
      p.textContent = g;
      p.onclick = function() { selectGrade(this); };
      gradeGroup.appendChild(p);
    });

    // Show/hide strand
    strandSection.style.display = (level === 'shs') ? 'block' : 'none';
    // Clear strand selection when switching levels
    document.querySelectorAll('#strand-group .strand-pill').forEach(p => p.classList.remove('selected'));
  }

  function selectGrade(btn) {
    document.querySelectorAll('#grade-group .pill').forEach(p => p.classList.remove('selected'));
    btn.classList.add('selected');
  }

  function selectStrand(btn) {
    document.querySelectorAll('#strand-group .strand-pill').forEach(p => p.classList.remove('selected'));
    btn.classList.add('selected');
  }

  function showFile(input, labelId) {
    const el = document.getElementById(labelId);
    el.textContent = input.files.length > 1
      ? input.files.length + ' files selected'
      : (input.files[0] ? input.files[0].name : '');
  }
</script>

</body>
</html>