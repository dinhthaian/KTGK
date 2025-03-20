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
        echo "<script>alert('Không tìm thấy sinh viên!'); window.location.href='../index.php';</script>";
        exit();
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin chi tiết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Thông tin chi tiết</h2>
    <div class="card shadow p-4">
        <h4 class="mb-3">Sinh viên</h4>
        <table class="table table-bordered">
            <tr>
                <th>Họ Tên</th>
                <td><?= $row['HoTen'] ?></td>
            </tr>
            <tr>
                <th>Giới Tính</th>
                <td><?= $row['GioiTinh'] ?></td>
            </tr>
            <tr>
                <th>Ngày Sinh</th>
                <td><?= date("d/m/Y", strtotime($row['NgaySinh'])) ?></td>
            </tr>
            <tr>
                <th>Hình</th>
                <td>
                    <img src="../Content/images/<?= $row['Hinh'] ?>" alt="Hình sinh viên" class="img-thumbnail" width="150">
                </td>
            </tr>
            <tr>
                <th>Mã Ngành</th>
                <td><?= $row['MaNganh'] ?></td>
            </tr>
        </table>
        <a href="../index.php" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
