<?php
require '../Config/database.php';

if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Lấy thông tin sinh viên
    $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "<p class='text-danger text-center'>Không tìm thấy sinh viên.</p>";
        exit;
    }
}

// Xóa sinh viên nếu nhấn nút xác nhận
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteSQL = "DELETE FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($deleteSQL);
    $stmt->bind_param("s", $MaSV);
    
    if ($stmt->execute()) {
        echo "<script>alert('Xóa thành công!'); window.location.href='../index.php';</script>";
    } else {
        echo "<p class='text-danger text-center'>Lỗi khi xóa.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">XÓA THÔNG TIN</h2>
    <p class="text-center">Are you sure you want to delete this?</p>

    <table class="table table-bordered">
        <tr><th>Họ Tên</th><td><?php echo $student['HoTen']; ?></td></tr>
        <tr><th>Giới Tính</th><td><?php echo $student['GioiTinh']; ?></td></tr>
        <tr><th>Ngày Sinh</th><td><?php echo date("d/m/Y", strtotime($student['NgaySinh'])); ?></td></tr>
        <tr><th>Hình</th><td><img src="../Content/images/<?php echo $student['Hinh']; ?>" width="100"></td></tr>
        <tr><th>Mã Ngành</th><td><?php echo $student['MaNganh']; ?></td></tr>
    </table>

    <form method="POST">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="../index.php" class="btn btn-secondary">Back to List</a>
    </form>
</div>

</body>
</html>
