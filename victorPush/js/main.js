const products = [
  { id: 1, name: "Dumbbell Set", category: "Strength", price: 399, option: "5-50 lbs", img: "images/dumbell.png" },
  { id: 2, name: "Kettlebell Set", category: "Strength", price: 120, option: "5-50 lbs", img: "images/kettle.png" },
  { id: 3, name: "Ergonomic Barbell Pad", category: "Strength", price: 35, option: "Anti-slip with straps", img: "images/barbellPads.png" },
  { id: 4, name: "Leather Lever Belt", category: "Strength", price: 120, option: "Heavy-duty", img: "images/liftingBelt.png" },
  { id: 5, name: "Heavy-Duty Wrist Wraps", category: "Strength", price: 35, option: "Thumb loop + reinforced stitching", img: "images/wristWraps.png" },
  { id: 6, name: "Padded Neoprene Lifting Straps", category: "Strength", price: 30, option: "Neoprene padded", img: "images/liftingStrap.png" },
  { id: 7, name: "Grip Trainer", category: "Strength", price: 45, option: "Adjustable resistance levels", img: "images/gripStrengtheners.png" },
  { id: 8, name: "Weighted Steel Cable Jump Rope", category: "Cardio", price: 45, option: "Steel cable", img: "images/jumpRopes.png" },
  { id: 9, name: "Adjustable Agility Ladder", category: "Cardio", price: 75, option: "6 ft long", img: "images/agilityLadder.png" },
  { id: 10, name: "Resistance Parachute", category: "Cardio", price: 70, option: "Adjustable belt", img: "images/parachute.png" },
  { id: 11, name: "Textured Deep-Tissue Roller", category: "Recovery", price: 60, option: "Deep-tissue", img: "images/foamRollers.png" },
  { id: 12, name: "Spiky Massage Ball Set", category: "Recovery", price: 30, option: "Multiple sizes", img: "images/massageBalls.png" },
  { id: 13, name: "Multi-Loop Stretch Strap", category: "Recovery", price: 35, option: "Physio-style stretching", img: "images/stretchingStraps.png" },
  { id: 14, name: "Full Resistance Band Kit", category: "Strength", price: 80, option: "Handles, door anchor, multiple bands", img: "images/resistanceBands.png" },
  { id: 15, name: "Full-Size Massage Gun", category: "Recovery", price: 250, option: "Attachments + high torque", img: "images/massageGun.png" },
  { id: 16, name: "Extra-Thick Premium Yoga Mat", category: "Recovery", price: 90, option: "Non-slip premium", img: "images/yogaMat.png" },
  { id: 17, name: "Metal Ergonomic Push-Up Bars", category: "Strength", price: 60, option: "Rotating grips", img: "images/pushUpBar.png" },
  { id: 18, name: "Ab Roller", category: "Strength", price: 50, option: "Resistance assist", img: "images/abRoller.png" },
  { id: 19, name: "Padded Wrist-Support Lifting Gloves", category: "Strength", price: 50, option: "Wrist-support", img: "images/gloves.png" },
  { id: 20, name: "Plastic Shaker Cup", category: "Accessories", price: 40, option: "Keeps drinks cold", img: "images/shaker.png" }
];

let cart = JSON.parse(localStorage.getItem("apexCart")) || [];

function saveCart() {
  localStorage.setItem("apexCart", JSON.stringify(cart));
  updateCartCount();
}

function updateCartCount() {
  const els = document.querySelectorAll("#cart-count, .cart-count-indicator");
  const total = cart.reduce((sum, item) => sum + item.qty, 0);
  els.forEach(el => { el.textContent = total; });
}

function addToCart(productId, qty) {
  qty = qty || 1;
  const product = products.find(p => p.id === productId);
  if (!product) return;
  const existing = cart.find(item => item.id === productId);
  if (existing) {
    existing.qty += qty;
  } else {
    cart.push({ id: product.id, name: product.name, price: product.price, qty: qty, img: product.img });
  }
  saveCart();
  showToast(product.name + " added to cart");
}

function removeFromCart(productId) {
  cart = cart.filter(item => item.id !== productId);
  saveCart();
}

function updateQty(productId, qty) {
  const item = cart.find(i => i.id === productId);
  if (item) {
    item.qty = Math.max(1, qty);
    saveCart();
  }
}

function getCartTotal() {
  return cart.reduce((sum, item) => sum + item.price * item.qty, 0);
}

function toggleMenu() {
  var menu = document.getElementById("mobile-menu");
  if (menu) menu.classList.toggle("open");
}

function toggleSearch() {
  var overlay = document.getElementById("search-overlay");
  if (overlay) {
    overlay.classList.toggle("active");
    if (overlay.classList.contains("active")) {
      setTimeout(function() { var inp = overlay.querySelector("input"); if (inp) inp.focus(); }, 100);
    }
  }
}

function toggleCart() {
  window.location.href = getBasePath() + "pages/cart.html";
}

function getBasePath() {
  var path = window.location.pathname;
  if (path.includes("/pages/products/")) return "../../";
  if (path.includes("/pages/") || path.includes("/wiki/")) return "../";
  return "";
}

function showToast(message) {
  var toast = document.getElementById("toast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "toast";
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.classList.add("show");
  setTimeout(function() { toast.classList.remove("show"); }, 2200);
}

function renderProducts(containerId, list) {
  var container = document.getElementById(containerId);
  if (!container) return;

  container.innerHTML = "";

  list.forEach(function(p) {
    var card = document.createElement("a");
    card.href = getBasePath() + "pages/products/product-" + p.id + ".html";
    card.className = "product-card";

    card.innerHTML =
      '<div class="product-img">' +
        '<img src="' + getBasePath() + p.img + '" alt="' + p.name + '">' +
      '</div>' +
      '<div class="product-info">' +
        '<span class="product-category">' + p.category + '</span>' +
        '<h3>' + p.name + '</h3>' +
        '<p class="product-option">' + p.option + '</p>' +
        '<span class="product-price">$' + p.price + '</span>' +
      '</div>';

    container.appendChild(card);
  });
}

function filterProducts(category) {
  var filtered = category === "All" ? products : products.filter(function(p) { return p.category === category; });
  renderProducts("product-grid", filtered);
  document.querySelectorAll(".filter-btn").forEach(function(btn) {
    btn.classList.toggle("active", btn.dataset.category === category);
  });
}

function searchProducts(query) {
  var q = query.toLowerCase().trim();
  if (!q) return products;
  return products.filter(function(p) {
    return p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q) || p.option.toLowerCase().includes(q);
  });
}

function setTheme(theme) {
  document.documentElement.setAttribute("data-theme", theme);
  localStorage.setItem("apexTheme", theme);
  document.querySelectorAll(".theme-btn").forEach(function(btn) {
    btn.classList.toggle("active", btn.dataset.theme === theme);
  });
}

function loadTheme() {
  var saved = localStorage.getItem("apexTheme") || "";
  setTheme(saved);
}

function initSearch() {
  if (document.getElementById("search-overlay")) return;
  var overlay = document.createElement("div");
  overlay.id = "search-overlay";
  overlay.className = "search-overlay";
  overlay.innerHTML =
    '<div class="search-box">' +
      '<input type="text" id="search-input" placeholder="Search products..." aria-label="Search products" />' +
      '<button onclick="toggleSearch()" aria-label="Close search">&times;</button>' +
    '</div>' +
    '<div class="search-results" id="search-results"></div>';
  document.body.appendChild(overlay);

  document.getElementById("search-input").addEventListener("input", function() {
    var results = searchProducts(this.value);
    var container = document.getElementById("search-results");
    if (!this.value.trim()) { container.innerHTML = ""; return; }
    container.innerHTML = results.map(function(p) {
      return '<a href="' + getBasePath() + 'pages/products/product-' + p.id + '.html" class="search-result-item">' +
        '<span class="search-result-name">' + p.name + '</span>' +
        '<span class="search-result-price">$' + p.price + '</span>' +
      '</a>';
    }).join("");
  });
}

document.addEventListener("DOMContentLoaded", function() {
  loadTheme();
  updateCartCount();
  initSearch();
});
