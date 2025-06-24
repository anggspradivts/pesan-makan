<?php
session_start();
require_once __DIR__ . "/../controllers/MenuController.php";
require_once __DIR__ . "/../database.php";

$menuId = $_GET['id'] ?? null;

$menu = new MenuController($conn);

if (!$menuId) {
  die("Menu ID not provided.");
}

$menuDetail = $menu->getMenuDetail($menuId);

if (!$menuDetail) {
  die("Menu not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require "../components/head.php"; ?>

<body>
  <?php require "../components/navbar.php"; ?>

  <!-- Left image panel -->
  <div class="h-[400px] lg:absolute lg:h-screen lg:w-[500px] bg-red-100 overflow-hidden">
    <img src="../assets/images/mie_portrait.jpg" alt="Menu Image" class="h-full w-full object-cover">
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
      <input type="hidden" name="user_id" value="<?= $menuDetail['id'] ?>">
    </form>
  </div>
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