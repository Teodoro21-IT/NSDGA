<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>About – Nuestra Señora De Guia Academy of Marikina</title>
<link rel="stylesheet" href="{{ asset('css/legacy/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/legacy/about.css') }}">
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f0f0f0; }

    /* ── TOP BAR ── */
    .top-bar { background: #c0392b; display: flex; align-items: center; padding: 10px 24px; gap: 14px; }
    .school-logo { width: 52px; height: 52px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 3px solid #fff; overflow: hidden; }
    .school-logo img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .school-logo a { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; overflow: hidden; }
    .school-title { color: #fff; font-size: clamp(0.85rem, 2.5vw, 1.35rem); font-family: Koh Santepheap; letter-spacing: 0.01em; line-height: 1.3; }

    /* ── NAV ── */
    nav { background: #fff; border-bottom: 2px solid #ddd; position: relative; }
    .nav-inner { display: flex; align-items: center; padding: 0 16px; max-width: 1100px; margin: 0 auto; flex-wrap: wrap; }
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
    .hero { position: relative; height: 420px; overflow: hidden; }
    .hero-img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
    .hero-fallback { position: absolute; inset: 0; background: #8B0000; z-index: 0; }
    .hero img { position: relative; z-index: 1; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, transparent 100%); z-index: 2; }
    .hero-content { position: absolute; inset: 0; z-index: 3; display: flex; flex-direction: column; justify-content: center; padding: 0 52px; }
    .hero-content .hero-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.7); margin-bottom: 10px; }
    .hero-content h1 { font-family: 'Koh Santepheap', serif; font-size: clamp(1.5rem, 4vw, 2.8rem); font-weight: 900; color: #fff; line-height: 1.2; text-shadow: 0 2px 14px rgba(0,0,0,0.6); margin-bottom: 12px; }
    .hero-content p { font-size: 0.88rem; color: rgba(255,255,255,0.8); text-shadow: 0 1px 6px rgba(0,0,0,0.4); max-width: 420px; line-height: 1.65; }

    /* ── VISION & MISSION ── */
    .vm-section { background: #fff; padding: 48px 24px; }
    .vm-inner { max-width: 1000px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 48px; }
    .vm-box .vm-num { font-size: 0.72rem; font-weight: 700; color: #c0392b; display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
    .vm-box .vm-num::after { content: ''; flex: 1; height: 2px; background: #e8e8e8; }
    .vm-box h3 { font-size: 1rem; font-weight: 700; color: #1a1a1a; margin-bottom: 12px; }
    .vm-box p { font-size: 0.85rem; color: #555; line-height: 1.75; }

    /* ── SEAL SECTION ── */
    .seal-section { background: #7a0000; padding: 52px 32px; }
    .seal-outer { max-width: 1100px; margin: 0 auto; }
    .seal-top-row { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 36px; }
    .seal-middle-row { display: grid; grid-template-columns: 1fr auto 1fr; gap: 36px; align-items: center; margin-bottom: 36px; }
    .seal-bottom-row { display: flex; justify-content: center; }
    .seal-center-text { max-width: 680px; text-align: center; }
    .seal-text-block h4 { font-size: 0.78rem; font-weight: 700; color: #fff; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 10px; }
    .seal-text-block p { font-size: 0.8rem; color: rgba(255,255,255,0.82); line-height: 1.75; margin-bottom: 8px; }
    .seal-text-block p:last-child { margin-bottom: 0; }
    .seal-logo-center { display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .seal-logo-ring { width: 180px; height: 180px; border-radius: 50%; overflow: hidden; border: 5px solid rgba(255,255,255,0.75); box-shadow: 0 0 0 8px rgba(255,255,255,0.12), 0 8px 32px rgba(0,0,0,0.4); background: #fff; flex-shrink: 0; }
    .seal-logo-ring img { width: 100%; height: 100%; object-fit: cover; display: block; }

    /* ── PHILOSOPHY ── */
    .philosophy-section { background: #f9f9f9; padding: 52px 24px; }
    .philosophy-inner { max-width: 1000px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1.7fr; gap: 44px; align-items: start; }
    .philosophy-img { width: 100%; border-radius: 6px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.12); aspect-ratio: 4/3; background: #ddd; }
    .philosophy-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .philosophy-text h2 { font-size: 1.2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 3px solid #c0392b; display: inline-block; }
    .philosophy-text p { font-size: 0.86rem; color: #555; line-height: 1.82; margin-bottom: 12px; text-align: justify; }
    .philosophy-text p:last-child { margin-bottom: 0; }

    /* ── HISTORY ── */
    .history-section { background: #fff; padding: 52px 24px; }
    .history-inner { max-width: 1000px; margin: 0 auto; }
    .history-inner h2 { font-size: 1.2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 24px; text-align: center; padding-bottom: 14px; position: relative; }
    .history-inner h2::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 44px; height: 3px; background: #c0392b; border-radius: 2px; }
    .history-inner p { font-size: 0.86rem; color: #555; line-height: 1.85; margin-bottom: 14px; text-align: justify; }
    .dashed-sep { border: none; border-top: 2px dashed #e0e0e0; margin: 24px 0; }

    /* ── EXECUTIVE BOARD ── */
    .exec-section { background: #f9f9f9; padding: 52px 24px; }
    .exec-inner { max-width: 1000px; margin: 0 auto; }
    .exec-inner h2 { font-size: 1.2rem; font-weight: 700; color: #1a1a1a; text-align: center; margin-bottom: 36px; padding-bottom: 14px; position: relative; }
    .exec-inner h2::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 44px; height: 3px; background: #c0392b; border-radius: 2px; }
    .exec-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
    .exec-card { background: #fff; border: 1px solid #e5e7ea; border-radius: 10px; padding: 24px 18px 20px; text-align: center; box-shadow: 0 1px 6px rgba(0,0,0,.05); transition: box-shadow .2s, transform .2s; }
    .exec-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.1); transform: translateY(-3px); }
    .exec-avatar { width: 78px; height: 78px; border-radius: 50%; overflow: hidden; border: 3px solid #e0e0e0; margin: 0 auto 14px; background: #f0f0f0; }
    .exec-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .exec-card .e-name { font-size: .88rem; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
    .exec-card .e-role { font-size: .73rem; color: #c0392b; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }

    /* ── NEW FOOTER ── */
    .site-footer { background: #7a0000; }

    .footer-main {
      max-width: 1200px; margin: 0 auto;
      padding: 48px 40px 40px;
      display: grid;
      grid-template-columns: 220px 1fr 1fr;
      gap: 48px;
    }

    /* Brand column */
    .footer-brand {
      display: flex; flex-direction: column; gap: 14px;
    }
    .footer-logo-wrap {
      display: flex; align-items: center; gap: 14px;
    }
    .footer-logo {
      width: 48px; height: 48px; border-radius: 50%; overflow: hidden;
      border: 2px solid rgba(255,255,255,0.6); background: #fff; flex-shrink: 0;
    }
    .footer-logo img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .footer-school-name {
      font-size: 0.88rem; font-weight: 700; color: #fff; line-height: 1.4;
    }

    /* Campus locations column */
    .footer-col-title {
      font-size: 0.7rem; font-weight: 700; letter-spacing: 0.14em;
      text-transform: uppercase; color: #fff; margin-bottom: 20px;
    }
    .footer-campuses {
      display: grid; grid-template-columns: 1fr 1fr; gap: 20px 28px;
    }
    .campus-block {}
    .campus-tag {
      font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em;
      text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 2px;
    }
    .campus-name {
      font-size: 0.84rem; font-weight: 700; color: #fff; margin-bottom: 4px;
    }
    .campus-detail {
      font-size: 0.75rem; color: rgba(255,255,255,0.72); line-height: 1.55;
    }

    /* Quick links column */
    .footer-links-col {}
    .footer-links-list {
      display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;
    }
    .footer-links-list a {
      font-size: 0.84rem; color: rgba(255,255,255,0.85); text-decoration: none;
      transition: color 0.18s; cursor: pointer;
    }
    .footer-links-list a:hover { color: #fff; text-decoration: underline; }
    .footer-socials { display: flex; align-items: center; gap: 10px; }
    .social-btn {
      width: 36px; height: 36px; border-radius: 50%;
      border: 2px solid rgba(255,255,255,0.4);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: border-color 0.18s, background 0.18s;
      text-decoration: none;
    }
    .social-btn:hover { border-color: #fff; background: rgba(255,255,255,0.1); }
    .social-btn svg { width: 16px; height: 16px; color: #fff; }

    /* Footer bottom bar */
    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.15);
      padding: 14px 40px;
      display: flex; align-items: center; justify-content: space-between;
      max-width: 1200px; margin: 0 auto;
    }
    .footer-copy { font-size: 0.73rem; color: rgba(255,255,255,0.55); }
    .footer-legal { display: flex; gap: 24px; }
    .footer-legal a {
      font-size: 0.73rem; font-weight: 700; letter-spacing: 0.06em;
      text-transform: uppercase; color: rgba(255,255,255,0.65);
      text-decoration: none; cursor: pointer; transition: color 0.18s;
    }
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
    .doc-modal-footer { flex-shrink: 0; padding: 14px 24px; border-top: 1px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between; background: #fff; }
    .doc-updated { display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: #9ca3af; }
    .doc-updated-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; }
    .doc-accept-btn { padding: 10px 22px; background: #7a0000; color: #fff; border: none; border-radius: 7px; font-family: Arial, sans-serif; font-size: 0.84rem; font-weight: 600; cursor: pointer; transition: background .18s; }
    .doc-accept-btn:hover { background: #5f0000; }
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
    .ci-value a { color: #c0392b; text-decoration: none; font-size: 0.82rem; }
    .ci-value a:hover { text-decoration: underline; }
    .contact-map { margin: 0 28px 28px; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7ea; height: 130px; }
    .contact-map iframe { width: 100%; height: 100%; border: none; display: block; }
</style>
</head>
<body>



<!-- NAVIGATION -->

<x-user-homepage.navbar />


<!-- HERO -->
<div class="hero">
  <div class="hero-fallback"></div>
  <img class="hero-img" src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12" alt="NSDGA Campus" onerror="this.style.opacity=0"/>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-label">About NSDGA</div>
    <h1>Nuestra Señora De<br>Guia Academy of<br>Marikina</h1>
    <p>A Christ-centered educational institution committed to forming holistic, God-fearing, and socially responsible citizens through quality Catholic education.</p>
  </div>
</div>

<!-- VISION & MISSION -->
<div class="vm-section">
  <div class="vm-inner">
    <div class="vm-box">
      <div class="vm-num">01</div>
      <h3>Our Vision</h3>
      <p>Nuestra Señora de Guia Academy of Marikina envisions itself as a Christ-centered educational institution that forms holistic, God-fearing, and socially responsible citizens committed to excellence and service to God, Church, and country.</p>
    </div>
    <div class="vm-box">
      <div class="vm-num">02</div>
      <h3>Our Mission</h3>
      <p>NSDGA is committed to provide quality and values-based Catholic education through Christ-centered learning that develops the intellectual, moral, social, and spiritual dimensions of every student — in partnership with the family and the broader community.</p>
    </div>
  </div>
</div>

<!-- SEAL SYMBOLISM -->
<div class="seal-section">
  <div class="seal-outer">
    <div class="seal-top-row">
      <div class="seal-text-block">
        <h4>BOOK OF KNOWLEDGE</h4>
        <p>Represents the school's thrust in delivering quality education relevant to the changing times. The book is open to show the school's openness to changes and new things. The Vision and Mission Statements of the School are embedded in the pages to serve as a constant reminder to all students of what it means to be a true Deguian.</p>
      </div>
      <div class="seal-text-block">
        <h4>ROMAN TORCH</h4>
        <p>Refers to the school's aspirations in blazing the trail in the field of education. The torch's flame is the light that leads us in the road ahead. The letters [FG] on the rim of the torch refer to the initials of the school's founding couple - Felipe and Guia while the letters [PG] on the torch's handle are the initials of the couple's four children - Philip James, Patrick Gene, Phia Mae, and Paul Gian. This shows the continuity in the administration of the school.</p>
      </div>
    </div>
    <div class="seal-middle-row">
      <div class="seal-text-block">
        <h4>TWELVE STARS</h4>
        <p>Represent the Marian inspiration in the founding of the school. Owing to the Directress' devotion to the Virgin at Ermita, she deemed it fit to initially name her school Nuestra Señora De Guia Learning Center. Due to the increasing number of its clientele and the additional courses the school is offering, the school has been renamed "Nuestra Señora De Guia Academy of Marikina".</p>
      </div>
      <div class="seal-logo-center">
        <div class="seal-logo-ring">
          <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="NSDGA Seal" onerror="this.style.display='none'"/>
        </div>
      </div>
      <div class="seal-text-block">
        <h4>LAUREL LEAVES</h4>
        <p>Symbolize the school's commitment to relevant and quality education. The five pairs of leaves symbolize the school's five-point objectives.</p>
      </div>
    </div>
    <div class="seal-bottom-row">
      <div class="seal-text-block seal-center-text">
        <h4>GREEN AND RED</h4>
        <p>Are the school's official colors. Green symbolizes life and hope. Life is a continuous growth for human fullness and hope that God will put order to everything we do. It also symbolizes the school's adherence to caring for the environment.</p>
        <p>As with green, the color red also symbolizes life. However, the color red shows the passion for excellence that is imbued to each and every Deguian graduate. It also symbolizes the love that moves every Deguian to excel.</p>
      </div>
    </div>
  </div>
</div>

<!-- PHILOSOPHY -->
<div class="philosophy-section">
  <div class="philosophy-inner">
    <div class="philosophy-img">
      <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80" alt="School Philosophy" onerror="this.style.opacity=0"/>
    </div>
    <div class="philosophy-text">
      <h2>School Philosophy</h2>
      <p>Nuestra Señora de Guia Academy believes that every child is a unique gift of God, endowed with inherent dignity and potential. Education, in its truest sense, is a sacred responsibility — a partnership between school, family, and community in forming well-rounded individuals.</p>
      <p>The school upholds the dignity of every learner, encouraging not just academic excellence but moral integrity, social responsibility, and spiritual growth rooted in the Catholic faith. Guided by the values of truth, justice, and compassion, NSDGA strives to nurture a generation of leaders who are both competent and conscientious.</p>
      <p>Guided by the intercession of Our Lady of Guia, the school nurtures an environment of compassion, discipline, and lifelong love for learning — preparing students not only for the challenges of today but for the demands of a rapidly changing world.</p>
      <p>In all its endeavors, NSDGA remains anchored in the belief that education is not merely the transfer of knowledge but the formation of character — building individuals who will serve God, family, and nation with excellence and faith.</p>
    </div>
  </div>
</div>

<!-- HISTORY -->
<div class="history-section">
  <div class="history-inner">
    <h2>Our History</h2>
    <p>Nuestra Señora de Guia Academy of Marikina was established with the vision of providing quality Catholic education to the youth of Marikina City. Founded by devoted educators and faith-driven leaders, the school has grown from a modest institution into a respected center of learning that has shaped thousands of graduates across several generations.</p>
    <p>In its early years, the academy operated with only a few classrooms and a handful of dedicated teachers who shared a common dream — to build a school where faith and excellence walk hand in hand. Through the years, the institution expanded its programs to include Kindergarten, Elementary, Junior High School, and Senior High School, responding to the growing educational needs of the community.</p>
    <hr class="dashed-sep"/>
    <p>The school has consistently produced graduates who have gone on to serve in various fields — medicine, engineering, law, education, and public service — carrying with them the values of integrity, compassion, and faith that NSDGA instilled in them from their formative years.</p>
    <p>Today, NSDGA continues to evolve, embracing modern teaching methodologies and technology-enhanced learning while holding firmly to its Catholic identity and mission. With a renewed commitment to holistic education and 21st-century skills, the academy strides confidently into the future, anchored in its rich heritage and unwavering dedication to the formation of young minds and hearts.</p>
    <hr class="dashed-sep"/>
    <p>As the NSDGA community looks forward to the coming years, it does so with gratitude for the past and excitement for the many milestones yet to come — always guided by Our Lady of Guia, the school's beloved patroness, whose intercession continues to bless the institution and all who belong to it.</p>
  </div>
</div>

<!-- EXECUTIVE BOARD -->
<div class="exec-section">
  <div class="exec-inner">
    <h2>EXECUTIVE BOARD</h2>
    <div class="exec-grid">
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Engr. Felber C. Lavallee</div><div class="e-role">In any position you</div>
      </div>
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Jane R. Serrano</div><div class="e-role">In any position you</div>
      </div>
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Philip James R. Lavallee</div><div class="e-role">In any position you</div>
      </div>
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Engr. Patricia Rose R. Serrano</div><div class="e-role">In any position you</div>
      </div>
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Pilar Ros A. Astrup</div><div class="e-role">In any position you</div>
      </div>
      <div class="exec-card">
        <div class="exec-avatar"><img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="" onerror="this.style.display='none'"/></div>
        <div class="e-name">Engr. Paulkinne B. Stralla</div><div class="e-role">In any position you</div>
      </div>
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
          <div class="campus-detail">904 J.P. Rizal St. Nangka Marikina<br>City</div>
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
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
          </svg>
        </a>
        <a class="social-btn" href="mailto:info@nsdgamarikina.edu.ph" title="Email">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
          </svg>
        </a>
      </div>
    </div>

  </div>

  <!-- Bottom bar -->
  <div class="footer-bottom" style="padding-bottom:16px;">
    <div class="footer-copy">&copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>
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
      <div class="doc-section"><div class="doc-num">2</div><div><div class="doc-section-title">Use of Information</div><div class="doc-section-text">Collected data is used exclusively for legitimate educational purposes, processing of school fees, emergency notifications, and compliance with Department of Education (DepEd) requirements.</div></div></div>
      <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-section-title">Data Sharing</div><div class="doc-section-text">We do not sell or trade your personal data. Sharing only occurs with authorized regulatory bodies or third-party service providers who assist in school operations, under strict confidentiality agreements.</div></div></div>
      <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-section-title">Security Measures</div><div class="doc-section-text">We implement technical and organizational security measures to protect your data against unauthorized access, disclosure, alteration, or destruction.</div></div></div>
      <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-section-title">Your Rights</div><div class="doc-section-text">Under the Data Privacy Act, you have the right to access, correct, and object to the processing of your personal data. Requests may be submitted to the Data Protection Officer at dpo@nsdgamarikina.edu.ph.</div></div></div>
    </div>
    <div class="doc-modal-footer">
      <div class="doc-updated"><div class="doc-updated-dot"></div>Last Updated: October 2024</div>
      <button class="doc-accept-btn" onclick="closeModal('privacy')">I Understand</button>
    </div>
  </div>
</div>

<!-- TERMS OF SERVICE MODAL -->
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
      <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-section-title">Account Security</div><div class="doc-section-text">Users are responsible for maintaining the confidentiality of their portal credentials. Notify the IT Department immediately of any unauthorized access.</div></div></div>
      <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-section-title">Fees and Payments</div><div class="doc-section-text">All tuition and miscellaneous fees must be settled according to the chosen payment scheme. The Academy reserves the right to withhold academic records for accounts with outstanding balances.</div></div></div>
      <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-section-title">Code of Conduct</div><div class="doc-section-text">All enrolled students are expected to uphold the values, standards, and policies outlined in the Academy's Student Handbook.</div></div></div>
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
      <div class="csb-block"><div class="csb-label">Campus Address</div><p class="csb-val">123 Academy Road, Marikina City, Metro Manila, 1800</p></div>
      <div class="csb-block"><div class="csb-label">Office Hours</div><p class="csb-val">Mon – Fri: 8:00 AM – 5:00 PM<br>Sat: 8:00 AM – 12:00 PM</p></div>
    </div>
    <div class="contact-panel">
      <button class="contact-close-btn" onclick="closeContactFn()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      <div class="contact-panel-inner">
        <div class="dept-block">
          <div class="dept-title">Registrar's Office</div>
          <div class="dept-contacts">
            <div><div class="ci-label">Email</div><div class="ci-value"><a href="mailto:registrar@nsdgamarikina.edu.ph">registrar@nsdgamarikina.edu.ph</a></div></div>
            <div><div class="ci-label">Mobile</div><div class="ci-value">+63 912 345 6789</div><div class="ci-label" style="margin-top:10px">Landline</div><div class="ci-value">(02) 8123 4567</div></div>
          </div>
        </div>
        <div class="dept-block">
          <div class="dept-title">Finance &amp; Accounting</div>
          <div class="dept-contacts">
            <div><div class="ci-label">Email</div><div class="ci-value"><a href="mailto:billing@nsdgamarikina.edu.ph">billing@nsdgamarikina.edu.ph</a></div></div>
            <div><div class="ci-label">Landline</div><div class="ci-value">(02) 8123 4568</div></div>
          </div>
        </div>
        <div class="dept-block">
          <div class="dept-title">Technical Support</div>
          <div class="dept-contacts">
            <div style="grid-column:1/-1"><div class="ci-label">Email</div><div class="ci-value"><a href="mailto:portalsupport@nsdgamarikina.edu.ph">portalsupport@nsdgamarikina.edu.ph</a></div></div>
          </div>
        </div>
      </div>
      <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.5!2d121.1!3d14.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDM5JzAwLjAiTiAxMjHCsDA2JzAwLjAiRQ!5e0!3m2!1sen!2sph!4v1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
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