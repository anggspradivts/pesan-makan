<?php ?>

<main class="flex-1 p-8 space-y-5 h-screen">
  <div class="flex justify-between items-center">
    <h1 class="text-3xl font-bold ">Tambah Menu</h1>
    <button class="border-2 font-semibold border-black p-2 rounded-lg hover:bg-slate-100">
      <a href="dashboard.php?page=menu">
        <i class="fa-solid fa-x"></i>
      </a>
    </button>
  </div>
  <div class="">
    <form class="space-y-5" action="/process/menu/add.php" method="post">
      <div>
        <label for="nama-menu" class="block text-sm font-medium">Gambar menu</label>
        <input type="file" id="nama-menu" name="nama-menu" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="id-menu" class="block text-sm font-medium">Id menu</label>
        <input type="text" id="id-menu" name="id-menu" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="nama-menu" class="block text-sm font-medium">Nama menu</label>
        <input type="text" id="nama-menu" name="nama-menu" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="harga-menu" class="block text-sm font-medium">Harga menu</label>
        <input type="number" id="harga-menu" name="harga-menu" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>
    </form>
  </div>
</main>