<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Portal – Nuestra Señora de Guia Academy</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Merriweather:wght@700;900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="css/studentportal.css">


</head>
<body>

<!-- ══════════════════════════════
     PAGE 1 · LOGIN
══════════════════════════════ -->
<div class="page active" id="page-login">

  <!-- ── LEFT ── -->
  <div class="left">

    <!--
      BACKGROUND IMAGE
      Replace the src below with any image URL of the school building.
      The red overlay is applied on top automatically.
    -->
    <img
      class="left-bg-img"
      src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/495456756_122103031318856493_1946055366127485498_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHQnVkEXQtVFoRfWzm4rvtlC5L9H2rr1ioLkv0fauuWKvJAI-lnTFd4x8j_z_uqb9JiVXKgXKUBFbBRzECX4Htt&_nc_ohc=YOUR_KEY&_nc_zt=23&_nc_ht=scontent.fmnl2-2.fna&oh=YOUR_OH&oe=YOUR_OE"
      alt="School Building"
      onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(170deg,#3d0000,#7a0000,#3d0000)'"
    />

    <!-- Red tint overlay -->
    <div class="left-overlay"></div>

    <div class="left-content">

      <!-- SCHOOL LOGO -->
      <div class="logo-circle">
        <img
          src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
          alt="NSDGA Logo"
          onerror="this.style.display='none'"
        />
      </div>

      <h1 class="school-name">Nuestra Señora de Guia<br>Academy</h1>
      <p class="tagline">Guiding Young Minds Toward Excellence and Faith.</p>
    </div>
  </div>

  <!-- ── RIGHT ── -->
  <div class="right">
    <div class="form-card">
      <h2 class="form-title">Student Portal Login</h2>
      <p class="form-sub">Welcome back! Please enter your details.</p>

      <div class="field">
        <label>Email or LRN number</label>
        <div class="input-wrap">
          <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <input type="text" placeholder="e.g. 136676090147"/>
        </div>
      </div>

      <div class="field">
        <label>Password</label>
        <div class="input-wrap">
          <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="pw-l" value="••••••••"/>
          <button class="pw-eye" onclick="togglePw('pw-l',this)" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <div class="opts">
        <label class="chk-label"><input type="checkbox"/> Remember me</label>
        <a href="#" class="link-red">Forgot password?</a>
      </div>

      <button class="btn-main">Sign In to Portal</button>

      <div class="divider">Or continue with</div>
      <div class="social-row">
        <button class="soc-btn">
          <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" fill="#1877F2"/></svg>
        </button>
        <button class="soc-btn">
          <svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        </button>
      </div>

      <p class="switch-row">Don't have an account yet? <a onclick="go('signup')">Sign up</a></p>
    </div>
    <div class="footer">© 2024 Nuestra Señora de Guia Academy of Marikina. All rights reserved.</div>
  </div>

</div><!-- /page-login -->


<!-- ══════════════════════════════
     PAGE 2 · SIGN UP
══════════════════════════════ -->
<div class="page" id="page-signup">

  <!-- ── LEFT ── -->
  <div class="left">

    <!--
      BACKGROUND IMAGE — same src as login page.
      Change src to any URL of the school building photo.
    -->
    <img
      class="left-bg-img"
      src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/495456756_122103031318856493_1946055366127485498_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHQnVkEXQtVFoRfWzm4rvtlC5L9H2rr1ioLkv0fauuWKvJAI-lnTFd4x8j_z_uqb9JiVXKgXKUBFbBRzECX4Htt&_nc_ohc=YOUR_KEY&_nc_zt=23&_nc_ht=scontent.fmnl2-2.fna&oh=YOUR_OH&oe=YOUR_OE"
      alt="School Building"
      onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(170deg,#3d0000,#7a0000,#3d0000)'"
    />

    <div class="left-overlay"></div>

    <div class="left-content">

      <div class="logo-circle">
        <img
          src="https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-1/339880589_940066963787721_5038736764753486106_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_eui2=AeFGALL8y4S1CbZ7qHZo0qPKAaT_rrS5FKEBpP-utLkUoRdRhhe_QXKdNP1ylmeFzeq6bb1uwanF-2MbHvtH8FBs&_nc_ohc=6BiWq6qcdRkQ7kNvwHk1t_u&_nc_oc=AdmqbJmpDiu2Fxg-kmiv3bKdKbfGS3RAuBjhdVHzWS4aSW-nzva3zRsU2FRB7e4-jLAnLbu6_ONCI40rywcwpZjz&_nc_zt=24&_nc_ht=scontent.fmnl2-2.fna&_nc_gid=7UXo2VmwyDUE5qtFsXp_lg&_nc_ss=8&oh=00_Afu5ugc0liztZN7FkkHpYgdGW-tqX0GJgMyBbfyHn2fVGw&oe=69A8697F"
          alt="NSDGA Logo"
          onerror="this.style.display='none'"
        />
      </div>

      <h1 class="school-name">Nuestra Señora de Guia<br>Academy</h1>
      <p class="tagline">Guiding Young Minds Toward Excellence and Faith.</p>
    </div>
  </div>

  <!-- ── RIGHT ── -->
  <div class="right">
    <div class="form-card">
      <h2 class="form-title">Create Account</h2>
      <p class="form-sub">Register with your student credentials to access the portal.</p>

      <div class="field">
        <label>Full Name</label>
        <div class="input-wrap">
          <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <input type="text" placeholder="Juan Dela Cruz"/>
        </div>
      </div>

      <div class="two-col">
        <div class="field">
          <label>Student Email</label>
          <div class="input-wrap">
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <input type="email" placeholder="student@nsga.edu.ph"/>
          </div>
        </div>
        <div class="field">
          <label>LRN Number</label>
          <div class="input-wrap">
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="text" placeholder="12-digit LRN"/>
          </div>
        </div>
      </div>

      <div class="field">
        <label>Password</label>
        <div class="input-wrap">
          <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="pw-s1" placeholder="••••••••"/>
          <button class="pw-eye" onclick="togglePw('pw-s1',this)" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <div class="field">
        <label>Confirm Password</label>
        <div class="input-wrap">
          <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <input type="password" id="pw-s2" placeholder="••••••••"/>
          <button class="pw-eye" onclick="togglePw('pw-s2',this)" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <div class="terms-row">
        <input type="checkbox" id="terms"/>
        <label for="terms">I agree to the <a href="#" class="link-red">Terms of Service</a> and <a href="#" class="link-red">Privacy Policy</a> of NSGA.</label>
      </div>

      <button class="btn-main">
        Create Account
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>

      <p class="switch-row">Already have an account? <a onclick="go('login')">Sign in</a></p>
    </div>
    <div class="footer">© 2024 Nuestra Señora de Guia Academy of Marikina. All rights reserved.</div>
  </div>

</div><!-- /page-signup -->


<script>
function go(target){
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-' + target).classList.add('active');
  window.scrollTo(0,0);
}

function togglePw(id, btn){
  const inp = document.getElementById(id);
  const hide = inp.type === 'password';
  inp.type = hide ? 'text' : 'password';
  btn.querySelector('svg').innerHTML = hide
    ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
       <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
       <line x1="1" y1="1" x2="23" y2="23"/>`
    : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}
</script>
</body>
</html>