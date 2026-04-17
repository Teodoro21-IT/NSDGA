<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>School Calendar – Nuestra Señora De Guia Academy of Marikina</title>
<link href="https://fonts.googleapis.com/css2?family=Koh+Santepheap:wght@400;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'DM Sans', Arial, sans-serif; background: #f5f5f5; color: #1a1a1a; }

    .top-bar { background: #c0392b; display: flex; align-items: center; padding: 10px 24px; gap: 14px; }
    .school-logo { width: 52px; height: 52px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 3px solid #fff; overflow: hidden; }
    .school-logo img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .school-logo a { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; overflow: hidden; }
    .school-title { color: #fff; font-size: clamp(0.85rem, 2.5vw, 1.35rem); font-family: 'Koh Santepheap', serif; letter-spacing: 0.01em; line-height: 1.3; }

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

    .calendar-hero { background: #fff; padding: 52px 48px 44px; border-bottom: 1px solid #efefef; display: flex; align-items: flex-start; justify-content: space-between; gap: 32px; }
    .hero-left { max-width: 520px; }
    .cal-year-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #c0392b; margin-bottom: 10px; }
    .cal-hero-title { font-family: 'DM Sans', sans-serif; font-size: clamp(1.8rem, 3.8vw, 2.7rem); font-weight: 700; line-height: 1.15; color: #1a1a1a; margin-bottom: 18px; }
    .cal-hero-title .red { color: #c0392b; }
    .cal-hero-desc { font-size: 0.88rem; color: #6b7280; line-height: 1.72; max-width: 420px; }
    .cal-widget { flex-shrink: 0; width: 136px; height: 136px; border: 1.5px solid #e5e5e5; border-radius: 10px; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.07); display: flex; flex-direction: column; overflow: hidden; }
    .cal-widget-head { background: #c0392b; color: #fff; text-align: center; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; padding: 6px 0; }
    .cal-widget-body { flex: 1; padding: 7px 5px; display: grid; grid-template-columns: repeat(7, 1fr); gap: 1px; }
    .cal-widget-body span { font-size: 0.56rem; text-align: center; color: #555; line-height: 1.9; }
    .cal-widget-body span.h { font-weight: 700; color: #aaa; font-size: 0.52rem; }
    .cal-widget-body span.today { background: #c0392b; color: #fff; border-radius: 50%; font-weight: 700; }
    .cal-widget-body span.dim { color: #ccc; }

    .events-section { background: #fff; padding: 44px 48px 48px; border-bottom: 1px solid #efefef; }
    .section-header-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 26px; }
    .section-title { font-size: 0.9rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #1a1a1a; }
    .nav-arrows { display: flex; gap: 8px; }
    .nav-arrow { width: 30px; height: 30px; border: 1.5px solid #d1d5db; border-radius: 6px; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .15s, border-color .15s; }
    .nav-arrow:hover { background: #f5f5f5; border-color: #aaa; }
    .nav-arrow svg { width: 13px; height: 13px; color: #555; }
    .events-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .event-card { background: #fff; border: 1px solid #e5e7ea; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.05); cursor: pointer; transition: box-shadow .2s, transform .18s; }
    .event-card:hover { box-shadow: 0 8px 26px rgba(0,0,0,.12); transform: translateY(-4px); }
    .event-thumb-placeholder { width: 100%; height: 165px; display: flex; align-items: center; justify-content: center; font-size: 3rem; }
    .event-body { padding: 15px 16px 18px; }
    .event-tags { display: flex; align-items: center; gap: 8px; margin-bottom: 7px; flex-wrap: wrap; }
    .event-tag { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; padding: 2px 8px; border-radius: 3px; }
    .tag-foundation { background: #fde8e8; color: #c0392b; }
    .tag-academic   { background: #e8f4fd; color: #2563eb; }
    .tag-social     { background: #fef3e2; color: #d97706; }
    .event-date-label { font-size: 0.68rem; color: #9ca3af; }
    .event-title { font-size: .9rem; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; line-height: 1.3; }
    .event-desc  { font-size: 0.76rem; color: #6b7280; line-height: 1.6; }

    .schedule-section { background: #f9f9f9; padding: 52px 48px 60px; }
    .schedule-title { font-size: 0.9rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #1a1a1a; text-align: center; margin-bottom: 40px; padding-bottom: 14px; position: relative; }
    .schedule-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 36px; height: 3px; background: #c0392b; border-radius: 2px; }
    .schedule-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; max-width: 980px; margin: 0 auto; }
    .semester-label { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 22px; }
    .sem-num { font-size: 1.55rem; font-weight: 700; color: #c0392b; line-height: 1; flex-shrink: 0; }
    .sem-name { font-size: .9rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
    .sem-dates { font-size: 0.73rem; color: #9ca3af; }
    .schedule-list { display: flex; flex-direction: column; }
    .schedule-item { display: flex; align-items: center; justify-content: space-between; padding: 11px 0; border-bottom: 1px solid #ebebeb; }
    .schedule-item:last-child { border-bottom: none; }
    .si-name { font-size: .82rem; font-weight: 600; color: #1a1a1a; margin-bottom: 2px; }
    .si-desc { font-size: 0.72rem; color: #9ca3af; }
    .si-date { font-size: 0.76rem; font-weight: 600; color: #c0392b; white-space: nowrap; flex-shrink: 0; margin-left: 12px; }

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

    /* Modals */
    @keyframes fadeIn { from{opacity:0}to{opacity:1} }
    @keyframes slideUp { from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1} }
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:1000; align-items:center; justify-content:center; }
    .modal-backdrop.open { display:flex; animation:fadeIn .2s ease; }
    .modal { background:#fff; border-radius:12px; width:90%; max-width:460px; max-height:90vh; overflow-y:auto; position:relative; box-shadow:0 20px 60px rgba(0,0,0,0.25); animation:slideUp .22s ease; }
    .modal-close { position:absolute; top:12px; right:14px; width:28px; height:28px; background:rgba(255,255,255,0.9); border:none; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; z-index:10; box-shadow:0 2px 8px rgba(0,0,0,0.15); transition:background .15s; }
    .modal-close:hover { background:#f0f0f0; }
    .modal-close svg { width:14px; height:14px; color:#333; }
    .modal-img-placeholder { width:100%; height:220px; display:flex; align-items:center; justify-content:center; font-size:4rem; border-radius:12px 12px 0 0; }
    .modal-body { padding:24px 28px 28px; text-align:center; }
    .modal-title { font-size:1rem; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; color:#1a1a1a; margin-bottom:6px; }
    .modal-date { font-size:0.78rem; color:#9ca3af; margin-bottom:18px; }
    .modal-desc-box { border:1.5px dashed #c0392b; border-radius:6px; padding:18px 20px; margin-bottom:20px; }
    .modal-desc-box p { font-size:0.82rem; color:#444; line-height:1.72; text-align:center; }
    .modal-btn { width:100%; padding:13px; background:#7a0000; color:#fff; border:none; border-radius:7px; cursor:pointer; font-family:'DM Sans',sans-serif; font-size:0.88rem; font-weight:600; letter-spacing:0.04em; transition:background .18s; }
    .modal-btn:hover { background:#5f0000; }

    .contact-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1100; align-items:center; justify-content:center; padding:20px; }
    .contact-backdrop.open { display:flex; animation:fadeIn .2s ease; }
    .contact-modal-wrap { display:flex; width:100%; max-width:620px; max-height:88vh; border-radius:14px; overflow:hidden; box-shadow:0 24px 70px rgba(0,0,0,0.3); animation:slideUp .22s ease; }
    .c-sidebar { background:#7a0000; width:190px; flex-shrink:0; padding:36px 24px 32px; display:flex; flex-direction:column; }
    .c-sidebar-icon { width:40px; height:40px; background:rgba(255,255,255,0.15); border-radius:8px; display:flex; align-items:center; justify-content:center; margin-bottom:18px; }
    .c-sidebar-icon svg { width:20px; height:20px; color:#fff; }
    .c-sidebar h2 { font-size:1.18rem; font-weight:700; color:#fff; line-height:1.25; margin-bottom:14px; }
    .c-sidebar p { font-size:0.75rem; color:rgba(255,255,255,0.72); line-height:1.65; }
    .c-sidebar-spacer { flex:1; }
    .c-addr-label,.c-hrs-label { font-size:0.6rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.5); margin-bottom:5px; }
    .c-addr-val,.c-hrs-val { font-size:0.73rem; color:rgba(255,255,255,0.82); line-height:1.55; }
    .c-hrs { margin-top:18px; }
    .c-panel { flex:1; background:#fff; overflow-y:auto; position:relative; }
    .c-close { position:absolute; top:14px; right:14px; width:28px; height:28px; background:#f3f4f6; border:none; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; z-index:10; }
    .c-close:hover { background:#e5e7eb; }
    .c-close svg { width:13px; height:13px; color:#444; }
    .c-panel-inner { padding:32px 28px 28px; }
    .dept-block { margin-bottom:28px; padding-bottom:28px; border-bottom:1px solid #f0f0f0; }
    .dept-block:last-of-type { border-bottom:none; margin-bottom:0; }
    .dept-title { font-size:0.95rem; font-weight:700; color:#1a1a1a; margin-bottom:14px; padding-left:12px; border-left:3px solid #c0392b; }
    .dept-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px 20px; }
    .ci-label { font-size:0.6rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:#9ca3af; margin-bottom:3px; }
    .ci-val { font-size:0.82rem; color:#1a1a1a; }
    .ci-val a { color:#c0392b; text-decoration:none; }
    .ci-val a:hover { text-decoration:underline; }
    .c-map { margin:0 28px 28px; border-radius:8px; overflow:hidden; border:1px solid #e5e7ea; height:130px; }
    .c-map iframe { width:100%; height:100%; border:none; display:block; }

    .doc-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1200; align-items:center; justify-content:center; padding:20px; }
    .doc-backdrop.open { display:flex; animation:fadeIn .2s ease; }
    .doc-modal { background:#fff; border-radius:14px; width:100%; max-width:440px; max-height:88vh; display:flex; flex-direction:column; box-shadow:0 24px 70px rgba(0,0,0,0.3); animation:slideUp .22s ease; overflow:hidden; }
    .doc-header { padding:22px 24px 0; flex-shrink:0; position:relative; }
    .doc-tag { display:flex; align-items:center; gap:7px; font-size:0.6rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#9ca3af; margin-bottom:8px; }
    .doc-tag svg { width:13px; height:13px; color:#c0392b; }
    .doc-header h2 { font-size:1.7rem; font-weight:900; color:#c0392b; letter-spacing:-0.01em; text-transform:uppercase; line-height:1.1; margin-bottom:16px; }
    .doc-x { position:absolute; top:18px; right:18px; width:28px; height:28px; background:#f3f4f6; border:none; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; }
    .doc-x:hover { background:#e5e7eb; }
    .doc-x svg { width:13px; height:13px; color:#444; }
    .doc-body { flex:1; overflow-y:auto; padding:4px 24px 20px; }
    .doc-section { display:flex; gap:14px; padding:18px 0; border-bottom:1px solid #f0f0f0; }
    .doc-section:last-child { border-bottom:none; }
    .doc-num { width:24px; height:24px; background:#c0392b; color:#fff; border-radius:50%; font-size:0.68rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; }
    .doc-s-title { font-size:0.88rem; font-weight:700; color:#1a1a1a; margin-bottom:6px; }
    .doc-s-text { font-size:0.78rem; color:#6b7280; line-height:1.7; }
    .doc-footer { flex-shrink:0; padding:14px 24px; border-top:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; background:#fff; }
    .doc-updated { display:flex; align-items:center; gap:6px; font-size:0.72rem; color:#9ca3af; }
    .doc-dot { width:7px; height:7px; background:#22c55e; border-radius:50%; }
    .doc-btn { padding:10px 22px; background:#7a0000; color:#fff; border:none; border-radius:7px; font-family:'DM Sans',sans-serif; font-size:0.84rem; font-weight:600; cursor:pointer; }
    .doc-btn:hover { background:#5f0000; }
</style>
</head>
<body>
<!-- NAVIGATION -->
 <x-user-homepage.navbar />




<div class="calendar-hero">
  <div class="hero-left">
    <div class="cal-year-label">Academic Year 2026–2027</div>
    <h1 class="cal-hero-title">Charting the Path to<br><span class="red">Excellence.</span></h1>
    <p class="cal-hero-desc">Stay informed with our comprehensive academic schedule and upcoming campus events. Plan your journey at Nuestra Señora De Guia Academy with precision.</p>
  </div>
  <div class="cal-widget">
    <div class="cal-widget-head">March 2026</div>
    <div class="cal-widget-body">
      <span class="h">S</span><span class="h">M</span><span class="h">T</span><span class="h">W</span><span class="h">T</span><span class="h">F</span><span class="h">S</span>
      <span class="dim">23</span><span class="dim">24</span><span class="dim">25</span><span class="dim">26</span><span class="dim">27</span><span class="dim">28</span><span>1</span>
      <span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span>
      <span>9</span><span>10</span><span>11</span><span>12</span><span>13</span><span>14</span><span>15</span>
      <span class="today">16</span><span>17</span><span>18</span><span>19</span><span>20</span><span>21</span><span>22</span>
      <span>23</span><span>24</span><span>25</span><span>26</span><span>27</span><span>28</span><span>29</span>
      <span>30</span><span>31</span>
    </div>
  </div>
</div>

<div class="events-section">
  <div class="section-header-row">
    <span class="section-title">School Events</span>
    <div class="nav-arrows">
      <button class="nav-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></button>
      <button class="nav-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></button>
    </div>
  </div>
  <div class="events-grid">
    <div class="event-card" onclick="openEventModal('foundation')">
      <div class="event-thumb-placeholder" style="background:linear-gradient(135deg,#f5e6d3,#e8c9a0)">🎓</div>
      <div class="event-body">
        <div class="event-tags"><span class="event-tag tag-foundation">Foundation Day</span><span class="event-date-label">Dec 15, 2024</span></div>
        <div class="event-title">Foundation Day Celebration</div>
        <div class="event-desc">Celebrating 45 years of academic excellence and spiritual guidance. Join us for a day of gratitude, performances, and community fellowship.</div>
      </div>
    </div>
    <div class="event-card" onclick="openEventModal('stem')">
      <div class="event-thumb-placeholder" style="background:linear-gradient(135deg,#d8eaf5,#b3d4ec)">🎨</div>
      <div class="event-body">
        <div class="event-tags"><span class="event-tag tag-academic">Academic Week</span><span class="event-date-label">Feb 06, 2026</span></div>
        <div class="event-title">STEM & Arts Exhibition</div>
        <div class="event-desc">Showcasing the creative and scientific breakthroughs of our brilliant students. An interactive gallery open to parents and visitors.</div>
      </div>
    </div>
    <div class="event-card" onclick="openEventModal('christmas')">
      <div class="event-thumb-placeholder" style="background:linear-gradient(135deg,#fde8d8,#f5c6a8)">🎄</div>
      <div class="event-body">
        <div class="event-tags"><span class="event-tag tag-social">Social</span><span class="event-date-label">Dec 16, 2026</span></div>
        <div class="event-title">Christmas Gala Night</div>
        <div class="event-desc">A festive evening dedicated to giving and joy, featuring the Academy Chorale and our traditional lighting of the campus tree.</div>
      </div>
    </div>
  </div>
</div>

<div class="schedule-section">
  <div class="schedule-title">Academic Schedule</div>
  <div class="schedule-grid">
    <div>
      <div class="semester-label"><div class="sem-num">01</div><div><div class="sem-name">1st Semester</div><div class="sem-dates">August 2026 — December 2026</div></div></div>
      <div class="schedule-list">
        <div class="schedule-item"><div><div class="si-name">Start of Classes</div><div class="si-desc">Full curriculum opening and orientation</div></div><div class="si-date">Aug 14</div></div>
        <div class="schedule-item"><div><div class="si-name">Mid-term Exams</div><div class="si-desc">Assessments period for all levels</div></div><div class="si-date">Oct 10-18</div></div>
        <div class="schedule-item"><div><div class="si-name">Final Exams</div><div class="si-desc">End-of-semester examinations</div></div><div class="si-date">Dec 11-20</div></div>
        <div class="schedule-item"><div><div class="si-name">Semestral Break</div><div class="si-desc">School rest and family bonding</div></div><div class="si-date">Dec 16 – Jan 5</div></div>
      </div>
    </div>
    <div>
      <div class="semester-label"><div class="sem-num">02</div><div><div class="sem-name">2nd Semester</div><div class="sem-dates">January 2027 — June 2027</div></div></div>
      <div class="schedule-list">
        <div class="schedule-item"><div><div class="si-name">Resumption of Classes</div><div class="si-desc">Beginning of the second half of the year</div></div><div class="si-date">Jan 6</div></div>
        <div class="schedule-item"><div><div class="si-name">Mid-term Exams</div><div class="si-desc">Assessments period for all levels</div></div><div class="si-date">Mar 12-14</div></div>
        <div class="schedule-item"><div><div class="si-name">Final Exams</div><div class="si-desc">Year-end examinations</div></div><div class="si-date">May 21-30</div></div>
        <div class="schedule-item"><div><div class="si-name">Commencement Exercises</div><div class="si-desc">Graduation and moving up ceremonies</div></div><div class="si-date">June 4-6</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ── NEW FOOTER ── -->
<footer class="site-footer">
  <div class="footer-main">

    <div class="footer-brand">
      <div class="footer-logo-wrap">
        <div class="footer-logo">
          <img src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F" alt="NSDGA Logo" onerror="this.style.display='none'"/>
        </div>
        <span class="footer-school-name">Nuestra Señora De Guia<br>Academy of Marikina</span>
      </div>
    </div>

    <div>
      <div class="footer-col-title">Campus Locations</div>
      <div class="footer-campuses">
        <div>
          <div class="campus-name">Greenland Campus</div>
          <div class="campus-detail">14 Washington St. Greenland Subd. Ph.1<br>Nangka Marikina City<br>Tel: (7) 933-7729 | 0925-8856698</div>
        </div>
        <div>
          <div class="campus-name">Parang Campus</div>
          <div class="campus-detail">3 C.M. Recto St. Parang<br>Marikina City</div>
        </div>
        <div>
          <div class="campus-tag">Main Campus</div>
          <div class="campus-name">Greenheights Campus</div>
          <div class="campus-detail">98 Soliven St. Greenheights Subd. Ph.3<br>Nangka Marikina City</div>
        </div>
        <div>
          <div class="campus-name">J.P. Rizal Campus</div>
          <div class="campus-detail">904 J.P. Rizal St. Nangka Marikina City</div>
        </div>
      </div>
    </div>

    <div>
      <div class="footer-col-title">Quick Links</div>
      <div class="footer-links-list">
        <a href="schoolcalendar.php">Academic Calendar</a>
        <a href="about.php">About Us</a>
        <a onclick="openContactModal()">Contact Us</a>
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
    <div class="footer-copy">&copy; 2024 Nuestra Señora De Guia Academy of Marikina. All rights reserved.</div>
    <div class="footer-legal">
      <a onclick="openDocModal('privacy')">Privacy Policy</a>
      <a onclick="openDocModal('tos')">Terms of Service</a>
    </div>
  </div>
</footer>

<!-- EVENT MODAL -->
<div class="modal-backdrop" id="eventBd" onclick="if(event.target===this)closeEventModal()">
  <div class="modal">
    <button class="modal-close" onclick="closeEventModal()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    <div id="evImgWrap"></div>
    <div class="modal-body">
      <div class="modal-title" id="evTitle"></div>
      <div class="modal-date" id="evDate"></div>
      <div class="modal-desc-box"><p id="evDesc"></p></div>
      <button class="modal-btn" onclick="closeEventModal()">Close Event</button>
    </div>
  </div>
</div>

<!-- CONTACT MODAL -->
<div class="contact-backdrop" id="contactBd" onclick="if(event.target===this)closeContactModal()">
  <div class="contact-modal-wrap">
    <div class="c-sidebar">
      <div class="c-sidebar-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
      <h2>Contact Information</h2>
      <p>We are here to assist with your academic journey. Reach out to the specific department for your concerns.</p>
      <div class="c-sidebar-spacer"></div>
      <div><div class="c-addr-label">Campus Address</div><div class="c-addr-val">123 Academy Road, Marikina City, Metro Manila, 1800</div></div>
      <div class="c-hrs"><div class="c-hrs-label">Office Hours</div><div class="c-hrs-val">Mon – Fri: 8:00 AM – 5:00 PM<br>Sat: 8:00 AM – 12:00 PM</div></div>
    </div>
    <div class="c-panel">
      <button class="c-close" onclick="closeContactModal()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      <div class="c-panel-inner">
        <div class="dept-block">
          <div class="dept-title">Registrar's Office</div>
          <div class="dept-grid">
            <div><div class="ci-label">Email</div><div class="ci-val"><a href="mailto:registrar@nsdgamarikina.edu.ph">registrar@nsdgamarikina.edu.ph</a></div></div>
            <div><div class="ci-label">Mobile</div><div class="ci-val">+63 912 345 6789</div><div class="ci-label" style="margin-top:8px">Landline</div><div class="ci-val">(02) 8123 4567</div></div>
          </div>
        </div>
        <div class="dept-block">
          <div class="dept-title">Finance &amp; Accounting</div>
          <div class="dept-grid">
            <div><div class="ci-label">Email</div><div class="ci-val"><a href="mailto:billing@nsdgamarikina.edu.ph">billing@nsdgamarikina.edu.ph</a></div></div>
            <div><div class="ci-label">Landline</div><div class="ci-val">(02) 8123 4568</div></div>
          </div>
        </div>
        <div class="dept-block">
          <div class="dept-title">Technical Support</div>
          <div class="dept-grid">
            <div style="grid-column:1/-1"><div class="ci-label">Email</div><div class="ci-val"><a href="mailto:portalsupport@nsdgamarikina.edu.ph">portalsupport@nsdgamarikina.edu.ph</a></div></div>
          </div>
        </div>
      </div>
      <div class="c-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.5!2d121.1!3d14.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDM5JzAwLjAiTiAxMjHCsDA2JzAwLjAiRQ!5e0!3m2!1sen!2sph!4v1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </div>
  </div>
</div>

<!-- PRIVACY MODAL -->
<div class="doc-backdrop" id="privacyBd" onclick="if(event.target===this)closeDocModal('privacy')">
  <div class="doc-modal">
    <div class="doc-header">
      <button class="doc-x" onclick="closeDocModal('privacy')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      <div class="doc-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Legal Document</div>
      <h2>Privacy Policy</h2>
    </div>
    <div class="doc-body">
      <div class="doc-section"><div class="doc-num">1</div><div><div class="doc-s-title">Information Collection</div><div class="doc-s-text">We collect personal and sensitive information during the enrollment process, including names, birthdates, addresses, academic history, and medical records.</div></div></div>
      <div class="doc-section"><div class="doc-num">2</div><div><div class="doc-s-title">Use of Information</div><div class="doc-s-text">Collected data is used exclusively for legitimate educational purposes, processing of school fees, emergency notifications, and compliance with DepEd requirements.</div></div></div>
      <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-s-title">Data Sharing</div><div class="doc-s-text">We do not sell or trade your personal data. Sharing only occurs with authorized regulatory bodies under strict confidentiality agreements.</div></div></div>
      <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-s-title">Security Measures</div><div class="doc-s-text">We implement technical and organizational security measures to protect your data against unauthorized access, disclosure, alteration, or destruction.</div></div></div>
      <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-s-title">Your Rights</div><div class="doc-s-text">Under the Data Privacy Act, you have the right to access, correct, and object to the processing of your personal data. Contact dpo@nsdgamarikina.edu.ph.</div></div></div>
    </div>
    <div class="doc-footer"><div class="doc-updated"><div class="doc-dot"></div>Last Updated: October 2024</div><button class="doc-btn" onclick="closeDocModal('privacy')">I Understand</button></div>
  </div>
</div>

<!-- TOS MODAL -->
<div class="doc-backdrop" id="tosBd" onclick="if(event.target===this)closeDocModal('tos')">
  <div class="doc-modal">
    <div class="doc-header">
      <button class="doc-x" onclick="closeDocModal('tos')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      <div class="doc-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Legal Document</div>
      <h2>Terms of Service</h2>
    </div>
    <div class="doc-body">
      <div class="doc-section"><div class="doc-num">1</div><div><div class="doc-s-title">Binding Agreement</div><div class="doc-s-text">By using the NSDGA Online Enrollment System, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.</div></div></div>
      <div class="doc-section"><div class="doc-num">2</div><div><div class="doc-s-title">Eligibility for Enrollment</div><div class="doc-s-text">Enrollment is subject to the submission of valid documentary requirements and the successful completion of the academy's assessment process.</div></div></div>
      <div class="doc-section"><div class="doc-num">3</div><div><div class="doc-s-title">Account Security</div><div class="doc-s-text">Users are responsible for maintaining the confidentiality of their portal credentials. Notify IT immediately of any unauthorized access.</div></div></div>
      <div class="doc-section"><div class="doc-num">4</div><div><div class="doc-s-title">Fees and Payments</div><div class="doc-s-text">All tuition and miscellaneous fees must be settled according to the chosen payment scheme. The Academy may withhold records for outstanding balances.</div></div></div>
      <div class="doc-section"><div class="doc-num">5</div><div><div class="doc-s-title">Code of Conduct</div><div class="doc-s-text">All enrolled students are expected to uphold the values and policies in the Academy's Student Handbook. Violations may result in disciplinary action.</div></div></div>
    </div>
    <div class="doc-footer"><div class="doc-updated"><div class="doc-dot"></div>Last Updated: October 2024</div><button class="doc-btn" onclick="closeDocModal('tos')">I Accept</button></div>
  </div>
</div>

<script>
  const evData = {
    foundation: { title:'Foundation Day Celebration', date:'Dec 15, 2024', desc:'Celebrating 45 years of academic excellence and spiritual guidance. Join us for a day of gratitude, performances, and community fellowship.', bg:'linear-gradient(135deg,#f5e6d3,#e8c9a0)', emoji:'🎓' },
    stem:       { title:'STEM & Arts Exhibition',     date:'Feb 06, 2026', desc:'Showcasing the creative and scientific breakthroughs of our brilliant students. An interactive gallery open to parents and visitors.', bg:'linear-gradient(135deg,#d8eaf5,#b3d4ec)', emoji:'🎨' },
    christmas:  { title:'Christmas Gala Night',       date:'Dec 16, 2026', desc:'A festive evening dedicated to giving and joy. Featuring the Academy Chorale and our traditional lighting of the campus Christmas tree.', bg:'linear-gradient(135deg,#fde8d8,#f5c6a8)', emoji:'🎄' }
  };
  function openEventModal(k) {
    const e=evData[k]; if(!e) return;
    document.getElementById('evImgWrap').innerHTML=`<div class="modal-img-placeholder" style="background:${e.bg}">${e.emoji}</div>`;
    document.getElementById('evTitle').textContent=e.title.toUpperCase();
    document.getElementById('evDate').textContent=e.date;
    document.getElementById('evDesc').textContent=e.desc;
    document.getElementById('eventBd').classList.add('open');
    document.body.style.overflow='hidden';
  }
  function closeEventModal(){ document.getElementById('eventBd').classList.remove('open'); document.body.style.overflow=''; }
  function openContactModal(){ document.getElementById('contactBd').classList.add('open'); document.body.style.overflow='hidden'; }
  function closeContactModal(){ document.getElementById('contactBd').classList.remove('open'); document.body.style.overflow=''; }
  function openDocModal(t){ document.getElementById(t+'Bd').classList.add('open'); document.body.style.overflow='hidden'; }
  function closeDocModal(t){ document.getElementById(t+'Bd').classList.remove('open'); document.body.style.overflow=''; }
  document.addEventListener('keydown',e=>{ if(e.key==='Escape'){ closeEventModal(); closeContactModal(); closeDocModal('privacy'); closeDocModal('tos'); } });
</script>

</body>
</html>


</body>
</html>