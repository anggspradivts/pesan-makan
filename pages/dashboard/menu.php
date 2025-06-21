<?php require_once "../database.php"; ?>
<!DOCTYPE html>
<html lang="en">

<body>
  <main class="flex-1 p-8 space-y-5">
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-bold ">Manage Menu</h1>
      <button class="border-2 font-semibold border-black p-2 rounded-lg hover:bg-slate-200">Tambahkan Menu <i class="fa-solid fa-plus"></i> </button>
    </div>
    <h1 class="text-xl font-semibold">Makanan</h1>
    <div class="list-menu-container grid grid-cols-3 gap-2">
      <?php
      $sql_makanan = "SELECT id, nama, deskripsi, harga FROM menu WHERE kategori = 'makanan'";
      $makananList = mysqli_query($conn, $sql_makanan);

      if (mysqli_num_rows($makananList) > 0) {
        while ($makanan = mysqli_fetch_assoc($makananList)) {
      ?>
          <div class="food-card flex flex-col h-[320px] bg-white rounded-lg border border-slate-300 shadow">
            <div class="img-container w-full h-1/2 overflow-hidden">
              <img src="https://placehold.co/600x400" class="object-cover w-full h-full">
            </div>
            <div class="h-1/2 p-3 flex flex-col">
              <div class="flex-grow menu-description">
                <h3 class="font-bold text-lg"><?php echo htmlspecialchars($makanan['nama']); ?></h3>
                <p class="text-green-600 font-semibold">Rp <?php echo number_format($makanan['harga'], 0, ',', '.'); ?></p>
              </div>
              <div class="h-1/3 flex w-full space-x-3 items-center">
                <a href="dashboard.php?page=edit-menu&id=<?php echo $makanan['id']; ?>" class="w-1/2 text-center p-2 bg-white border border-black rounded">Edit <i class="fa-solid fa-pencil"></i></a>
                <a href="proses/hapus_menu.php?id=<?php echo $makanan['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus menu ini?');" class="w-1/2 text-center p-2 bg-red-500 text-white rounded">Hapus <i class="fa-solid fa-trash"></i></a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p class='col-span-3 text-gray-500'>Belum ada menu makanan yang ditambahkan.</p>";
      }
      ?>
    </div>
    <h1 class="text-xl font-semibold">Minuman</h1>
    <div class="list-menu-container grid grid-cols-3 gap-2">

      <?php
      $sql_makanan = "SELECT id, nama, deskripsi, harga FROM menu WHERE kategori = 'minuman'";
      $minumanList = mysqli_query($conn, $sql_makanan);

      if (mysqli_num_rows($minumanList) > 0) {
        while ($minuman = mysqli_fetch_assoc($minumanList)) {
      ?>
          <div class="food-card flex flex-col h-[320px] bg-white rounded-lg border border-slate-300 shadow">
            <div class="img-container w-full h-1/2 overflow-hidden">
              <img src="https://placehold.co/600x400" class="object-cover w-full h-full">
            </div>
            <div class="h-1/2 p-3 flex flex-col">
              <div class="flex-grow menu-description">
                <h3 class="font-bold text-lg"><?php echo htmlspecialchars($minuman['nama']); ?></h3>
                <p class="text-green-600 font-semibold">Rp <?php echo number_format($minuman['harga'], 0, ',', '.'); ?></p>
              </div>
              <div class="h-1/3 flex w-full space-x-3 items-center">
                <a href="dashboard.php?page=edit-menu&id=<?php echo $minuman['id']; ?>" class="w-1/2 text-center p-2 bg-white border border-black rounded">Edit <i class="fa-solid fa-pencil"></i></a>
                <a href="proses/hapus_menu.php?id=<?php echo $minuman['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus menu ini?');" class="w-1/2 text-center p-2 bg-red-500 text-white rounded">Hapus <i class="fa-solid fa-trash"></i></a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p class='col-span-3 text-gray-500'>Belum ada menu makanan yang ditambahkan.</p>";
      }
      ?>
    </div>
  </main>
</body>

</html>