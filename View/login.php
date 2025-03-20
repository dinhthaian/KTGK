<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>

<?php include_once __DIR__ . "/../Share/header.php"; ?>

<div class="container mt-5">
    <h2 class="text-uppercase font-weight-bold">ĐĂNG NHẬP</h2>
    <form action="process_login.php" method="post">
        <div class="form-group">
            <label for="masv">MaSV</label>
            <input type="text" class="form-control" id="masv" name="masv" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
    <a href="../index.php" class="mt-3 d-block">Back to List</a>
</div>

</body>
</html>


