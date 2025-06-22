<?php
// We assume $conn (your database connection) is available from your main dashboard layout.
// If not, you might need to include it here:
// require_once '../../database.php'; // Adjust the path if needed

// --- STEP 1: Get the Menu Item to Edit ---

// Check if an ID is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "<main class='flex-1 p-8'><div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'><strong>Error:</strong> ID menu tidak valid atau tidak ditemukan.</div></main>";
  exit; // Stop the script if no valid ID is provided
}

$id = (int)$_GET['id']; // Cast ID to an integer for security

// --- STEP 2: Fetch Existing Data from Database ---

// Use a prepared statement to prevent SQL injection
$sql = "SELECT nama, deskripsi, harga, kategori, gambar FROM menu WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
  die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "<main class='flex-1 p-8'><div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'><strong>Error:</strong> Menu dengan ID " . $id . " tidak ditemukan.</div></main>";
  $stmt->close();
  exit;
}

// Fetch the data into variables
$menu = $result->fetch_assoc();
$stmt->close();

?>

<!-- --- STEP 3: Display the HTML Form with Pre-filled Data --- -->
<main class="flex-1 p-8">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Edit Menu: <?php echo htmlspecialchars($menu['nama']); ?></h1>
    <a href="dashboard.php?page=menu" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Menu</a>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-lg">
    <!-- The form will send data to a processing script -->
    <!-- `enctype="multipart/form-data"` is ESSENTIAL for file uploads -->
    <form action="../proses/update_menu.php" method="POST" enctype="multipart/form-data" class="space-y-6">

      <!-- Hidden input to send the ID -->
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <!-- Hidden input to keep track of the old image name -->
      <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($menu['gambar']); ?>">

      <!-- Nama Menu -->
      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Menu</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($menu['nama']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Deskripsi -->
      <div>
        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo htmlspecialchars($menu['deskripsi']); ?></textarea>
      </div>

      <!-- Harga -->
      <div>
        <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($menu['harga']); ?>" placeholder="Contoh: 25000" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Kategori -->
      <div>
        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select id="kategori" name="kategori" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value="makanan" <?php if ($menu['kategori'] == 'makanan') echo 'selected'; ?>>Makanan</option>
          <option value="minuman" <?php if ($menu['kategori'] == 'minuman') echo 'selected'; ?>>Minuman</option>
        </select>
      </div>

      <!-- Gambar Menu -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
        <?php if (!empty($menu['gambar'])): ?>
          <img src="../images/<?php echo htmlspecialchars($menu['gambar']); ?>" alt="Gambar <?php echo htmlspecialchars($menu['nama']); ?>" class="mt-2 w-48 h-32 object-cover rounded-md border border-gray-300">
        <?php else: ?>
          <p class="mt-2 text-gray-500">Tidak ada gambar.</p>
        <?php endif; ?>
      </div>

      <div>
        <label for="gambar" class="block text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>
        <input type="file" id="gambar" name="gambar" class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-600
                    hover:file:bg-indigo-100">
        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
      </div>

      <!-- Tombol Submit -->
      <div class="flex justify-end">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Update Menu
        </button>
      </div>
    </form>
  </div>
</main>