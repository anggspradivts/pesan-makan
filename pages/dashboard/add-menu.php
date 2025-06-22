<main class="flex-1 p-8 space-y-5 h-screen">
  <div class="flex justify-between items-center">
    <h1 class="text-3xl font-bold ">Tambah Menu</h1>
  </div>
  <div class="">
    <form class="space-y-5" action="/process/menu/add.php" method="post">
      <div>
        <label for="gambar-menu" class="flex flex-col justify-center items-center w-full h-[70px] cursor-pointer px-4 py-2 bg-slate-400 text-white rounded hover:bg-slate-700 transition">
          <i class="fa-solid fa-image text-2xl"></i>
          <p class="text-sm">Upload Gambar</p>
        </label>
        <input type="file" id="gambar-menu" name="gambar-menu" accept="image/*" hidden>
        <p id="file-name" class="text-xs text-gray-600 mt-2"></p>
      </div>
      <div>
        <label for="nama-menu" class="block text-sm font-medium">Nama menu</label>
        <input type="text" id="nama-menu" name="nama-menu" required placeholder="Mie Ayam" class="w-full border border-slate-400 shadow rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-slate-400">
      </div>
      <div>
        <label for="harga-menu" class="block text-sm font-medium">Harga menu</label>
        <input type="number" id="harga-menu" name="harga-menu" required placeholder="100000" class="w-full border border-slate-400 shadow rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-slate-400">
      </div>
      <div>
        <label for="kategori-menu" class="block text-sm font-medium">Kategori menu</label>
        <select type="number" id="kategori-menu" name="kategori-menu" required placeholder="100000" class="w-full border border-slate-400 shadow rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-slate-400">
          <option value="" disabled selected>Pilih kategori</option>
          <option value="Makanan">Makanan</option>
          <option value="Minuman">Minuman</option>
        </select>
      </div>
      <div>
        <label for="deskripsi-menu" class="block text-sm font-medium">Deskripsi menu</label>
        <textarea id="deskripsi-menu" name="deskripsi-menu" required placeholder="Deskripsi"
          class="w-full border border-slate-400 shadow rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-slate-400"
          rows="4"></textarea>
      </div>
      <div class="flex space-x-4">
        <button type="submit" onclick="return confirm('Yakin untuk menyimpan?');" class="w-1/2 text-center p-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
          Simpan <i class="fa-solid fa-check"></i>
        </button>
        <a href="dashboard.php?page=menu" onclick="return confirm('Anda yakin?');" class="w-1/2 text-center p-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
          Batalkan <i class="fa-solid fa-x"></i>
        </a>
      </div>
    </form>
  </div>
</main>