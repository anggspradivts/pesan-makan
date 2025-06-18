<?php
session_start();
require '../data.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php require '../components/head.php'; ?>
<body>
  <!-- NAVBAR SECTION -->
  <div class="relative bg-cover bg-center h-[500px]" style="background-image: url('../assets/images/mie_portrait.jpg')">
    <!-- Backdrop Blur Overlay -->
    <div class="backdrop-blur-sm w-full h-full">
      <!-- Navbar -->
      <nav class="flex justify-between items-center h-14 px-12 text-white">
        <div class="text-lg font-semibold">
          <a href="index.php?page=home">PesanMakan</a>
        </div>
        <div class="space-x-4">
          <a href="index.php?page=about" class="hover:underline">About</a>
          <a href="index.php?page=contact" class="hover:underline">Contact</a>
          <?php echo isset($_SESSION['username'])
            ? '<a href="http://uas.test/pages/dashboard.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500" href="http://example.com/profile">' . htmlspecialchars($_SESSION['username']) . '</a>'
            : '<a href="http://uas.test/pages/sign-in.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500">Login</a>';
          ?>
        </div>
      </nav>

      <!-- Search Section -->
      <div class="flex items-center justify-center h-[400px] text-white">
        <div class="flex flex-col items-center gap-10 text-center">
          <h1 class="text-xl font-semibold">Temukan Makanan Favoritmu</h1>
          <div class="w-[400px] h-[40px] bg-white rounded-lg px-4 flex items-center">
            <input type="search" name="makanan" id="makanan" placeholder="Cari makanan..."
              class="w-full border-none outline-none text-black placeholder-gray-500" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- NAVBAR SECTION -->


  <!-- MAKANAN PILIHAN -->
  <div class="text-center py-10">
    <header class="text-xl font-bold py-5">Makanan Favorit</header>
    <div class="flex justify-center gap-5 w-full">
      <!-- map each food -->
      <?php foreach (array_slice($data, 0, 3) as $food): ?>
        <a href="index.php?page=makanan/<?= $food['id'] ?>" class="transition-transform duration-300 hover:-translate-y-2">
          <div class="h-[200px] w-[150px] flex flex-col">
            <div class="h-[80%] rounded-lg overflow-hidden">
              <img src="../assets/images/mie_portrait.jpg" alt="" class="w-full h-full object-cover" />
            </div>
            <p class="mt-2"><?= $food['name'] ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- MAKANAN PILIHAN -->
</body>

</html>