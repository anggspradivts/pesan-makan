<?php
// session_start();

class MenuController
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }
  /**
   * Menangani upload file gambar.
   * @param array $gambar_file Data dari $_FILES['gambar'].
   * @return string|null|false Mengembalikan nama file baru jika berhasil, 
   * null jika tidak ada file di-upload, 
   * false jika terjadi error.
   */
  private function handleImageUpload($gambar_file)
  {
    // Cek jika tidak ada file yang di-upload
    if (!isset($gambar_file) || $gambar_file['error'] == UPLOAD_ERR_NO_FILE) {
      return null;
    }

    // Cek error upload lainnya
    if ($gambar_file['error'] != UPLOAD_ERR_OK) {
      $_SESSION['error_message'] = "Terjadi error saat upload file.";
      return false;
    }

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uas.test/images/';
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($gambar_file["name"], PATHINFO_EXTENSION));

    // Buat nama file yang unik untuk menghindari penimpaan file
    $new_filename = uniqid('menu_', true) . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Validasi dasar
    $check = getimagesize($gambar_file["tmp_name"]);
    if ($check === false) {
      $_SESSION['error_message'] = "File yang di-upload bukan gambar.";
      return false;
    }

    if ($gambar_file["size"] > 2000000) { // Batas 2MB
      $_SESSION['error_message'] = "Ukuran file terlalu besar (maks 2MB).";
      return false;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $_SESSION['error_message'] = "Hanya format JPG, JPEG, & PNG yang diizinkan.";
      return false;
    }

    // Pindahkan file ke direktori tujuan
    if (move_uploaded_file($gambar_file["tmp_name"], $target_file)) {
      return $new_filename; // Berhasil, kembalikan nama file baru
    } else {
      $_SESSION['error_message'] = "Gagal memindahkan file yang di-upload.";
      return false;
    }
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

  /**
   * Menambahkan item menu baru ke database.
   * @param string $nama
   * @param string $deskripsi
   * @param int    $harga
   * @param string $kategori
   * @param array  $gambar_file Data dari $_FILES['gambar'].
   * @return bool True jika berhasil, false jika gagal.
   */
  public function addMenu($nama, $deskripsi, $harga, $kategori, $gambar_file)
  {
    $gambar_nama = $this->handleImageUpload($gambar_file);
    if ($gambar_nama === false) {
      return false;
    }

    $sql = "INSERT INTO menu (nama, deskripsi, harga, kategori, gambar) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssiss", $nama, $deskripsi, $harga, $kategori, $gambar_nama);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
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
  public function editMenu($id, $nama, $deskripsi, $harga, $kategori, $new_gambar_file, $old_gambar_name)
  {
    $gambar_nama_baru = $old_gambar_name;

    if (isset($new_gambar_file) && $new_gambar_file['error'] == UPLOAD_ERR_OK) {
      $uploaded_filename = $this->handleImageUpload($new_gambar_file);
      if ($uploaded_filename !== false) {
        $gambar_nama_baru = $uploaded_filename;
        if (!empty($old_gambar_name)) {
          $old_image_path = $_SERVER['DOCUMENT_ROOT'] . '/uas.test/images/' . $old_gambar_name;
          if (file_exists($old_image_path)) {
            unlink($old_image_path);
          }
        }
      } else {
        return false;
      }
    }

    $sql = "UPDATE menu SET nama = ?, deskripsi = ?, harga = ?, kategori = ?, gambar = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssissi", $nama, $deskripsi, $harga, $kategori, $gambar_nama_baru, $id);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
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
    $sql_select = "SELECT gambar FROM menu WHERE id = ?";
    $stmt_select = $this->conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $gambar_nama = null;
    if ($row = $result->fetch_assoc()) {
      $gambar_nama = $row['gambar'];
    }
    $stmt_select->close();

    // 2. Hapus record dari database
    $sql_delete = "DELETE FROM menu WHERE id = ?";
    $stmt_delete = $this->conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
      $stmt_delete->close();
      // 3. Jika record berhasil dihapus, hapus file gambarnya
      if (!empty($gambar_nama)) {
        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/uas.test/images/' . $gambar_nama;
        if (file_exists($image_path)) {
          unlink($image_path);
        }
      }
      return true;
    } else {
      $_SESSION['error_message'] = "Gagal menghapus menu: " . $stmt_delete->error;
      $stmt_delete->close();
      return false;
    }
  }
}
