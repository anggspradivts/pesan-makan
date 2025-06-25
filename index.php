<?php
session_start();
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/controllers/MenuController.php";
$makananList = getMenu($conn, 'makanan');
$minumanList = getMenu($conn, 'minuman');
?>
<!DOCTYPE html>
<html lang="en">
<?php require './components/head.php'; ?>

<body>
  <!-- HERO SECTION -->
  <?php require './components/hero.php' ?>
  <!-- HERO SECTION -->

  <!-- MAKANAN PILIHAN -->
  <section class="bg-white py-16 px-6 md:px-20" id="about">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-3xl font-bold mb-4">Tentang PesanMakan</h2>
      <p class="text-gray-600">
        PesanMakan adalah solusi praktis untuk menikmati makanan favorit Anda. Kami menyajikan beragam pilihan menu khas Indonesia, dibuat dengan bahan segar dan diantar langsung ke pintu rumah Anda.
      </p>
    </div>
  </section>

  <!-- MAKANAN PILIHAN -->
  <div class="px-10 md:px-40 py-10">
    <header class="text-xl font-bold py-5">Makanan Favorit</header>
    <div class="flex gap-5 w-full overflow-x-scroll">
      <!-- map each food -->
      <?php foreach (array_slice($makananList, 0, 5) as $makanan): ?>
        <a class="border border-slate-400 rounded-lg" href="pages/menu-detail.php?id=<?= $makanan['id'] ?>">
          <div class="h-[200px] w-[250px] flex flex-col">
            <div class="h-[80%] overflow-hidden">
              <img src="../assets/images/mie_portrait.jpg" alt="" class="w-full h-full object-cover" />
            </div>
            <div class="m-2">
              <p class=""><?= $makanan['nama'] ?></p>
              <p class="font-semibold text-green-600 text-sm">
                Rp <?= number_format($makanan['harga'], 0, ',', '.') ?>
              </p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>



  <section class="bg-white py-16 px-6 md:px-20" id="testimonials">
    <div class="max-w-5xl mx-auto">
      <h2 class="text-3xl font-bold text-center mb-10">Apa Kata Pelanggan</h2>
      <div class="space-y-6">
        <div class="bg-gray-100 p-6 rounded-lg shadow">
          <p class="text-gray-700 italic">"Makanannya enak banget, pengantaran cepat, dan pelayanannya ramah!"</p>
          <p class="text-sm text-right font-semibold mt-2">– Rina, Jakarta</p>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow">
          <p class="text-gray-700 italic">"PesanMakan selalu jadi andalan saya saat sibuk di kantor. Recommended!"</p>
          <p class="text-sm text-right font-semibold mt-2">– Budi, Bandung</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-green-600 py-16 text-white text-center" id="cta">
    <h2 class="text-3xl font-bold mb-4">Siap Makan Enak Hari Ini?</h2>
    <p class="mb-6">Pesan makanan favoritmu sekarang hanya dengan beberapa klik!</p>
    <a href="/pages/menu.php" class="inline-block bg-white text-green-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">Lihat Menu</a>
  </section>

</body>

</html>