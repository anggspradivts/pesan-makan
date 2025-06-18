<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['plus'])) {
    $_SESSION['amount']++;
  } elseif (isset($_POST['minus']) && $_SESSION['amount'] > 0) {
    $_SESSION['amount']--;
  }
  // Redirect to avoid form resubmission
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/menu-detail.css">
  <title>Daftar Menu Makanan</title>
</head>

<body>
  <?php
  include 'database.php';
  $result = mysqli_query($conn, "SELECT * FROM menu_makanan WHERE id_menu = $makanan_id");
  if (mysqli_num_rows($result) > 0): ?>
    <div class="menu-container">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="menu-card">
          <h2 style="text-align: center;"><?php echo htmlspecialchars($row['nama_menu']); ?></h2>
          <div style="display: flex; justify-content: space-between;" class="">
            <div>
              <p>Harga:</p>
              <p>Deskripsi:</p>
              <p>Total:</p>
            </div>
            <div>
              <p>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
              <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
              <p>Rp <?php echo number_format($row['harga'] * $_SESSION['amount'], 0, ',', '.'); ?></p>
            </div>
          </div>
          <div>
            <p>Porsi: <?= $_SESSION['amount'] ?? 0 ?></p>
            <div style="display: flex; justify-content: space-between;">
              <form class="porsi-form" method="post">
                <button type="submit" name="minus">-</button>
                <button type="submit" name="plus">+</button>
              </form>
              <form method="post" action="keranjang.php" style="display:inline;">
                <input type="hidden" name="nama_menu" value="<?= htmlspecialchars($nama_menu) ?>">
                <input type="hidden" name="pemesan" value="<?= htmlspecialchars($pemesan) ?>">
                <input type="hidden" name="harga_satuan" value="<?= $harga_satuan ?>">
                <input type="hidden" name="total_harga" value="<?= $total_harga ?>">
                <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
                <button style="padding: 7px; border-radius: 999px; background-color: green; color: white;" type="submit" name="add_to_cart">Masukan ke Keranjang</button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p>Tidak ada menu tersedia.</p>
  <?php endif; ?>
</body>

</html>