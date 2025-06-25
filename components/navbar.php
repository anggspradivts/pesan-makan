<nav class="flex justify-between items-center h-14 px-12 bg-black text-white">
    <div class="text-lg font-semibold">
        <a href="/">PesanMakan</a>
    </div>
    <div class="space-x-4">
        <a href="index.php?page=about" class="hover:underline">About</a>
        <a href="index.php?page=contact" class="hover:underline">Contact</a>
        <?php echo isset($_SESSION['user']['nama'])
            ? '<a href="http://uas.test/pages/dashboard.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500" href="http://example.com/profile">' . htmlspecialchars($_SESSION['user']['nama']) . '</a>'
            : '<a href="http://uas.test/pages/sign-in.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500">Login</a>';
        ?>
        <a href="../pages/cart.php" class="fa-solid fa-cart-shopping"></a>
    </div>
</nav>