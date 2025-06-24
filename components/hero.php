<div class="relative bg-cover bg-center h-[500px]" style="background-image: url('../assets/images/mie_portrait.jpg')">
  <!-- Backdrop Blur Overlay -->
  <div class="backdrop-blur-sm w-full h-full">
    <!-- Navbar -->
    <nav class="flex justify-between items-center h-14 px-12 text-white">
      <div class="text-lg font-semibold">
        <a href="index.php">PesanMakan</a>
      </div>
      <div class="space-x-4">
        <a href="index.php?page=about" class="hover:underline">About</a>
        <a href="index.php?page=contact" class="hover:underline">Contact</a>
        <?php echo isset($_SESSION['user']['nama'])
          ? '<a href="http://uas.test/pages/dashboard.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500" href="http://example.com/profile">' . htmlspecialchars($_SESSION['user']['nama']) . '</a>'
          : '<a href="http://uas.test/pages/sign-in.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500">Login</a>';
        ?>
      </div>
    </nav>

    <!-- Search Section -->
    <div class="flex items-center justify-center h-[400px] text-white">
      <div class="flex flex-col items-center gap-10 text-center">
        <h1 class="text-xl font-semibold">Temukan Makanan Favoritmu</h1>
        <div class="w-[400px] h-[40px] bg-white rounded-full px-4 flex items-center">
          <input type="search" name="makanan" id="makanan" placeholder="Cari makanan..."
            class="w-full border-none outline-none text-black placeholder-gray-500" />
        </div>
      </div>
    </div>
  </div>
</div>