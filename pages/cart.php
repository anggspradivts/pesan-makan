<?php
require_once __DIR__ . "/../controllers/CartController.php";
require_once __DIR__ . "/../database.php";
if (!isset($_SESSION['user'])) {
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$cartItems = getCartItems($conn, $userId);

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['harga'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require "../components/head.php"; ?>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="max-w-4xl mx-auto pt-20 px-4 sm:px-6 lg:px-8">
        <!-- Cart Items -->
        <?php if (empty($cartItems)): ?>
            <div class="text-center text-gray-500">
                <p>No items in your cart.</p>
                <a href="/index.php" class="text-blue-600 hover:underline mt-4 block">Cari makanan</a>
            </div>
        <?php else: ?>
            <h1 class="text-3xl font-bold mb-8">Checkout Sekarang!</h1>
            <div class="space-y-6">
                <?php foreach ($cartItems as $item): ?>
                    <div class="flex items-center justify-between bg-white rounded shadow p-4">
                        <div>
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($item['nama']) ?></h2>
                            <!-- Form to update quantity -->
                            <form method="POST" action="../process/cart/edit.php" class="flex items-center space-x-2 mt-1">
                                <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                                <button name="operation_method" value="increase" type="submit" class="fa-solid fa-plus p-3 rounded border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition"></button>
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="w-16 px-2 py-1 active:border-none rounded text-green-600 font-semibold" readonly>
                                <button name="operation_method" value="decrease" type="submit" class="fa-solid fa-minus p-3 rounded border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition"></button>
                            </form>
                        </div>

                        <div class="text-right">
                            <p class="text-lg font-semibold text-green-600">
                                Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?>
                            </p>

                            <!-- Remove button -->
                            <form method="POST" action="/process/cart/delete.php">
                                <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                                <button class="fa-solid fa-trash border-b border-red-500 text-sm text-red-500 hover:underline mt-1 text-xl"></button>
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <form class="mt-8 flex justify-between" action="/process/orders/add.php" method="post">
                <div class="text-green-600 font-semibold">
                    <p>Total: </p>
                    <p>Rp. <?= number_format($totalPrice, 0, ',', '.') ?></p>
                    <input type="hidden" name="total_price" value='<?= $totalPrice ?>'>
                    <input type="hidden" name="cart_items" value='<?= json_encode($cartItems) ?>'> <!-- has to be one quote not double quote -->
                </div>
                <button type="submit" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow">
                    Bayar
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>