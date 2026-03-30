<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nuestra Señora De Guia Academy of Marikina</title>
  <link rel="stylesheet" href="{{ asset('css/legacy/homepage.css') }}">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Lato', Arial, sans-serif; background: #f5f5f5; color: #1a1a1a; }

    /* ── TOP BAR ── */
    .top-bar { background: #c0392b; display: flex; align-items: center; padding: 10px 24px; gap: 14px; }
    .school-logo { width: 52px; height: 52px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 3px solid #fff; overflow: hidden; }
    .school-logo img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .school-logo a { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; overflow: hidden; }
    .school-title { color: #fff; font-size: clamp(0.85rem, 2.5vw, 1.35rem); font-family: 'Koh Santepheap', serif; letter-spacing: 0.01em; line-height: 1.3; }

    /* ── NAV ── */
    nav { background: #fff; border-bottom: 2px solid #ddd; }
    .nav-inner { display: flex; align-items: center; padding: 0 16px; max-width: 1100px; margin: 0 auto; }
    .nav-item { position: relative; }
    .nav-link { display: block; padding: 14px 14px; font-size: 0.74rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; color: #333; text-decoration: none; cursor: pointer; transition: color 0.2s, background 0.2s; white-space: nowrap; user-select: none; border-bottom: 3px solid transparent; }
    .nav-link:hover, .nav-item:hover .nav-link { color: #c0392b; background: #fdf0ef; }
    .nav-link.active { color: #c0392b; border-bottom-color: #c0392b; }
    .nav-spacer { flex: 1; }
    .nav-menu { display: flex; align-items: center; flex: 1; }
    .dropdown { display: none; position: absolute; top: 100%; left: 0; background: #fff; min-width: 200px; border: 1px solid #ddd; border-top: 3px solid #c0392b; box-shadow: 0 6px 18px rgba(0,0,0,0.12); z-index: 200; }
    .nav-item:hover .dropdown { display: block; }
    .dropdown a { display: block; padding: 12px 18px; font-size: 0.82rem; color: #333; text-decoration: none; border-bottom: 1px solid #f0f0f0; transition: background 0.18s, color 0.18s; }
    .dropdown a:last-child { border-bottom: none; }
    .dropdown a:hover { background: #c0392b; color: #fff; }

    /* ── HERO ── */
    .hero { position: relative; height: 480px; overflow: hidden; }
    .hero-fallback { position: absolute; inset: 0; background: #8B0000; z-index: 0; }
    .hero-img { position: relative; z-index: 1; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.45) 100%); z-index: 2; }
    .hero-content { position: absolute; inset: 0; z-index: 3; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 0 32px; }
    .hero-content h1 { font-family: 'Koh Santepheap', serif; font-size: clamp(1.6rem, 4vw, 3rem); font-weight: 900; color: #fff; line-height: 1.2; text-shadow: 0 2px 14px rgba(0,0,0,0.6); margin-bottom: 14px; }
    .hero-content p { font-size: 0.92rem; color: rgba(255,255,255,0.85); text-shadow: 0 1px 6px rgba(0,0,0,0.4); max-width: 520px; line-height: 1.7; margin-bottom: 24px; }
    .hero-btn { padding: 12px 30px; background: #c0392b; color: #fff; border: none; border-radius: 5px; font-family: 'Lato', sans-serif; font-size: 0.88rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; cursor: pointer; text-decoration: none; transition: background 0.2s; }
    .hero-btn:hover { background: #a93226; }

    /* ── ENROLLMENT SECTION ── */
    .enrollment-section { background: #fff; padding: 56px 32px; text-align: center; }
    .enrollment-section h2 { font-size: 1.4rem; font-weight: 900; color: #1a1a1a; margin-bottom: 10px; letter-spacing: -0.01em; }
    .enrollment-section > p { font-size: 0.88rem; color: #777; margin-bottom: 36px; }
    .enroll-cards { display: flex; justify-content: center; gap: 28px; flex-wrap: wrap; max-width: 760px; margin: 0 auto; }
    .enroll-card { background: #fff; border: 1px solid #e5e5e5; border-radius: 10px; padding: 36px 28px 32px; flex: 1; min-width: 240px; max-width: 320px; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: box-shadow 0.2s, transform 0.2s; cursor: pointer; }
    .enroll-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.12); transform: translateY(-4px); }
    .enroll-card .icon { font-size: 2.4rem; margin-bottom: 16px; }
    .enroll-card h3 { font-size: 1rem; font-weight: 700; color: #1a1a1a; margin-bottom: 10px; }
    .enroll-card p { font-size: 0.82rem; color: #666; line-height: 1.6; }

    /* ── CONTACT SECTION ── */
    .contact-section { background: #f9f9f9; padding: 52px 32px; border-top: 1px solid #efefef; }
    .contact-inner { max-width: 700px; margin: 0 auto; text-align: center; }
    .contact-inner h3 { font-size: 1.1rem; font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; position: relative; }
    .contact-inner h3::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 36px; height: 3px; background: #c0392b; border-radius: 2px; }
    .contact-block { margin-bottom: 14px; }
    .contact-block p { font-size: 0.85rem; color: #555; line-height: 1.65; }
    .contact-emails { margin-top: 18px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
    .contact-emails a { font-size: 0.84rem; color: #c0392b; text-decoration: none; font-weight: 600; }
    .contact-emails a:hover { text-decoration: underline; }

    /* ── NEW FOOTER ── */
    .site-footer { background: #7a0000; }
    .footer-main { max-width: 1200px; margin: 0 auto; padding: 48px 40px 40px; display: grid; grid-template-columns: 220px 1fr 1fr; gap: 48px; }

    .footer-brand { display: flex; flex-direction: column; gap: 14px; }
    .footer-logo-wrap { display: flex; align-items: center; gap: 14px; }
    .footer-logo { width: 48px; height: 48px; border-radius: 50%; overflow: hidden; border: 2px solid rgba(255,255,255,0.6); background: #fff; flex-shrink: 0; }
    .footer-logo img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .footer-school-name { font-size: 0.88rem; font-weight: 700; color: #fff; line-height: 1.4; }

    .footer-col-title { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: #fff; margin-bottom: 20px; }
    .footer-campuses { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 28px; }
    .campus-tag { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 2px; }
    .campus-name { font-size: 0.84rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
    .campus-detail { font-size: 0.75rem; color: rgba(255,255,255,0.72); line-height: 1.55; }

    .footer-links-col {}
    .footer-links-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
    .footer-links-list a { font-size: 0.84rem; color: rgba(255,255,255,0.85); text-decoration: none; transition: color 0.18s; cursor: pointer; }
    .footer-links-list a:hover { color: #fff; text-decoration: underline; }
    .footer-socials { display: flex; align-items: center; gap: 10px; }
    .social-btn { width: 36px; height: 36px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.4); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: border-color 0.18s, background 0.18s; text-decoration: none; }
    .social-btn:hover { border-color: #fff; background: rgba(255,255,255,0.1); }
    .social-btn svg { width: 16px; height: 16px; color: #fff; }

    .footer-bottom { border-top: 1px solid rgba(255,255,255,0.15); padding: 14px 40px 16px; display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto; }
    .footer-copy { font-size: 0.73rem; color: rgba(255,255,255,0.55); }
    .footer-legal { display: flex; gap: 24px; }
    .footer-legal a { font-size: 0.73rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: rgba(255,255,255,0.65); text-decoration: none; cursor: pointer; transition: color 0.18s; }
    .footer-legal a:hover { color: #fff; }

    /* ── MODALS ── */
    .modal-bd { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; }
    .modal-bd.open { display: flex; animation: fadeIn .2s ease; }
    @keyframes fadeIn { from{opacity:0}to{opacity:1} }
    @keyframes slideUp { from{transform:translateY(24px);opacity:0}to{transform:translateY(0);opacity:1} }
    .doc-modal { background: #fff; border-radius: 14px; width: 100%; max-width: 440px; max-height: 88vh; display: flex; flex-direction: column; box-shadow: 0 24px 70px rgba(0,0,0,.3); animation: slideUp .22s ease; overflow: hidden; }
    .doc-modal-header { padding: 22px 24px 0; flex-shrink: 0; position: relative; }
    .doc-modal-label { display: flex; align-items: center; gap: 7px; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #9ca3af; margin-bottom: 8px; }
    .doc-modal-label svg { width: 13px; height: 13px; color: #c0392b; }
    .doc-modal-header h2 { font-size: 1.7rem; font-weight: 900; color: #c0392b; letter-spacing: -0.01em; text-transform: uppercase; line-height: 1.1; margin-bottom: 16px; }
    .doc-close { position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background: #f3f4f6; border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .15s; }
    .doc-close:hover { background: #e5e7eb; }
    .doc-close svg { width: 13px; height: 13px; color: #444; }
    .doc-modal-body { flex: 1; overflow-y: auto; padding: 4px 24px 20px; }
    .doc-section { display: flex; gap: 14px; padding: 18px 0; border-bottom: 1px solid #f0f0f0; }
    .doc-section:last-child { border-bottom: none; }
    .doc-num { width: 24px; height: 24px; background: #c0392b; color: #fff; border-radius: 50%; font-size: 0.68rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
    .doc-section-title { font-size: 0.88rem; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
    .doc-section-text { font-size: 0.78rem; color: #6b7280; line-height: 1.7; }
    .doc-modal-footer { flex-shrink: 0; padding: 14px 24px; border-top: 1px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between; }
    .doc-updated { display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: #9ca3af; }
    .doc-updated-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; }
    .doc-accept-btn { padding: 10px 22px; background: #7a0000; color: #fff; border: none; border-radius: 7px; font-family: 'Lato', sans-serif; font-size: 0.84rem; font-weight: 600; cursor: pointer; transition: background .18s; }
    .doc-accept-btn:hover { background: #5f0000; }

    /* Contact modal */
    .contact-modal-wrap { display: flex; width: 100%; max-width: 620px; max-height: 88vh; border-radius: 14px; overflow: hidden; box-shadow: 0 24px 70px rgba(0,0,0,.3); animation: slideUp .22s ease; }
    .contact-sidebar { background: #7a0000; width: 190px; flex-shrink: 0; padding: 36px 24px 32px; display: flex; flex-direction: column; }
    .contact-sidebar-icon { width: 40px; height: 40px; background: rgba(255,255,255,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 18px; }
    .contact-sidebar-icon svg { width: 20px; height: 20px; color: #fff; }
    .contact-sidebar h2 { font-size: 1.18rem; font-weight: 700; color: #fff; line-height: 1.25; margin-bottom: 14px; }
    .contact-sidebar p { font-size: 0.75rem; color: rgba(255,255,255,0.72); line-height: 1.65; }
    .contact-sidebar-spacer { flex: 1; }
    .csb-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 5px; }
    .csb-val { font-size: 0.73rem; color: rgba(255,255,255,0.82); line-height: 1.55; }
    .csb-block { margin-top: 18px; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 12px; }
    .contact-panel { flex: 1; background: #fff; overflow-y: auto; position: relative; }
    .contact-close-btn { position: absolute; top: 14px; right: 14px; width: 28px; height: 28px; background: #f3f4f6; border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; transition: background .15s; }
    .contact-close-btn:hover { background: #e5e7eb; }
    .contact-close-btn svg { width: 13px; height: 13px; color: #444; }
    .contact-panel-inner { padding: 32px 28px 20px; }
    .dept-block { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f0f0f0; }
    .dept-block:last-child { border-bottom: none; margin-bottom: 0; }
    .dept-title { font-size: 0.95rem; font-weight: 700; color: #1a1a1a; margin-bottom: 14px; padding-left: 12px; border-left: 3px solid #c0392b; }
    .dept-contacts { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 20px; }
    .ci-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #9ca3af; margin-bottom: 3px; }
    .ci-value { font-size: 0.82rem; color: #1a1a1a; }
    .ci-value a { color: #c0392b; text-decoration: none; }
    .ci-value a:hover { text-decoration: underline; }
    .contact-map { margin: 0 28px 28px; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7ea; height: 130px; }
    .contact-map iframe { width: 100%; height: 100%; border: none; display: block; }

    @media (max-width: 768px) {
      .footer-main { grid-template-columns: 1fr; gap: 28px; padding: 36px 24px; }
      .enroll-cards { flex-direction: column; align-items: center; }
      .footer-bottom { flex-direction: column; gap: 10px; text-align: center; padding: 16px 24px; }
    }
  </style>
</head>
<body>

  <!-- NAVIGATION -->
 <x-navbar />

  <!-- HERO -->
  <div class="hero">
    <div class="hero-fallback"></div>
    <img class="hero-img"
      src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/279082044_4612026305569681_2700375734337963259_n.png?stp=dst-png_s960x960&_nc_cat=106&ccb=1-7&_nc_sid=2a1932&_nc_eui2=AeGf3zszmhZTB1Nw3MD2hwzeCAa8t7jNJwgIBry3uM0nCCq3SKt0ePw0cdBqS3tKqupyrPCGde3z8-YX0iZZ-vvg&_nc_ohc=FuIbO24uoB8Q7kNvwH5GWDf&_nc_oc=AdkYWqDmAQXyOqh4V1aZKDQJPKrIj4YstMoibKmKJhU_ZHfl0DzrLIkj-okiNrlA5XNs3Pdw0cHWV-DEvQxAkDwS&_nc_zt=23&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_AftqGv6hvJFyCMWhLsgYivPDxWHSv_8-KYTu6oLCEH944g&oe=69A86399"
      alt="NSDGA Campus" onerror="this.style.opacity=0"/>
    <div class="hero-overlay"></div>
  </div>

  <!-- ENROLLMENT OPTIONS -->
  <div class="enrollment-section">
    <h2>Enrollment &amp; Admission</h2>
    <p>Choose your preferred enrollment method below.</p>
    <div class="enroll-cards">
      <div class="enroll-card">
        <div class="icon">💻</div>
        <h3>Online Enrollment</h3>
        <p>Enroll conveniently from home through our online portal.</p>
      </div>
      <div class="enroll-card">
        <div class="icon">🏫</div>
        <h3>On-Campus Admission</h3>
        <p>Visit the school registrar's office to process your admission in person.</p>
      </div>
    </div>
  </div>
  <!-- ── NEW FOOTER ── -->
  <footer class="site-footer">
    <div class="footer-main">

      <!-- Brand -->
      <div class="footer-brand">
        <div class="footer-logo-wrap">
          <div class="footer-logo">
            <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="NSDGA Logo" onerror="this.style.display='none'"/>
          </div>
          <span class="footer-school-name">Nuestra Señora De Guia<br>Academy of Marikina</span>
        </div>
      </div>

      <!-- Campus Locations -->
      <div class="footer-col">
        <div class="footer-col-title">Campus Locations</div>
        <div class="footer-campuses">
          <div class="campus-block">
            <div class="campus-name">Greenland Campus</div>
            <div class="campus-detail">14 Washington St. Greenland Subd. Ph.1<br>Nangka Marikina City<br>Tel: (7) 933-7729 | 0925-8856698</div>
          </div>
          <div class="campus-block">
            <div class="campus-name">Parang Campus</div>
            <div class="campus-detail">3 C.M. Recto St. Parang<br>Marikina City</div>
          </div>
          <div class="campus-block">
            <div class="campus-tag">Main Campus</div>
            <div class="campus-name">Greenheights Campus</div>
            <div class="campus-detail">98 Soliven St. Greenheights Subd. Ph.3<br>Nangka Marikina City</div>
          </div>
          <div class="campus-block">
            <div class="campus-name">J.P. Rizal Campus</div>
            <div class="campus-detail">904 J.P. Rizal St. Nangka Marikina City</div>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-links-col">
        <div class="footer-col-title">Quick Links</div>
        <div class="footer-links-list">
          <a href="schoolcalendar.php">Academic Calendar</a>
          <a href="about.php">About Us</a>
          <a onclick="openContactFn()">Contact Us</a>
        </div>
        <div class="footer-socials">
          <a class="social-btn" href="https://www.facebook.com" target="_blank" title="Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
          </a>
          <a class="social-btn" href="mailto:info@nsdgamarikina.edu.ph" title="Email">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
          </a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <div class="footer-copy">&copy; 2025 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>
      <div class="footer-legal">
        <a onclick="openModal('privacy')">Privacy Policy</a>
        <a onclick="openModal('tos')">Terms of Service</a>
      </div>
    </div>
  </footer>

  <!-- PRIVACY MODAL -->
  <div class="modal-bd" id="privacyBd" onclick="if(event.target===this)closeModal('privacy')">
    <div class="doc-modal">
      <div class="doc-modal-header">
        <button class="doc-close" onclick="closeModal('privacy')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <div class="doc-modal-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Legal Document</div>
        <h2>Privacy Policy</h2>
      </div>
      <div class="doc-modal-body">
        <div class="doc-section"><div class="doc-num">1</div><div><div class="doc-section-title">Information Collection</div><div class="doc-section-text">We collect personal and sensitive information during the enrollment process, including names, birthdates, addresses, academic history, and medical records. This data is essential for academic administration and student safety.</div></div></div>
        <div class="doc-section"><div class="doc-num">2</div><div><div class="doc-section-title">Use of Information</div><div class="doc-section-text">Collected data is used exclusively for legitimate educational purposes, processing of school fees, emergency notifications, and compliance with DepEd requirements.</div></div></div>
        <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-section-title">Data Sharing</div><div class="doc-section-text">We do not sell or trade your personal data. Sharing only occurs with authorized regulatory bodies under strict confidentiality agreements.</div></div></div>
        <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-section-title">Security Measures</div><div class="doc-section-text">We implement technical and organizational security measures to protect your data against unauthorized access, disclosure, alteration, or destruction.</div></div></div>
        <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-section-title">Your Rights</div><div class="doc-section-text">Under the Data Privacy Act, you have the right to access, correct, and object to the processing of your personal data. Contact dpo@nsdgamarikina.edu.ph.</div></div></div>
      </div>
      <div class="doc-modal-footer">
        <div class="doc-updated"><div class="doc-updated-dot"></div>Last Updated: October 2024</div>
        <button class="doc-accept-btn" onclick="closeModal('privacy')">I Understand</button>
      </div>
    </div>
  </div>

  <!-- TOS MODAL -->
  <div class="modal-bd" id="tosBd" onclick="if(event.target===this)closeModal('tos')">
    <div class="doc-modal">
      <div class="doc-modal-header">
        <button class="doc-close" onclick="closeModal('tos')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <div class="doc-modal-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Legal Document</div>
        <h2>Terms of Service</h2>
      </div>
      <div class="doc-modal-body">
        <div class="doc-section"><div class="doc-num">1</div><div><div class="doc-section-title">Binding Agreement</div><div class="doc-section-text">By using the NSDGA Online Enrollment System, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.</div></div></div>
        <div class="doc-section"><div class="doc-num">2</div><div><div class="doc-section-title">Eligibility for Enrollment</div><div class="doc-section-text">Enrollment is subject to the submission of valid documentary requirements and the successful completion of the academy's assessment process.</div></div></div>
        <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-section-title">Account Security</div><div class="doc-section-text">Users are responsible for maintaining the confidentiality of their portal credentials. Notify IT immediately of any unauthorized access.</div></div></div>
        <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-section-title">Fees and Payments</div><div class="doc-section-text">All tuition and miscellaneous fees must be settled according to the chosen payment scheme. The Academy may withhold records for outstanding balances.</div></div></div>
        <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-section-title">Code of Conduct</div><div class="doc-section-text">All enrolled students are expected to uphold the values and policies in the Academy's Student Handbook. Violations may result in disciplinary action.</div></div></div>
      </div>
      <div class="doc-modal-footer">
        <div class="doc-updated"><div class="doc-updated-dot"></div>Last Updated: October 2024</div>
        <button class="doc-accept-btn" onclick="closeModal('tos')">I Accept</button>
      </div>
    </div>
  </div>

  <!-- CONTACT MODAL -->
  <div class="modal-bd" id="contactBd" onclick="if(event.target===this)closeContactFn()">
    <div class="contact-modal-wrap">
      <div class="contact-sidebar">
        <div class="contact-sidebar-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
        <h2>Contact Information</h2>
        <p>We are here to assist with your academic journey. Reach out to the specific department for your concerns.</p>
        <div class="contact-sidebar-spacer"></div>
        <div class="csb-block"><div class="csb-label">Campus Address</div><p class="csb-val">14 Washington St. Greenland Subd. Ph.1, Nangka Marikina City</p></div>
        <div class="csb-block"><div class="csb-label">Office Hours</div><p class="csb-val">Mon – Fri: 8:00 AM – 5:00 PM<br>Sat: 8:00 AM – 12:00 PM</p></div>
      </div>
      <div class="contact-panel">
        <button class="contact-close-btn" onclick="closeContactFn()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <div class="contact-panel-inner">
          <div class="dept-block">
            <div class="dept-title">Registrar's Office</div>
            <div class="dept-contacts">
              <div><div class="ci-label">Email</div><div class="ci-value"><a href="mailto:nag.ghregistrar@gmail.com">nag.ghregistrar@gmail.com</a></div></div>
              <div><div class="ci-label">Landline</div><div class="ci-value">7-933-7729 / 8-997-8198</div></div>
            </div>
          </div>
          <div class="dept-block">
            <div class="dept-title">Greenheights Campus</div>
            <div class="dept-contacts">
              <div><div class="ci-label">Email</div><div class="ci-value"><a href="mailto:nsdg.gh@gmail.com">nsdg.gh@gmail.com</a></div></div>
              <div><div class="ci-label">Landline</div><div class="ci-value">8-535-4384 / 7-719-3744</div></div>
            </div>
          </div>
        </div>
        <div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.5!2d121.1!3d14.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDM5JzAwLjAiTiAxMjHCsDA2JzAwLjAiRQ!5e0!3m2!1sen!2sph!4v1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
      </div>
    </div>
  </div>

  <script>
    function openModal(type) { document.getElementById(type+'Bd').classList.add('open'); document.body.style.overflow='hidden'; }
    function closeModal(type) { document.getElementById(type+'Bd').classList.remove('open'); document.body.style.overflow=''; }
    function openContactFn() { document.getElementById('contactBd').classList.add('open'); document.body.style.overflow='hidden'; }
    function closeContactFn() { document.getElementById('contactBd').classList.remove('open'); document.body.style.overflow=''; }
    document.addEventListener('keydown', e => { if(e.key==='Escape'){['privacy','tos'].forEach(t=>closeModal(t));closeContactFn();} });
  </script>

</body>
</html>