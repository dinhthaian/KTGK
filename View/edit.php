<?php
include_once __DIR__ . '/../Config/database.php';
include_once __DIR__ . '/../Share/header.php';

if (isset($_GET["MaSV"])) {
    $MaSV = $conn->real_escape_string($_GET["MaSV"]);
    $sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy sinh viên!'); window.location.href='index.php';</script>";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $conn->real_escape_string($_POST["HoTen"]);
    $GioiTinh = $conn->real_escape_string($_POST["GioiTinh"]);
    $NgaySinh = $conn->real_escape_string($_POST["NgaySinh"]);
    $MaNganh = $conn->real_escape_string($_POST["MaNganh"]);

    $Hinh = $row["Hinh"];
    if (!empty($_FILES["Hinh"]["name"])) {
        $target_dir = __DIR__ . '/../Content/images/';
        $Hinh = basename($_FILES["Hinh"]["name"]);
        $target_file = $target_dir . $Hinh;

        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
            if (!empty($row["Hinh"]) && file_exists($target_dir . $row["Hinh"])) {
                unlink($target_dir . $row["Hinh"]);
            }
        } else {
            $Hinh = $row["Hinh"];
        }
    }

    $sql = "UPDATE sinhvien SET 
            HoTen='$HoTen', 
            GioiTinh='$GioiTinh', 
            NgaySinh='$NgaySinh', 
            Hinh='$Hinh', 
            MaNganh='$MaNganh' 
            WHERE MaSV='$MaSV'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='../index.php';</script>";
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
    <title>Chỉnh sửa thông tin sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Hiệu chỉnh thông tin sinh viên</h2>
    <div class="card shadow p-4">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Họ Tên:</label>
                <input type="text" class="form-control" name="HoTen" value="<?= $row['HoTen'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giới Tính:</label>
                <select class="form-select" name="GioiTinh" required>
                    <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày Sinh:</label>
                <input type="date" class="form-control" name="NgaySinh" value="<?= $row['NgaySinh'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình:</label>
                <input type="file" class="form-control" name="Hinh">
                <div class="mt-2">
                    <img src="../Content/images/<?= $row['Hinh'] ?>" alt="Hình sinh viên" class="img-thumbnail" width="150">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành:</label>
                <input type="text" class="form-control" name="MaNganh" value="<?= $row['MaNganh'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
