<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$file_url = 'https://raw.githubusercontent.com/hadiok/omhadi/main/Website%20Om%20Hadi%20Yang%20Baru%20dengan%20Tampilan%20Baru%20Juga.?token=GHSAT0AAAAAACVMF7GH7WD6MWDTWEY47YOEZVFO5BA';

// Nama pengguna dan kata sandi/token Anda
$username =  $_ENV['user']; // Token akses pribadi
$password =  $_ENV['akseskey']; // Token akses pribadi

// Inisialisasi cURL
$ch = curl_init();

// Set URL dan opsi cURL
curl_setopt($ch, CURLOPT_URL, $file_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

// Eksekusi cURL dan ambil konten
$content = curl_exec($ch);

// Periksa kesalahan cURL
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Tutup cURL
curl_close($ch);

$artikel=htmlspecialchars($content);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    html, body {
      position: relative;
      height: 100%;
    }

    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .bottom-menu {
      height: 40px;
      position: fixed;
      bottom: 0;
      width: 100%;
      z-index: 1000;
      background-color: #000000;
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
      align-items: center;
    }

    .menu-item {
      color: #fff;
      text-decoration: none;
      text-align: center;
      flex: 1;
      transition: transform 0.3s ease, background-color 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .menu-item i {
      font-size: 15px;
      margin-bottom: 5px;
    }

    .menu-item span {
      font-size: 12px;
    }

    .menu-item:hover {
      background-color: #575757;
      border-radius: 5px;
      padding: 8px;
    }

    .menu-item.clicked {
      transform: scale(1.1);
      background-color: #777;
    }

    /* Modal Styles */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 1000;
      right: 10px; /* Distance from the right */
      bottom: 70px; /* Adjust this value as needed */
      width: 250px; /* Adjust width as needed */
      animation: fadeIn 0.5s ease;
    }

    .modal-content {
      background-color: #fefefe;
      padding: 20px;
      border: 1px solid #888;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      animation: slideIn 0.5s ease;
    }

    .close-btn {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .modal-list {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .modal-list li {
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    .modal-list li a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      display: block;
    }

    .modal-list li a:hover {
      color: #007bff;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideIn {
      from { transform: translateY(-20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>

<body>
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><?php echo $artikel; ?></div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <nav class="bottom-menu">
    <a href="http://localhost/webhp.php" id="home" class="menu-item">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <a href="#search" id="search" class="menu-item">
      <i class="fas fa-search"></i>
      <span>Search</span>
    </a>
    <a href="#notifications" id="notifications" class="menu-item">
      <i class="fas fa-bell"></i>
      <span>Notifications</span>
    </a>
    <a href="#profile" id="profile" class="menu-item">
      <i class="fas fa-user"></i>
      <span>Profile</span>
    </a>
  </nav>

  <!-- Modal -->
  <div id="profile-modal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <ul class="modal-list">
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
        <li><a href="#sitemap">Sitemap</a></li>
        <li><a href="#privacy-policy">Privacy Policy</a></li>
        <li><a href="#terms">Terms and Conditions</a></li>
      </ul>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const menuItems = document.querySelectorAll('.menu-item');
      const profileMenuItem = document.getElementById('profile');
      const modal = document.getElementById('profile-modal');
      const closeBtn = document.querySelector('.close-btn');

      menuItems.forEach(item => {
        item.addEventListener('click', function(event) {
          // Remove the class from all menu items
          menuItems.forEach(el => el.classList.remove('clicked'));

          // Add the class to the clicked menu item
          this.classList.add('clicked');

          // Remove the class after animation ends
          setTimeout(() => {
            this.classList.remove('clicked');
          }, 300); // Duration must match CSS transition time

          // Prevent default link behavior only if it is not the Home link
          if (this.id !== 'home') {
            event.preventDefault();
          }
        });
      });

      // Show the modal when the profile item is clicked
      profileMenuItem.addEventListener('click', (event) => {
        event.preventDefault();
        // Position the modal relative to the profile button
        const rect = profileMenuItem.getBoundingClientRect();
        modal.style.display = 'block';
        modal.style.bottom = `${window.innerHeight - rect.top + 10}px`;
        modal.style.right = `${window.innerWidth - rect.right + 10}px`;
      });

      // Hide the modal when the close button is clicked
      closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
      });

      // Hide the modal if the user clicks outside of the modal
      window.addEventListener('click', (event) => {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });

      var swiper = new Swiper(".mySwiper", {
        direction: "vertical",
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    });
  </script>
</body>

</html>
