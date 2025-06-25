<?php
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/OrderController.php";

$orders = getAdminOrders($conn);
?>
<main class="container mx-auto p-8 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan Yang Masih Di Proses</h1>

    <?php if (count($orders) > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">User ID</th>
                        <th class="px-4 py-2 text-left">Total Harga</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <?php if ($order['status_pesanan'] === 'diproses'): ?>
                            <tr class="border-t border-gray-200 h-[80px] hover:bg-gray-50">
                                <td class="px-4 py-2"><?= $index + 1 ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($order['user_id']) ?></td>
                                <td class="px-4 py-2">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                                <td class="px-4 py-2">
                                    <?= htmlspecialchars($order['status_pesanan']) ?>
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($order['tanggal_pesan']) ?></td>
                                <td>
                                    <form method="POST" action="/process/orders/edit.php">
                                        <button
                                            type="submit"
                                            name="status_pesanan"
                                            value="selesaikan"
                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                            Selesaikan
                                        </button>
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Tidak ada pesanan yang ditemukan.</p>
    <?php endif; ?>
</main>