<?php
// Kết nối database
include_once __DIR__ . '/../Config/database.php';
include_once __DIR__ . '/../Share/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];
    $HoTen = $_POST["HoTen"];
    $GioiTinh = $_POST["GioiTinh"];
    $NgaySinh = $_POST["NgaySinh"];
    $MaNganh = $_POST["MaNganh"];

    // Xử lý hình ảnh
    $Hinh = NULL; // Mặc định không có ảnh
    if (!empty($_FILES["Hinh"]["name"])) {
        $target_dir = __DIR__ . '/../Content/images/';
        $Hinh = basename($_FILES["Hinh"]["name"]);
        $target_file = $target_dir . $Hinh;

        // Kiểm tra file hợp lệ
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($Hinh, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                // Upload thành công
            } else {
                echo "<div class='alert alert-danger'>Lỗi khi tải ảnh lên.</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>Chỉ chấp nhận file JPG, JPEG, PNG, GIF.</div>";
            exit;
        }
    }

    // Chèn dữ liệu vào database (dùng prepared statement để tránh SQL Injection)
    $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location.href='../index.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm Sinh Viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">THÊM SINH VIÊN</h2>
    <div class="card shadow p-4">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Mã SV:</label>
                <input type="text" class="form-control" name="MaSV" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Họ Tên:</label>
                <input type="text" class="form-control" name="HoTen" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giới Tính:</label>
                <select class="form-select" name="GioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày Sinh:</label>
                <input type="date" class="form-control" name="NgaySinh" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình:</label>
                <input type="file" class="form-control" name="Hinh">
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành:</label>
                <input type="text" class="form-control" name="MaNganh" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="../index.php" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
