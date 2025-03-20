<?php
session_start();
include '../Config/database.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = trim($_POST['masv']);

    if (!empty($masv)) {
        $query = "SELECT * FROM sinhvien WHERE MaSV = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $masv);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['masv'] = $masv;
            echo "<script>
                    alert('Đăng nhập thành công!');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Mã sinh viên không hợp lệ!');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Vui lòng nhập Mã sinh viên!');
                window.history.back();
              </script>";
    }
}
?>
