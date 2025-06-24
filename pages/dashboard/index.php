  <?php
  // Pastikan user sudah login dan adalah admin

  if (isset($_SESSION['user']) && isset($_SESSION['user']['nama'])) {
    if ($_SESSION['user']['role'] !== 'admin') {
      header("Location: http://uas.test/pages/profile.php");
      exit();
    }
  } else {
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <?php require '../components/head.php' ?>
  <body class="">
    <!-- Main content -->
    <main class="flex-1 p-8">
      <!-- Top bar -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <div class="text-gray-600">Welcome, <span class="font-semibold text-black"><?php echo htmlspecialchars($_SESSION['user']['nama']) ?></span></div>
      </div>
      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-semibold mb-2">Total Users</h2>
          <p class="text-2xl">123</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-semibold mb-2">Orders Today</h2>
          <p class="text-2xl">34</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-semibold mb-2">Revenue</h2>
          <p class="text-2xl">$1,200</p>
        </div>
      </div>
    </main>
  </body>

  </html>