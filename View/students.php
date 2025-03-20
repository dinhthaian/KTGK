<?php
echo '<div class="container mt-4">';
echo '<h2 class="text-center">TRANG SINH VIÊN</h2>';
echo '<a href="./View/add.php" class="btn btn-primary mb-3">Add Student</a>';

$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr>
            <th>MaSV</th>
            <th>HoTen</th>
            <th>GioiTinh</th>
            <th>NgaySinh</th>
            <th>Hình</th>
            <th>MaNganh</th>
            <th>Action</th>
          </tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row["MaSV"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["HoTen"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["GioiTinh"]) . '</td>';
        echo '<td>' . date("d/m/Y", strtotime($row["NgaySinh"])) . '</td>';

        // Kiểm tra xem có hình ảnh không
        if (!empty($row["Hinh"])) {
            echo '<td><img src="./Content/images/' . htmlspecialchars($row["Hinh"]) . '" alt="Hình ảnh" width="80"></td>';
        } else {
            echo '<td><img src="./Content/images/default.png" alt="Không có ảnh" width="80"></td>';
        }

        echo '<td>' . htmlspecialchars($row["MaNganh"]) . '</td>';
        echo '<td>
                <a href="View/edit.php?MaSV=' . urlencode($row["MaSV"]) . '">Edit</a> |
                <a href="View/detail.php?MaSV=' . urlencode($row["MaSV"]) . '">Details</a> |
                <a href="View/delete.php?MaSV=' . urlencode($row["MaSV"]) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Delete</a>
              </td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<p class='text-center'>Không có dữ liệu sinh viên.</p>";
}

echo '</div>';
$conn->close(); // Đóng kết nối
?>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
