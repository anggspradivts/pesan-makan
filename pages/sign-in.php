<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php 
require '../components/head.php'; 
if (isset($_SESSION['user']) && $_SESSION['user']['nama']) {
  header("Location: http://uas.test/pages/profile.php");
};
?>

<body class="bg-gray-100">
  <!-- Header Section -->
  <div class="relative">
    <div class="relative bg-cover bg-center h-[300px]" style="background-image: url('../assets/images/mie_portrait.jpg')">
      <!-- Backdrop Blur Overlay -->
      <div class="backdrop-blur-sm w-full h-full">
        <!-- Navbar -->
        <nav class="flex justify-between items-center h-14 px-12 text-white">
          <div class="text-lg font-semibold">
            <a href="/">PesanMakan</a>
          </div>
          <div class="space-x-4">
            <a href="index.php?page=about" class="hover:underline">About</a>
            <a href="index.php?page=contact" class="hover:underline">Contact</a>
            <?php echo isset($_SESSION['user']['nama'])
              ? '<a href="http://uas.test/pages/dashboard.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500">' . htmlspecialchars($_SESSION['nama']) . '</a>'
              : '<a href="http://uas.test/pages/sign-in.php" class="px-4 py-1 rounded-full bg-blue-600 hover:bg-blue-500">Login</a>';
            ?>
          </div>
        </nav>
      </div>
    </div>

    <!-- Login Card Floating Overlap -->
    <div class="flex justify-center -mt-24 z-10 relative">
      <div class="h-[500px] bg-white rounded-lg shadow-lg w-[350px] p-6">
        <h2 class="text-xl font-bold text-center mb-4">Login</h2>

        <?php
        if (isset($_SESSION['error_message'])) {
          echo '<p class="text-center text-red-500 text-sm mb-2">' . $_SESSION['error_message'] . '</p>';
          unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
          echo '<p class="text-center text-green-500 text-sm mb-2">' . $_SESSION['success_message'] . '</p>';
          unset($_SESSION['success_message']);
        }
        ?>

        <form action="../process/auth/sign-in.php" method="POST" class="flex flex-col justify-between space-y-5">
          <div class="space-y-5">
            <input type="hidden" name="action" value="login">
            <div>
              <label for="username" class="block text-sm font-medium">Username</label>
              <input type="text" id="username" name="username" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
              <label for="password" class="block text-sm font-medium">Password</label>
              <input type="password" id="password" name="password" required class="w-full border border-black border-3 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
          </div>
          <button type="submit" class="w-full bg-black text-white font-semibold mt-8 py-3 rounded-full">Login</button>
        </form>
        <p class="text-sm text-center mt-4">Belum punya akun? <a href="sign-up.php" class="text-blue-600 hover:underline">Daftar di sini</a>.</p>
      </div>
    </div>
  </div>
</body>


</html>