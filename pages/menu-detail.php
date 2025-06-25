<?php
session_start();
require_once __DIR__ . "/../controllers/MenuController.php";
require_once __DIR__ . "/../database.php";

$menuId = $_GET['id'] ?? null;

if (!$menuId) {
  die("Menu ID not provided." . gettype($menuId));
}

// get list of menu based on kategori
$menuList = [];
$menuDetail = getMenuDetail($conn, $menuId);
if ($menuDetail["kategori"] === "makanan") {
  $makananList = getMenu($conn, 'makanan');
  $menuList = $makananList;
} else {
  $minumanList = getMenu($conn, 'minuman');
  $menuList = $minumanList;
}

if (!$menuDetail) {
  die("Menu not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require "../components/head.php"; ?>

<body>
  <?php require "../components/navbar.php"; ?>

  <!-- Success Message -->
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded absolute top-0 left-0 z-[9999]">
      <?= htmlspecialchars($_SESSION['success_message']) ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
  <?php endif; ?>

  <?php if (!$menuDetail): ?>
    <div class="text-center">
      Menu not found
    </div>
  <?php else: ?>
    <!-- Left image panel -->
    <div class="h-[400px] lg:absolute lg:h-screen lg:w-[500px] bg-red-100 overflow-hidden">
      <img src="../assets/images/<?php echo htmlspecialchars($menuDetail["kategori"]) ?>/menu.jpg" alt="Menu Image" class="h-full w-full object-cover">
    </div>

    <!-- Right content panel -->
    <div class="lg:ml-[500px] p-5 space-y-6">
      <h1 class="font-semibold text-2xl"><?php echo htmlspecialchars($menuDetail["nama"]); ?></h1>
      <p><?php echo htmlspecialchars($menuDetail["deskripsi"]); ?></p>
      <p class="text-green-600 font-semibold text-lg">
        Rp <?php echo number_format($menuDetail['harga'], 0, ',', '.'); ?>
      </p>

      <!-- Quantity controls -->
      <form action="../process/cart/add.php" method="post" class="flex items-center space-x-3">
        <button class="fa-solid fa-cart-shopping rounded bg-green-600 p-3 text-white hover:bg-green-700 transition" href="#"></button>
        <button type="button" onclick="decreaseQty()" class="fa-solid fa-minus p-3 rounded border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition"></button>
        <span id="quantity" class="p-3 text-green-600 font-bold">1</span>
        <button type="button" onclick="increaseQty()" class="fa-solid fa-plus p-3 rounded border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition"></button>
        <input type="hidden" name="quantity" id="quantityInput" value="1">
        <input type="hidden" name="menu_id" value="<?= $menuDetail['id'] ?>">
      </form>

      <div class="py-10">
        <header class="text-xl font-bold py-5">Menu Lainnya</header>
        <div class="flex gap-5 w-full overflow-x-scroll">
          <!-- map each food -->
          <?php foreach (array_slice($menuList, 0, 5) as $menu): ?>
            <a class="border border-slate-400 rounded-lg" href="pages/menu-detail.php?id=<?= $menu['id'] ?>">
              <div class="h-[200px] w-[250px] flex flex-col">
                <div class="h-[80%] overflow-hidden">
                  <img src="../assets/images/<?php echo htmlspecialchars($menuDetail["kategori"]) ?>/menu.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="m-2">
                  <p class=""><?= $menu['nama'] ?></p>
                  <p class="font-semibold text-green-600 text-sm">
                    Rp <?= number_format($menu['harga'], 0, ',', '.') ?>
                  </p>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</body>
<script>
  let quantity = 1;

  function updateDisplay() {
    document.getElementById("quantity").textContent = quantity;
    document.getElementById("quantityInput").value = quantity;
  }

  function increaseQty() {
    console.log(quantity)
    quantity++;
    updateDisplay();
  }

  function decreaseQty() {
    if (quantity > 1) {
      quantity--;
      updateDisplay();
    }
  }
</script>

</html>