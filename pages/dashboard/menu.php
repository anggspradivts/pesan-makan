<?php
require_once __DIR__ . '/../../controllers/MenuController.php';
require_once __DIR__ . '/../../database.php';

$makananList = getMenu($conn, 'makanan');
$minumanList = getMenu($conn, 'minuman');
?>

<body>
  <main class="flex-1 p-8 space-y-5">
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-bold ">Manage Menu</h1>
      <button class="border font-semibold border-black p-2 rounded-lg hover:bg-slate-100">
        <a href="dashboard.php?page=add-menu">Tambahkan Menu</a>
        <i class="fa-solid fa-plus"></i>
      </button>
    </div>

    <!-- MAKANAN -->
    <h1 class="text-xl font-semibold">Makanan</h1>
    <div class="list-menu-container grid grid-cols-3 gap-2">
      <?php
      if (!empty($makananList)) {
        foreach ($makananList as $makanan) {
      ?>
          <!-- Template Kartu Menu -->
          <div class="food-card flex flex-col h-[320px] bg-white rounded-lg border border-slate-300 hover:shadow overflow-hidden transition">
            <div class="img-container w-full h-1/2">
              <img src="/assets/images/mie_portrait.jpg" alt="<?php echo htmlspecialchars($makanan['nama']); ?>" class="object-cover w-full h-full">
            </div>
            <div class="p-3 flex flex-col flex-grow">
              <div class="flex-grow">
                <h3 class="font-bold text-lg"><?php echo htmlspecialchars($makanan['nama']); ?></h3>
                <p class="text-green-600 font-semibold">Rp <?php echo number_format($makanan['harga'], 0, ',', '.'); ?></p>
              </div>
              <div class="flex w-full space-x-3 items-center mt-2">
                <a href="dashboard.php?page=edit-menu&id=<?php echo $makanan['id']; ?>" class="w-1/2 text-center p-2 bg-white border border-gray-400 rounded hover:bg-gray-100">Edit <i class="fa-solid fa-pencil"></i></a>
                <a href="../process/menu/delete.php?id=<?php echo $makanan['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus menu ini?');" class="w-1/2 text-center p-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus <i class="fa-solid fa-trash"></i></a>
              </div>
            </div>
          </div>
      <?php
        } // Akhir dari foreach
      } else {
        echo "<p class='col-span-3 text-gray-500'>Belum ada menu makanan yang ditambahkan.</p>";
      }
      ?>
    </div>

    <!-- MINUMAN -->
    <h1 class="text-xl font-semibold">Minuman</h1>
    <div class="list-menu-container grid grid-cols-3 gap-2">

      <?php
      if (!empty($minumanList)) {
        foreach ($minumanList as $minuman) {
      ?>
          <!-- Template Kartu Menu -->
          <div class="food-card flex flex-col h-[320px] bg-white rounded-lg border border-slate-300 hover:shadow overflow-hidden transition">
            <div class="img-container w-full h-1/2 overflow-hidden">
              <img src="/assets/images/mie_portrait.jpg" alt="<?php echo htmlspecialchars($minuman['nama']); ?>" class="object-cover w-full h-full">
            </div>
            <div class="p-3 flex flex-col flex-grow">
              <div class="flex-grow">
                <h3 class="font-bold text-lg"><?php echo htmlspecialchars($minuman['nama']); ?></h3>
                <p class="text-green-600 font-semibold">Rp <?php echo number_format($minuman['harga'], 0, ',', '.'); ?></p>
              </div>
              <div class="flex w-full space-x-3 items-center mt-2">
                <a href="dashboard.php?page=edit-menu&id=<?php echo $minuman['id']; ?>" class="w-1/2 text-center p-2 bg-white border border-gray-400 rounded hover:bg-gray-100">Edit <i class="fa-solid fa-pencil"></i></a>
                <a href="../proses/hapus_menu.php?id=<?php echo $minuman['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus menu ini?');" class="w-1/2 text-center p-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus <i class="fa-solid fa-trash"></i></a>
              </div>
            </div>
          </div>
      <?php
        } // Akhir dari foreach
      } else {
        echo "<p class='col-span-3 text-gray-500'>Belum ada menu minuman yang ditambahkan.</p>";
      }
      ?>
    </div>
  </main>
</body>