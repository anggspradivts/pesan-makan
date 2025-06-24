<?php
session_start();
require './data.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php require './components/head.php'; ?>

<body>
  <!-- HERO SECTION -->
  <?php require './components/hero.php' ?>
  <!-- HERO SECTION -->


  <!-- MAKANAN PILIHAN -->
  <div class="text-center py-10">
    <header class="text-xl font-bold py-5">Makanan Favorit</header>
    <div class="flex justify-center gap-5 w-full">
      <!-- map each food -->
      <?php foreach (array_slice($data, 0, 3) as $food): ?>
        <a href="pages/menu-detail.php?id=<?= $food['id'] ?>" class="transition-transform duration-300 hover:-translate-y-2">
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