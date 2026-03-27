<?php session_start(); include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en" data-theme=""> <!-- Root HTML element with theme support -->
<head>
  <meta charset="UTF-8" /> <!-- Character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Responsive design -->

  <!-- SEO meta tags -->
  <meta name="description" content="APEX Sport — Premium fitness and sports gear for serious athletes. Shop barbells, running shoes, apparel, recovery tools and more." />
  <meta name="keywords" content="fitness gear, sports equipment, barbells, running shoes, gym apparel, resistance bands, recovery, protein" />
  <meta name="author" content="APEX Sport — COMP3340 Group Project" />

  <!-- Open Graph meta tags for social sharing -->
  <meta property="og:title" content="APEX Sport — Premium Fitness Gear" />
  <meta property="og:description" content="Engineered for performance. Built to last." />
  <meta property="og:type" content="website" />

  <meta name="robots" content="index, follow" /> <!-- SEO robots directive -->

  <title>APEX Sport — Premium Fitness Gear</title> <!-- Page title -->

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

  <!-- External CSS -->
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>

  <!-- Navigation bar -->
  <nav>
    <div class="nav-inner">
      <a href="index.php" class="logo">APE<span>X</span></a>

      <!-- Desktop navigation links -->
      <ul class="nav-links">
        <li><a href="pages/products.html">Shop</a></li>
        <li><a href="pages/about.html">About</a></li>
        <li><a href="wiki/index.html">Help</a></li>
      </ul>

      <!-- Navigation actions -->
      <div class="nav-actions">
        <!-- Search button -->
        <button class="nav-icon-btn" onclick="toggleSearch()" aria-label="Search">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.35-4.35"/>
          </svg>
        </button>

        <!-- Cart button -->
        <button class="nav-icon-btn" onclick="toggleCart()" aria-label="Cart">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          <span class="cart-count" id="cart-count">0</span>
        </button>

        <!-- Hamburger menu button for mobile -->
        <button class="hamburger" onclick="toggleMenu()" aria-label="Open menu">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </button>

        <!-- Login button -->
        <?php if(isset($_SESSION['name'])): ?>
          <div style="display:flex; align-items:center; gap:12px;">
            <span style="font-size:13px; font-weight:600; color:var(--accent); letter-spacing:0.05em;">
              WELCOME, <?php echo strtoupper(htmlspecialchars($_SESSION['name'])); ?>!
            </span>
            <a href="pages/logout.php" style="font-size:11px; text-decoration:underline; color:var(--text-secondary); text-transform:uppercase;">
              Logout
            </a>
          </div>
        <?php else: ?>
          <a href="pages/login.php" class="nav-icon-btn" aria-label="Login">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Mobile navigation menu -->
  <div class="mobile-menu" id="mobile-menu">
    <button class="mobile-close" onclick="toggleMenu()" aria-label="Close menu">&#x2715;</button>
    <a href="pages/products.html" onclick="toggleMenu()">Shop</a>
    <a href="pages/about.html" onclick="toggleMenu()">About</a>
    <a href="wiki/index.html" onclick="toggleMenu()">Help</a>
  </div>

  <!-- Hero section -->
  <section class="hero">
    <div class="hero-text">
      <p class="hero-eyebrow">New Season 2026 Collection</p>
      <h1 class="hero-title">TRAIN<br>HARDER.<br><em>GO</em><br>FURTHER.</h1>
      <p class="hero-subtitle">
        Premium performance gear engineered for athletes who refuse to settle.
        Built to push every limit.
      </p>
      <div class="hero-ctas">
        <button class="btn-primary" onclick="window.location.href='pages/products.html'">Shop Now</button>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-inner">
      <div class="footer-top" style="display:flex; justify-content:center; gap:60px; flex-wrap:wrap;">
        <!-- Logo & Newsletter -->
        <div style="text-align:center; max-width:420px;">
          <div class="footer-logo">APE<span>X</span></div>
          <p class="footer-tagline">
            Premium fitness gear for athletes who demand more.
            Engineered for performance, built to last.
          </p>
          <form action="process_email.php" method="POST" class="newsletter-row">
  <input type="email" name="subscriber_email" class="newsletter-input"
         placeholder="Your email address" aria-label="Email for newsletter" required />
  
  <button type="submit" class="newsletter-btn">Subscribe</button>
</form>
        </div>

        <!-- Footer links -->
        <div style="display:flex; gap:48px; flex-wrap:wrap;">
          <div>
            <p style="font-size:12px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--text-secondary); margin-bottom:12px;">Shop</p>
            <p style="margin-bottom:8px;"><a href="pages/products.html" style="font-size:14px; color:var(--text-secondary);">All Products</a></p>
            <p style="margin-bottom:8px;"><a href="pages/cart.html" style="font-size:14px; color:var(--text-secondary);">Cart</a></p>
          </div>
          <div>
            <p style="font-size:12px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:var(--text-secondary); margin-bottom:12px;">Company</p>
            <p style="margin-bottom:8px;"><a href="pages/about.html" style="font-size:14px; color:var(--text-secondary);">About</a></p>
          </div>
          
        </div>
      </div>
    </div>
  </footer>

  <!-- Main JS -->
  <script src="js/main.js"></script>
</body>
</html>
