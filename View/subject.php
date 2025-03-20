<?php
include_once __DIR__ . '/../Config/database.php';
include_once __DIR__ . '/../Share/header.php';

$sql = "SELECT * FROM hocphan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">DANH SÁCH HỌC PHẦN</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["MaHP"] ?></td>
                    <td><?= $row["TenHP"] ?></td>
                    <td><?= $row["SoTinChi"] ?></td>
                    <td>
                        <a href="register.php?MaHP=<?= $row["MaHP"] ?>" class="btn btn-success">Đăng Ký</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
