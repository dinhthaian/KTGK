<?php
session_start();
include 'db_connect.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = trim($_POST['masv']);

    $query = "SELECT * FROM sinhvien WHERE MaSV = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $masv);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['masv'] = $masv;
        header("Location: index.php");
    } else {
        echo "<script>alert('Mã sinh viên không hợp lệ!'); window.location.href='login.php';</script>";
    }
}
?>
