<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function detect_frontend_root_path()
{
  $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
  if ($script !== '' && preg_match('#^(.*?/Frontend/)#i', $script, $m)) {
    return $m[1];
  }
  return '/';
}

if (!isset($siteRoot) || $siteRoot === '') {
  // Make navbar links absolute from Frontend root so dashboard pages
  // still open public pages correctly.
  $siteRoot = detect_frontend_root_path();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? (int) $_SESSION['role'] : -1;
$userName = $isLoggedIn && isset($_SESSION['name']) ? $_SESSION['name'] : '';
$headerSearch = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'EcoSprout Nursery'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo isset($cssPath) ? $cssPath : $siteRoot . 'assets/css/style.css'; ?>">
    <script>window.ECOSPROUT_SITE_ROOT = <?php echo json_encode($siteRoot); ?>;</script>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="<?php echo $siteRoot; ?>index.php" class="logo">EcoSprout</a>
            </div>
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="<?php echo $siteRoot; ?>index.php" class="nav-link">Home</a></li>
                <li><a href="<?php echo $siteRoot; ?>catalogue.php" class="nav-link">Plants</a></li>
                <li><a href="<?php echo $siteRoot; ?>tools.php" class="nav-link">Tools</a></li>
                <li><a href="<?php echo $siteRoot; ?>services.php" class="nav-link">Services</a></li>
                <li><a href="<?php echo $siteRoot; ?>workshops.php" class="nav-link">Workshops</a></li>
                <li><a href="<?php echo $siteRoot; ?>blog.php" class="nav-link">Blog</a></li>
                <li><a href="<?php echo $siteRoot; ?>contact.php" class="nav-link">Contact</a></li>
            </ul>
            <div class="nav-search">
                <form method="get" action="#" class="nav-search-form">
                    <input type="text" name="q" placeholder="Search plants, tools, services, workshops..." value="<?php echo htmlspecialchars($headerSearch, ENT_QUOTES, 'UTF-8'); ?>" class="nav-search-input">
                    <button type="button" id="navSearchBtn" class="nav-search-btn">Search</button>
                </form>
                <div id="navSearchSuggestions" class="nav-search-suggestions" style="display:none;"></div>
            </div>
            <div class="nav-auth">
                <button type="button" id="cartToggle" class="cart-nav-btn" aria-label="Open cart">
                    <span class="cart-icon">🛒</span>
                    <span id="cartBadge" class="cart-badge" style="display:none;">0</span>
                </button>
                <?php if ($isLoggedIn) { ?>
                    <?php if ($userRole === 2) { ?>
                    <a href="<?php echo $siteRoot; ?>admin/index.php" class="btn-auth-outline">Admin</a>
                    <?php } elseif ($userRole === 1) { ?>
                    <a href="<?php echo $siteRoot; ?>staff/index.php" class="btn-auth-outline">Staff</a>
                    <?php } else { ?>
                    <a href="<?php echo $siteRoot; ?>customer/dashboard.php" class="btn-auth-outline">My Account</a>
                    <?php } ?>
                    <a href="<?php echo $siteRoot; ?>auth/logout.php" class="btn-auth-primary">Logout</a>
                <?php } else { ?>
                    <a href="<?php echo $siteRoot; ?>auth/login.php" class="btn-auth-primary">Login</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <?php include __DIR__ . '/cart_drawer.php'; ?>
    <script>
      (function () {
        var form = document.querySelector('.nav-search-form');
        var input = document.querySelector('.nav-search-input');
        var box = document.getElementById('navSearchSuggestions');
        if (!form || !input || !box) return;

        var timer = null;
        var currentItems = [];

        function hideSuggestions() {
          box.style.display = 'none';
          box.innerHTML = '';
          currentItems = [];
        }

        function renderSuggestions(items) {
          currentItems = items || [];
          if (!currentItems.length) {
            hideSuggestions();
            return;
          }
          var html = '';
          for (var i = 0; i < currentItems.length; i++) {
            var it = currentItems[i];
            html += '<a class="nav-search-item" href="' + it.url + '">';
            html += '<img class="nav-search-item-thumb" src="' + (it.image || '') + '" alt="">';
            html += '<span class="nav-search-item-type">' + it.type + '</span>';
            html += '<span class="nav-search-item-title">' + it.title + '</span>';
            html += '</a>';
          }
          box.innerHTML = html;
          box.style.display = 'block';
        }

        function fetchSuggestions(q) {
          var url = '<?php echo $siteRoot; ?>search-suggest.php?q=' + encodeURIComponent(q);
          fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.json(); })
            .then(function (data) { renderSuggestions(data.items || []); })
            .catch(function () { hideSuggestions(); });
        }

        input.addEventListener('input', function () {
          var q = input.value.trim();
          clearTimeout(timer);
          if (q.length < 1) {
            hideSuggestions();
            return;
          }
          timer = setTimeout(function () {
            fetchSuggestions(q);
          }, 120);
        });

        document.addEventListener('click', function (e) {
          if (!box.contains(e.target) && e.target !== input) {
            hideSuggestions();
          }
        });

        input.addEventListener('keydown', function (e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            if (currentItems.length > 0) {
              window.location.href = currentItems[0].url;
            }
            return;
          }
          if (e.key === 'Escape') {
            hideSuggestions();
          }
        });

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          var q = input.value.trim();
          if (q.length >= 1) {
            fetchSuggestions(q);
          }
        });

        var searchBtn = document.getElementById('navSearchBtn');
        if (searchBtn) {
          searchBtn.addEventListener('click', function () {
            var q = input.value.trim();
            if (q.length >= 1) {
              fetchSuggestions(q);
            } else {
              hideSuggestions();
            }
          });
        }
      })();
    </script>
