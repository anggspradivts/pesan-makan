<?php require '../components/head.php' ?>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white p-6 rounded-2xl shadow-lg w-full max-w-md">
    <div class="flex flex-col items-center">
      <!-- Foto Profil -->
      <img src="https://i.pravatar.cc/100" alt="User" class="w-24 h-24 rounded-full mb-4 shadow-md">

      <!-- Info Pengguna -->
      <h2 class="text-xl font-semibold">Nama Pengguna</h2>
      <p class="text-gray-500 mb-4">nama@email.com</p>

      <!-- Detail Tambahan -->
      <div class="w-full">
        <div class="mb-2">
          <span class="font-medium text-gray-600">Role:</span>
          <span class="text-gray-800">User</span>
        </div>
        <div class="mb-2">
          <span class="font-medium text-gray-600">Tanggal Bergabung:</span>
          <span class="text-gray-800">01 Januari 2024</span>
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="mt-6 flex gap-3">
        <a href="edit-profile.html" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit Profil</a>
        <form action="../auth/logout.php" method="POST">
          <input type="hidden" name="action" value="login">
          <button type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>

</body>