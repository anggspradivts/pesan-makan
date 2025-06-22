<?php
// session_start();

class MenuController
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getMenu($kategori)
  {
    // 1. SQL aman menggunakan placeholder (?)
    $sql = "SELECT id, nama, harga, kategori FROM menu WHERE kategori = ?";

    $stmt = $this->conn->prepare($sql);

    // 2. Mengikat parameter dengan aman (mencegah injection)
    $stmt->bind_param("s", $kategori);

    // 3. Menjalankan query
    $stmt->execute();

    // 4. Mengambil hasil query
    $result = $stmt->get_result();

    // 5. Mengubah hasil menjadi array
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    // 6. Mengembalikan array yang berisi data, BUKAN statement
    return $data;
  }

  public function getMenuDetail($idMenu) {
    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $idMenu);
    $stmt->execute();
    $result = $stmt->get_result();
    $menu = $result->fetch_assoc();

    if ($menu) {
      $stmt->close();
      return $menu;
    } else {
      return null;
    }
  }

  /**
   * Menambahkan item menu baru ke database.
   * @param string $nama
   * @param string $deskripsi
   * @param int    $harga
   * @param string $kategori
   * @param array  $gambar_file Data dari $_FILES['gambar'].
   * @return bool True jika berhasil, false jika gagal.
   */
  public function addMenu($nama, $deskripsi, $harga, $kategori)
  {
    $sql = "INSERT INTO menu (nama, deskripsi, harga, kategori) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssis", $nama, $deskripsi, $harga, $kategori);

    if ($stmt->execute()) {
      $stmt->close();
      header('Location: http://uas.test/pages/dashboard.php?page=menu');
    } else {
      $_SESSION['error_message'] = "Gagal menambahkan menu ke database: " . $stmt->error;
      $stmt->close();
      return false;
    }
  }

  /**
   * Mengedit item menu yang sudah ada.
   * @param int    $id
   * @param string $nama
   * @param string $deskripsi
   * @param int    $harga
   * @param string $kategori
   * @param array  $new_gambar_file Data $_FILES['gambar'] yang baru.
   * @param string $old_gambar_name Nama file gambar lama untuk dihapus jika ada yg baru.
   * @return bool True jika berhasil, false jika gagal.
   */
  public function editMenu($nama, $deskripsi, $harga, $kategori, $id)
  {
    $sql = "UPDATE menu SET nama = ?, deskripsi = ?, harga = ?, kategori = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssisi", $nama, $deskripsi, $harga, $kategori, $id);

    if ($stmt->execute()) {
      $stmt->close();
      header('Location: http://uas.test/pages/dashboard.php?page=menu');
    } else {
      $_SESSION['error_message'] = "Gagal mengupdate menu: " . $stmt->error;
      $stmt->close();
      return false;
    }
  }

  /**
   * Menghapus item menu dari database beserta file gambarnya.
   * @param int $id ID menu yang akan dihapus.
   * @return bool True jika berhasil, false jika gagal.
   */
  public function deleteMenu($id)
  {
    // 1. Ambil nama file gambar dari database sebelum record dihapus
    // $sql_select = "SELECT gambar FROM menu WHERE id = ?";
    // $stmt_select = $this->conn->prepare($sql_select);
    // $stmt_select->bind_param("i", $id);
    // $stmt_select->execute();
    // $result = $stmt_select->get_result();
    // $gambar_nama = null;
    // if ($row = $result->fetch_assoc()) {
    //   $gambar_nama = $row['gambar'];
    // }
    // $stmt_select->close();

    // 2. Hapus record dari database
    $sql_delete = "DELETE FROM menu WHERE id = ?";
    $stmt_delete = $this->conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
      $stmt_delete->close();
      // 3. Jika record berhasil dihapus, hapus file gambarnya
      // if (!empty($gambar_nama)) {
      //   $image_path = $_SERVER['DOCUMENT_ROOT'] . '/uas.test/images/' . $gambar_nama;
      //   if (file_exists($image_path)) {
      //     unlink($image_path);
      //   }
      // }
      header('Location: http://uas.test/pages/dashboard.php?page=menu');
    } else {
      $_SESSION['error_message'] = "Gagal menghapus menu: " . $stmt_delete->error;
      $stmt_delete->close();
      return false;
    }
  }
}
