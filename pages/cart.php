<?php
require_once __DIR__ . "/../controllers/CartController.php";
require_once __DIR__ . "/../database.php";
if (!isset($_SESSION['user'])) {
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$cartItems = getCartItems($conn, $userId);
?>
<!DOCTYPE html>
<html lang="en">
<?php require "../components/head.php"; ?>

<body>
    <?php require "../components/navbar.php"; ?>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Checkout Sekarang!</h1>

        <!-- Cart Items -->
        <?php if (empty($cartItems)): ?>
            <div class="text-center text-gray-500">
                <p>No items in your cart.</p>
                <a href="/index.php" class="text-blue-600 hover:underline mt-4 block">Go shopping</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($cartItems as $item): ?>
                    <div class="flex items-center justify-between bg-white rounded shadow p-4">
                        <div>
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($item['nama']) ?></h2>
                            <p class="text-sm text-gray-600"><?= htmlspecialchars($item['quantity']) ?> pcs</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-green-600">
                                Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?>
                            </p>
                            <!-- Optional remove button -->
                            <form method="POST" action="remove-cart.php">
                                <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                                <button class="text-sm text-red-500 hover:underline">Remove</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="/checkout.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow">
                    Proceed to Checkout
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>